<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Carrito | EcoEntrega</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }
        header {
            background: #064e3b;
            color: #fff;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header a {
            color: #fff;
            text-decoration: none;
            font-weight: 800;
        }
        .header-nav {
            display: flex;
            gap: 16px;
            align-items: center;
            font-size: 14px;
        }
        .container {
            max-width: 1020px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .page-header h1 {
            font-size: 26px;
            font-weight: 800;
            margin: 0;
            color: #0f172a;
        }
        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .cart-grid {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 28px;
        }
        .card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        }
        .cart-item {
            display: flex;
            gap: 18px;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .cart-item:last-child {
            border-bottom: 0;
        }
        .item-thumb {
            width: 72px;
            height: 72px;
            border-radius: 10px;
            background: #f1f5f9;
            overflow: hidden;
            display: grid;
            place-items: center;
            font-size: 32px;
            flex-shrink: 0;
        }
        .item-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .item-details {
            flex-grow: 1;
        }
        .item-category {
            font-size: 11px;
            font-weight: 800;
            color: #059669;
            text-transform: uppercase;
            letter-spacing: .05em;
        }
        .item-title {
            margin: 4px 0;
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
        }
        .item-meta {
            font-size: 13px;
            color: #64748b;
        }
        .item-price {
            font-weight: 800;
            font-size: 16px;
            color: #065f46;
            text-align: right;
            min-width: 100px;
        }
        .item-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 8px;
        }
        .qty-control {
            display: flex;
            align-items: center;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
        }
        .qty-btn {
            background: #f8fafc;
            border: 0;
            width: 28px;
            height: 28px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            color: #334155;
            display: grid;
            place-items: center;
        }
        .qty-btn:hover {
            background: #e2e8f0;
        }
        .qty-display {
            padding: 0 10px;
            font-size: 13px;
            font-weight: 700;
        }
        .remove-btn {
            background: transparent;
            border: 0;
            color: #ef4444;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
        }
        .remove-btn:hover {
            background: #fee2e2;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
            color: #475569;
        }
        .summary-total {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 2px dashed #e2e8f0;
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: 800;
            color: #064e3b;
        }
        .checkout-btn {
            display: block;
            width: 100%;
            margin-top: 20px;
            padding: 14px;
            background: #059669;
            color: #fff;
            text-align: center;
            border-radius: 12px;
            font-weight: 800;
            font-size: 15px;
            text-decoration: none;
            border: 0;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(5, 150, 105, 0.35);
            transition: background .2s, transform .1s;
        }
        .checkout-btn:hover {
            background: #047857;
        }
        .checkout-btn:active {
            transform: scale(0.98);
        }
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border-radius: 16px;
            border: 1px dashed #cbd5e1;
        }
        .empty-cart-icon {
            font-size: 54px;
            margin-bottom: 12px;
        }
        .empty-cart h2 {
            margin: 0 0 8px;
            font-size: 20px;
        }
        .empty-cart p {
            margin: 0 0 20px;
            color: #64748b;
        }
        .btn-primary {
            display: inline-block;
            padding: 12px 20px;
            background: #059669;
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
        }
        @media(max-width: 820px) {
            .cart-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('home') }}">♻ EcoEntrega</a>
        <div class="header-nav">
            <a href="{{ route('home') }}#catalogo">Explorar catálogo</a>
            <a href="{{ route('account') }}">Mi cuenta</a>
        </div>
    </header>

    <main class="container">
        <div class="page-header">
            <h1>🛒 Mi Carrito de Compras</h1>
            <a href="{{ route('home') }}#catalogo" style="color:#059669;text-decoration:none;font-size:14px;font-weight:700;">+ Agregar más prendas</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($details->isEmpty())
            <div class="empty-cart">
                <div class="empty-cart-icon">🛍️</div>
                <h2>Tu carrito está vacío</h2>
                <p>Aún no has agregado prendas de moda circular a tu carrito.</p>
                <a href="{{ route('home') }}#catalogo" class="btn-primary">Explorar catálogo de prendas</a>
            </div>
        @else
            <div class="cart-grid">
                {{-- Lista de productos en el carrito --}}
                <div class="card">
                    <h2 style="margin:0 0 16px;font-size:18px;color:#0f172a;">Prendas seleccionadas ({{ $details->sum('quantity') }})</h2>

                    @foreach($details as $detail)
                        <div class="cart-item">
                            <div class="item-thumb">
                                @if($detail->product->image)
                                    <img src="{{ $detail->product->image_url }}" alt="{{ $detail->product->product_name }}" onerror="this.parentElement.innerHTML='👚'">
                                @else
                                    👚
                                @endif
                            </div>
                            <div class="item-details">
                                <span class="item-category">{{ $detail->product->category?->category_name ?? 'Moda circular' }}</span>
                                <h3 class="item-title">{{ $detail->product->product_name }}</h3>
                                <div class="item-meta">
                                    Talla: <strong>{{ $detail->product->size ?? 'Única' }}</strong> ·
                                    Color: {{ $detail->product->color ?? 'N/A' }} ·
                                    ${{ number_format($detail->product->price, 0, ',', '.') }} c/u
                                </div>

                                <div class="item-actions">
                                    <div class="qty-control">
                                        <form method="POST" action="{{ route('cart.update', $detail->id_cart_detail) }}" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="action" value="decrease">
                                            <button type="submit" class="qty-btn" title="Disminuir">-</button>
                                        </form>
                                        <span class="qty-display">{{ $detail->quantity }}</span>
                                        <form method="POST" action="{{ route('cart.update', $detail->id_cart_detail) }}" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="action" value="increase">
                                            <button type="submit" class="qty-btn" title="Aumentar" {!! $detail->quantity >= $detail->product->stock ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : '' !!}>+</button>
                                        </form>
                                    </div>

                                    <form method="POST" action="{{ route('cart.remove', $detail->id_cart_detail) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-btn">🗑️ Eliminar</button>
                                    </form>
                                </div>
                            </div>

                            <div class="item-price">
                                ${{ number_format($detail->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Resumen y botón de Checkout --}}
                <div class="card" style="height: fit-content;">
                    <h2 style="margin:0 0 16px;font-size:18px;color:#065f46;">Resumen de compra</h2>

                    <div class="summary-row">
                        <span>Subtotal de prendas</span>
                        <span>${{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Envío</span>
                        <span style="color:#059669;font-weight:700;">GRATIS 🚀</span>
                    </div>

                    <div class="summary-total">
                        <span>Total</span>
                        <span>${{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('checkout.show') }}" class="checkout-btn">
                        ⚡ Comprar todo el carrito
                    </a>

                    <p style="font-size:12px;color:#64748b;text-align:center;margin-top:12px;">
                        🔒 Compra 100% segura con garantía de moda circular
                    </p>
                </div>
            </div>
        @endif
    </main>
</body>
</html>
