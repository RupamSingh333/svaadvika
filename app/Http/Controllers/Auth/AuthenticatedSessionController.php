<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use App\Models\Cart;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $oldSessionId = $request->session()->getId();
        
        $request->authenticate();

        $request->session()->regenerate();
        $newSessionId = $request->session()->getId();
        $customerId = Auth::guard('customer')->id();

        // Cart Merge Logic
        $guestCart = Cart::where('session_id', $oldSessionId)->first();
        if ($guestCart) {
            $userCart = Cart::where('customer_id', $customerId)->first();
            
            if ($userCart) {
                // Merge items
                foreach ($guestCart->items as $item) {
                    $existingItem = $userCart->items()->where('product_id', $item->product_id)->first();
                    if ($existingItem) {
                        $existingItem->quantity += $item->quantity;
                        $existingItem->save();
                    } else {
                        $item->cart_id = $userCart->id;
                        $item->save();
                    }
                }
                $guestCart->delete();
            } else {
                // Associate guest cart to user
                $guestCart->update([
                    'customer_id' => $customerId,
                    'session_id' => $newSessionId
                ]);
            }
        }

        return redirect()->intended(route('home', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
