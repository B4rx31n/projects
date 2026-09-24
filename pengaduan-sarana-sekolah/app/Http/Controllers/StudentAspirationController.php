<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAspirationRequest;
use App\Models\Aspiration;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentAspirationController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        return view('student.aspirations.index', [
            'categories' => Category::query()->orderBy('name')->get(),
            'statuses' => config('aspirasi.statuses'),
            'recent' => Aspiration::query()
                ->with(['category', 'latestFeedback.admin'])
                ->where('user_id', $user->id)
                ->latest()
                ->limit(10)
                ->get(),
        ]);
    }

    public function store(StoreAspirationRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('aspirasi', 'public');
        }

        Aspiration::create([
            'user_id' => $request->user()->id,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'location' => $data['location'] ?? null,
            'photo_path' => $photoPath,
            'status' => Aspiration::STATUS_BARU,
            'progress_percent' => 0,
        ]);

        return redirect()
            ->route('student.aspirations.index')
            ->with('success', 'Aspirasi berhasil dikirim.');
    }

    public function history(Request $request): View
    {
        $filters = $request->only(['q', 'status', 'category_id', 'from', 'to', 'month']);

        return view('student.aspirations.history', [
            'filters' => $filters,
            'categories' => Category::query()->orderBy('name')->get(),
            'statuses' => config('aspirasi.statuses'),
            'aspirations' => Aspiration::query()
                ->with(['category', 'latestFeedback.admin'])
                ->where('user_id', $request->user()->id)
                ->latest()
                ->tap(fn ($q) => $q->filter($filters))
                ->paginate(15)
                ->withQueryString(),
        ]);
    }

    public function show(Request $request, Aspiration $aspiration): View
    {
        abort_unless($aspiration->user_id === $request->user()->id, 403);

        return view('student.aspirations.show', [
            'statuses' => config('aspirasi.statuses'),
            'aspiration' => $aspiration->load([
                'category',
                'feedbacks.admin',
            ]),
            'photoUrl' => $aspiration->photo_path ? Storage::disk('public')->url($aspiration->photo_path) : null,
        ]);
    }
}



