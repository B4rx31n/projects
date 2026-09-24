<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Aspiration;
use App\Models\AspirationFeedback;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminAspirationController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->only(['q', 'status', 'category_id', 'user_id', 'from', 'to', 'month']);

        $aspirations = Aspiration::query()
            ->with(['user', 'category', 'latestFeedback.admin'])
            ->latest()
            ->tap(fn ($q) => $q->filter($filters))
            ->paginate(20)
            ->withQueryString();

        [$from, $to] = $this->rangeForRekap($request);

        return view('admin.aspirations.index', [
            'filters' => $filters,
            'statuses' => config('aspirasi.statuses'),
            'categories' => Category::query()->orderBy('name')->get(),
            'students' => User::query()->where('role', User::ROLE_SISWA)->orderBy('name')->get(),
            'aspirations' => $aspirations,
            'rekap' => [
                'from' => $from,
                'to' => $to,
                'perTanggal' => $this->rekapPerTanggal($from, $to),
                'perBulan' => $this->rekapPerBulan($from, $to),
                'perSiswa' => $this->rekapPerSiswa($from, $to),
                'perKategori' => $this->rekapPerKategori($from, $to),
            ],
        ]);
    }

    public function show(Aspiration $aspiration): View
    {
        return view('admin.aspirations.show', [
            'statuses' => config('aspirasi.statuses'),
            'aspiration' => $aspiration->load([
                'user',
                'category',
                'feedbacks.admin',
            ]),
            'photoUrl' => $aspiration->photo_path ? Storage::disk('public')->url($aspiration->photo_path) : null,
        ]);
    }

    public function storeFeedback(StoreFeedbackRequest $request, Aspiration $aspiration): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($request, $aspiration, $data) {
            AspirationFeedback::create([
                'aspiration_id' => $aspiration->id,
                'admin_id' => $request->user()->id,
                'message' => $data['message'],
                'status_after' => $data['status_after'],
                'progress_percent_after' => $data['progress_percent_after'],
            ]);

            $aspiration->update([
                'status' => $data['status_after'],
                'progress_percent' => $data['progress_percent_after'],
            ]);
        });

        return redirect()
            ->route('admin.aspirations.show', $aspiration)
            ->with('success', 'Umpan balik tersimpan dan status diperbarui.');
    }

    /**
     * @return array{0:string,1:string}
     */
    private function rangeForRekap(Request $request): array
    {
        // Default: 30 hari terakhir
        $from = $request->query('from_rekap');
        $to = $request->query('to_rekap');

        $fromDate = $from ? Carbon::parse($from) : now()->subDays(30);
        $toDate = $to ? Carbon::parse($to) : now();

        return [
            $fromDate->toDateString(),
            $toDate->toDateString(),
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function rekapPerTanggal(string $from, string $to): array
    {
        try {
            if (in_array(DB::getDriverName(), ['mysql', 'mariadb'], true)) {
                return (array) DB::select('CALL sp_rekap_aspirasi_per_tanggal(?, ?)', [$from, $to]);
            }
        } catch (\Throwable) {
            // fallback below
        }

        return (array) DB::table('aspirations')
            ->selectRaw('date(created_at) as tanggal, count(*) as total')
            ->whereBetween(DB::raw('date(created_at)'), [$from, $to])
            ->groupBy(DB::raw('date(created_at)'))
            ->orderBy('tanggal')
            ->get()
            ->toArray();
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function rekapPerBulan(string $from, string $to): array
    {
        try {
            if (in_array(DB::getDriverName(), ['mysql', 'mariadb'], true)) {
                return (array) DB::select('CALL sp_rekap_aspirasi_per_bulan(?, ?)', [$from, $to]);
            }
        } catch (\Throwable) {
            // fallback below
        }

        $driver = DB::getDriverName();
        $expr = ($driver === 'mysql' || $driver === 'mariadb')
            ? "DATE_FORMAT(created_at, '%Y-%m')"
            : "strftime('%Y-%m', created_at)";

        return (array) DB::table('aspirations')
            ->selectRaw("{$expr} as bulan, count(*) as total")
            ->whereBetween(DB::raw('date(created_at)'), [$from, $to])
            ->groupBy(DB::raw($expr))
            ->orderBy('bulan')
            ->get()
            ->toArray();
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function rekapPerSiswa(string $from, string $to): array
    {
        try {
            if (in_array(DB::getDriverName(), ['mysql', 'mariadb'], true)) {
                return (array) DB::select('CALL sp_rekap_aspirasi_per_siswa(?, ?)', [$from, $to]);
            }
        } catch (\Throwable) {
            // fallback below
        }

        return (array) DB::table('aspirations as a')
            ->join('users as u', 'u.id', '=', 'a.user_id')
            ->selectRaw('u.id as user_id, u.name as siswa, count(a.id) as total')
            ->whereBetween(DB::raw('date(a.created_at)'), [$from, $to])
            ->groupBy('u.id', 'u.name')
            ->orderByDesc('total')
            ->orderBy('siswa')
            ->get()
            ->toArray();
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function rekapPerKategori(string $from, string $to): array
    {
        try {
            if (in_array(DB::getDriverName(), ['mysql', 'mariadb'], true)) {
                return (array) DB::select('CALL sp_rekap_aspirasi_per_kategori(?, ?)', [$from, $to]);
            }
        } catch (\Throwable) {
            // fallback below
        }

        return (array) DB::table('aspirations as a')
            ->join('categories as c', 'c.id', '=', 'a.category_id')
            ->selectRaw('c.id as category_id, c.name as kategori, count(a.id) as total')
            ->whereBetween(DB::raw('date(a.created_at)'), [$from, $to])
            ->groupBy('c.id', 'c.name')
            ->orderByDesc('total')
            ->orderBy('kategori')
            ->get()
            ->toArray();
    }
}



