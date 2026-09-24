<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.aspirations.index');
        }

        return redirect()->route('student.aspirations.index');
    }
}



