<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectAfterLogin();
        }

        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Las credenciales no son correctas.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return $this->redirectAfterLogin();
    }

    public function showRegister(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectAfterLogin();
        }

        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('cliente');

        Client::create([
            'id_user' => $user->id,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('account')->with('success', '¡Bienvenido a EcoEntrega! Tu cuenta fue creada correctamente.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function account(Request $request): View|RedirectResponse
    {
        if ($request->user()->isSuperAdmin()) {
            return redirect('/admin');
        }

        $user = $request->user()->loadCount(['orders']);
        $cartProducts = $user->shoppingCart?->cartDetails()->sum('quantity') ?? 0;
        $orders = $user->orders()->with(['details.product', 'payment'])->latest('order_date')->take(10)->get();
        $client = $user->client;
        $featuredProducts = Product::query()
            ->with('category')
            ->where('stock', '>', 0)
            ->latest('publication_date')
            ->take(4)
            ->get();

        return view('account', compact('user', 'cartProducts', 'orders', 'client', 'featuredProducts'));
    }

    public function addToCart(Request $request, Product $product): RedirectResponse
    {
        if ($product->stock <= 0) {
            return back()->with('error', 'El producto está agotado.');
        }

        $cart = ShoppingCart::firstOrCreate(
            ['id_user' => $request->user()->id],
            ['creation_date' => now()]
        );

        $detail = $cart->cartDetails()->firstOrNew(['id_product' => $product->id_product]);
        
        if ($detail->quantity >= $product->stock) {
            return back()->with('error', 'No hay más stock disponible para este producto.');
        }

        $detail->quantity = ($detail->quantity ?? 0) + 1;
        $detail->subtotal = $product->price * $detail->quantity;
        $detail->save();

        return back()->with('success', "«{$product->product_name}» agregado al carrito.");
    }

    public function updateCartQuantity(Request $request, int $detail): RedirectResponse
    {
        $cart = $request->user()->shoppingCart;
        abort_unless($cart, 404);

        $cartDetail = $cart->cartDetails()->whereKey($detail)->firstOrFail();
        $action = $request->input('action');
        $product = $cartDetail->product;

        if ($action === 'increase') {
            if ($cartDetail->quantity >= $product->stock) {
                return back()->with('error', 'No hay más stock disponible para este producto.');
            }
            $cartDetail->quantity += 1;
        } elseif ($action === 'decrease') {
            if ($cartDetail->quantity > 1) {
                $cartDetail->quantity -= 1;
            } else {
                $cartDetail->delete();
                return back()->with('success', 'Producto eliminado del carrito.');
            }
        }

        $cartDetail->subtotal = $product->price * $cartDetail->quantity;
        $cartDetail->save();

        return back()->with('success', 'Carrito actualizado.');
    }

    public function cart(Request $request): View|RedirectResponse
    {
        if ($request->user()->isSuperAdmin()) {
            return redirect('/admin');
        }

        $cart = $request->user()->shoppingCart()->with('cartDetails.product.category')->first();
        $details = $cart?->cartDetails ?? collect();
        $total = $details->sum('subtotal');
        $client = $request->user()->client;

        return view('cart', compact('details', 'total', 'client'));
    }

    public function removeFromCart(Request $request, int $detail): RedirectResponse
    {
        $cart = $request->user()->shoppingCart;
        abort_unless($cart, 404);
        $cart->cartDetails()->whereKey($detail)->firstOrFail()->delete();

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    public function showCheckout(Request $request, ?Product $product = null): View|RedirectResponse
    {
        if ($request->user()->isSuperAdmin()) {
            return redirect('/admin');
        }

        $user = $request->user();
        $client = $user->client;

        if ($product) {
            if ($product->stock <= 0) {
                return redirect()->route('home')->with('error', 'El producto está agotado.');
            }
            $mode = 'single';
            $items = collect([[
                'product' => $product,
                'quantity' => 1,
                'unit_price' => $product->price,
                'subtotal' => $product->price,
            ]]);
            $total = $product->price;
        } else {
            $mode = 'cart';
            $cart = $user->shoppingCart()->with('cartDetails.product')->first();
            $details = $cart?->cartDetails ?? collect();

            if ($details->isEmpty()) {
                return redirect()->route('cart')->with('error', 'Tu carrito está vacío. Agrega productos antes de comprar.');
            }

            foreach ($details as $detail) {
                if ($detail->quantity > $detail->product->stock) {
                    return redirect()->route('cart')->with('error', "No hay suficiente stock para {$detail->product->product_name}.");
                }
            }

            $items = $details->map(fn ($detail) => [
                'product' => $detail->product,
                'quantity' => $detail->quantity,
                'unit_price' => $detail->product->price,
                'subtotal' => $detail->subtotal,
            ]);
            $total = $details->sum('subtotal');
        }

        return view('checkout', compact('items', 'total', 'mode', 'client', 'product'));
    }

    public function processCheckout(Request $request): RedirectResponse
    {
        if ($request->user()->isSuperAdmin()) {
            return redirect('/admin');
        }

        $validated = $request->validate([
            'shipping_address' => ['required', 'string', 'max:255'],
            'shipping_phone' => ['required', 'string', 'max:50'],
            'payment_method' => ['required', 'string', 'in:Contraentrega,Nequi,Daviplata,Transferencia Bancaria,Tarjeta de Crédito'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'mode' => ['required', 'string', 'in:single,cart'],
            'product_id' => ['nullable', 'required_if:mode,single', 'exists:products,id_product'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $user = $request->user();

        return DB::transaction(function () use ($validated, $user) {
            $client = Client::firstOrCreate(
                ['id_user' => $user->id],
                [
                    'address' => $validated['shipping_address'],
                    'phone' => $validated['shipping_phone'],
                ]
            );

            if ($client->address !== $validated['shipping_address'] || $client->phone !== $validated['shipping_phone']) {
                $client->update([
                    'address' => $validated['shipping_address'],
                    'phone' => $validated['shipping_phone'],
                ]);
            }

            if ($validated['mode'] === 'single') {
                $product = Product::findOrFail($validated['product_id']);
                $qty = (int) ($validated['quantity'] ?? 1);
                
                if ($qty > $product->stock) {
                    abort(422, 'Stock insuficiente para el producto.');
                }
                
                $total = $product->price * $qty;
                $items = [[
                    'product_id' => $product->id_product,
                    'quantity' => $qty,
                    'unit_price' => $product->price,
                    'subtotal' => $total,
                    'model' => $product,
                ]];

                // Eliminar el producto del carrito si el usuario lo acaba de comprar de forma individual
                $cart = $user->shoppingCart;
                if ($cart) {
                    $cart->cartDetails()->where('id_product', $product->id_product)->delete();
                }
            } else {
                $cart = $user->shoppingCart()->with('cartDetails.product')->first();
                if (! $cart || $cart->cartDetails->isEmpty()) {
                    return redirect()->route('cart')->with('error', 'El carrito está vacío.');
                }
                
                foreach ($cart->cartDetails as $detail) {
                    if ($detail->quantity > $detail->product->stock) {
                        abort(422, "Stock insuficiente para {$detail->product->product_name}.");
                    }
                }

                $total = $cart->cartDetails->sum('subtotal');
                $items = $cart->cartDetails->map(fn ($detail) => [
                    'product_id' => $detail->id_product,
                    'quantity' => $detail->quantity,
                    'unit_price' => $detail->product->price,
                    'subtotal' => $detail->subtotal,
                    'model' => $detail->product,
                ])->all();
            }

            $paymentStatus = in_array($validated['payment_method'], ['Nequi', 'Daviplata', 'Tarjeta de Crédito', 'Transferencia Bancaria'])
                ? 'Aprobado'
                : 'Pendiente (Contraentrega)';

            $payment = Payment::create([
                'payment_method' => $validated['payment_method'],
                'payment_status' => $paymentStatus,
                'payment_date' => now(),
                'amount' => $total,
            ]);

            $order = Order::create([
                'id_user' => $user->id,
                'id_client' => $client->id_client,
                'id_payment' => $payment->id_payment,
                'shipping_address' => $validated['shipping_address'],
                'shipping_phone' => $validated['shipping_phone'],
                'payment_method' => $validated['payment_method'],
                'total' => $total,
                'order_status' => $paymentStatus === 'Aprobado' ? 'paid' : 'pending',
                'notes' => $validated['notes'] ?? null,
                'order_date' => now(),
            ]);

            foreach ($items as $item) {
                OrderDetail::create([
                    'id_order' => $order->id_order,
                    'id_product' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $item['subtotal'],
                ]);
                
                $item['model']->decrement('stock', $item['quantity']);
            }

            if ($validated['mode'] === 'cart' && isset($cart)) {
                $cart->cartDetails()->delete();
            }

            return redirect()->route('home')->with('order_success', [
                'id' => $order->id_order,
                'total' => number_format($order->total, 0, ',', '.'),
                'address' => $order->shipping_address,
                'payment_method' => $order->payment_method,
            ]);
        });
    }

    private function redirectAfterLogin(): RedirectResponse
    {
        return Auth::user()->isSuperAdmin()
            ? redirect('/admin')
            : redirect()->route('account');
    }
}
