<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (! $customer) {
            throw ValidationException::withMessages([
                'email' => __('This email is not registered in our customer records.'),
            ]);
        }

        try {
            // Queue the notification or send reset link in background to prevent 45s server timeout
            $customer->sendPasswordResetNotification(
                Password::broker('customers')->createToken($customer)
            );

            return back()->with('status', __('A password reset link has been sent to your email address. Please check your inbox.'));
        } catch (Throwable $e) {
            Log::error('Password reset email failed', [
                'email' => $request->email,
                'exception' => $e->getMessage(),
            ]);

            return back()->withInput($request->only('email'))
                ->withErrors(['email' => __('We could not send the password reset email right now. Please try again later.')]);
        }
    }
}
