<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request, ActivityLogService $activityLogService): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password tidak sesuai.',
            ]);
        }

        $request->session()->regenerate();
        $user = $request->user();

        if (! in_array($user->role, ['admin', 'petugas'], true)) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Akun tidak memiliki peran yang valid.',
            ]);
        }

        $activityLogService->record('login', 'auth', ucfirst($user->role).' masuk ke sistem.', [], $user);

        return redirect()->route($this->redirectRouteFor($user));
    }

    public function destroy(Request $request, ActivityLogService $activityLogService): RedirectResponse
    {
        $user = $request->user();
        $activityLogService->record('logout', 'auth', 'Petugas keluar dari sistem.', [], $user);

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function redirectRouteFor(User $user): string
    {
        return $user->isAdmin() ? 'admin.dashboard' : 'reports.create';
    }
}
