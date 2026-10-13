<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Cuenta | EcoEntrega</title>
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
            gap: 15px;
        }
        header a {
            color: #fff;
            text-decoration: none;
            font-weight: 800;
        }
        .nav {
            display: flex;
            gap: 18px;
            align-items: center;
            font-size: 14px;
        }
        .logout {
            background: transparent;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            color: #fff;
            padding: 8px 12px;
            cursor: pointer;
            font-weight: 600;
        }
        .logout:hover {
            background: #047857;
        }
        .content {
            max-width: 1120px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .notice {
            background: #dcfce7;
            color: #166534;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 600;
            border: 1px solid #bbf7d0;
        }
        .welcome {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid #e2e8f0;
        }
        .welcome h1 {
            margin: 0 0 6px;
            font-size: 26px;
            color: #0f172a;
        }
        .welcome p {
            color: #64748b;
            margin: 0;
        }
        .category {
            font-size: 12px;
            font-weight: 800;
            color: #059669;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 6px;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-top: 24px;
        }
        .stat {
            padding: 22px;
            background: #ecfdf5;
            border-radius: 16px;
            border: 1px solid #d1fae5;
        }
        .stat strong {
            display: block;
            font-size: 32px;
            color: #047857;
            font-weight: 800;
        }
        .stat span {
            font-size: 14px;
            color: #475569;
            font-weight: 600;
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }
        .btn {
            display: inline-block;
            padding: 12px 18px;
            background: #059669;
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
        }
        .btn:hover {
            background: #047857;
        }
        .btn.alt {
            background: #fff;
            color: #065f46;
            border: 1.5px solid #059669;
        }
        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 48px;
            margin-bottom: 20px;
        }
        .section-head h2 {
            margin: 0;
            font-size: 22px;
            color: #0f172a;
        }
        .section-head a {
            color: #059669;
            font-weight: 700;
            text-decoration: none;
            font-size: 14px;
        }
        .orders-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }
        .order-row {
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }
        .order-row:last-child {
            border-bottom: 0;
        }
        .order-id {
            font-weight: 800;
            font-size: 16px;
            color: #064e3b;
        }
        .order-date {
            font-size: 13px;
            color: #64748b;
            margin-top: 2px;
        }
        .order-address {
            font-size: 13px;
            color: #334155;
            margin-top: 4px;
        }
        .order-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }
        .badge-pending { background: #fef3c7; color: #b45309; }
        .badge-paid { background: #dcfce7; color: #166534; }
        .badge-shipped { background: #e0e7ff; color: #3730a3; }
        .badge-completed { background: #d1fae5; color: #065f46; }
        .order-total {
            font-size: 18px;
            font-weight: 800;
            color: #065f46;
            text-align: right;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .product {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }
        .photo {
            height: 190px;
            background: #f1f5f9;
            display: grid;
            place-items: center;
            font-size: 50px;
            overflow: hidden;
        }
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .product-info {
            padding: 16px;
        }
        .product h3 {
            margin: 6px 0;
            font-size: 16px;
            color: #0f172a;
        }
        .price {
            font-weight: 800;
            color: #065f46;
            font-size: 18px;
        }
        .add {
            margin-top: 12px;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1.5px solid #059669;
            background: #fff;
            color: #065f46;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
        }
        .add:hover {
            background: #059669;
            color: #fff;
        }
        @media(max-width: 820px) {
            .products { grid-template-columns: repeat(2, 1fr); }
            .stats { grid-template-columns: 1fr; }
        }
        @media(max-width: 500px) {
            .products { grid-template-columns: 1fr; }
            .nav a { display: none; }
        }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('home') }}">♻ EcoEntrega</a>
        <nav class="nav">
            <a href="{{ route('home') }}#catalogo">Explorar catálogo</a>
            <a href="{{ route('cart') }}">Mi carrito ({{ $cartProducts }})</a>
            @if(auth()->user()->isSuperAdmin())
                <a href="{{ url('/admin') }}" style="background:#d97706;padding:8px 12px;border-radius:8px;color:#fff;text-decoration:none;font-weight:bold;">⚙️ Panel Admin</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout">Cerrar sesión</button>
            </form>
        </nav>
    </header>

    <main class="content">
        @if(session('success'))
            <p class="notice">{{ session('success') }}</p>
        @endif

        {{-- Sección de Bienvenida --}}
        <section class="welcome">
            <p class="category">MI CUENTA CLIENTE</p>
            <h1>Hola, {{ $user->name }} 👋</h1>
            <p>{{ $user->email }} · {{ $client?->address ?? 'Sin dirección registrada aún' }}</p>

            <div class="stats">
                <div class="stat">
                    <strong>{{ $cartProducts }}</strong>
                    <span>Prendas en tu carrito</span>
                </div>
                <div class="stat">
                    <strong>{{ $user->orders_count }}</strong>
                    <span>Pedidos realizados</span>
                </div>
            </div>

            <div class="actions">
                <a class="btn" href="{{ route('home') }}#catalogo">Explorar catálogo de prendas</a>
                <a class="btn alt" href="{{ route('cart') }}">Ir a mi carrito ({{ $cartProducts }})</a>
            </div>
        </section>

        {{-- Historial de Pedidos Realizados --}}
        <div class="section-head">
            <div>
                <p class="category">MIS COMPRAS</p>
                <h2>Historial de Pedidos</h2>
            </div>
        </div>

        <div class="orders-card">
            @forelse($orders as $order)
                <div class="order-row">
                    <div>
                        <div class="order-id">Pedido #{{ $order->id_order }}</div>
                        <div class="order-date">📅 {{ date('d/m/Y H:i', strtotime($order->order_date)) }}</div>
                        <div class="order-address">📍 Envío a: <strong>{{ $order->shipping_address ?? $client?->address ?? 'Dirección no registrada' }}</strong></div>
                        <div style="font-size:12px;color:#64748b;margin-top:4px;">
                            💳 {{ $order->payment_method ?? 'Contraentrega' }} ·
                            @foreach($order->details as $d)
                                <span style="background:#f1f5f9;padding:2px 6px;border-radius:4px;margin-right:4px;">{{ $d->product?->product_name ?? 'Prenda' }} (x{{ $d->quantity }})</span>
                            @endforeach
                        </div>
                    </div>

                    <div style="text-align:right;">
                        <span class="order-badge {{ $order->order_status === 'paid' ? 'badge-paid' : ($order->order_status === 'shipped' ? 'badge-shipped' : 'badge-pending') }}">
                            {{ match($order->order_status) {
                                'paid' => 'Pagado',
                                'pending' => 'Pendiente',
                                'shipped' => 'Enviado',
                                'completed' => 'Completado',
                                default => ucfirst($order->order_status)
                            } }}
                        </span>
                        <div class="order-total" style="margin-top:6px;">
                            ${{ number_format($order->total, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            @empty
                <div style="padding:40px 20px;text-align:center;color:#64748b;">
                    <div style="font-size:36px;margin-bottom:8px;">🛍️</div>
                    <p style="margin:0;font-weight:600;">Aún no has realizado pedidos.</p>
                    <p style="margin:4px 0 16px;font-size:13px;">Explora el catálogo y encuentra prendas únicas de moda circular.</p>
                    <a href="{{ route('home') }}#catalogo" class="btn">Comprar mi primera prenda</a>
                </div>
            @endforelse
        </div>

        {{-- Prendas destacadas --}}
        <div class="section-head">
            <div>
                <p class="category">RECIÉN AGREGADOS</p>
                <h2>Prendas destacadas para ti</h2>
            </div>
            <a href="{{ route('home') }}#catalogo">Ver catálogo completo →</a>
        </div>

        <section class="products">
            @forelse($featuredProducts as $product)
                <article class="product">
                    <div class="photo">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}" onerror="this.parentElement.innerHTML='👕'">
                        @else
                            👕
                        @endif
                    </div>
                    <div class="product-info">
                        <div class="category">{{ $product->category?->category_name ?? 'Moda circular' }}</div>
                        <h3>{{ $product->product_name }}</h3>
                        <div class="price">${{ number_format($product->price, 0, ',', '.') }}</div>
                        @if($product->stock > 0)
                            <div style="display:flex;gap:8px;margin-top:12px;">
                                <form method="POST" action="{{ route('cart.add', $product) }}" style="flex:1;">
                                    @csrf
                                    <button type="submit" class="add" style="margin:0;">🛒 Al carrito</button>
                                </form>
                                <a href="{{ route('checkout.show', $product) }}" class="btn" style="flex:1;text-align:center;padding:10px;font-size:13px;background:#047857;">⚡ Comprar</a>
                            </div>
                        @else
                            <div style="margin-top:12px;padding:10px;background:#f3f4f6;border-radius:8px;text-align:center;color:#9ca3af;font-weight:700;font-size:13px;">
                                Agotado
                            </div>
                        @endif
                    </div>
                </article>
            @empty
                <p>Aún no hay productos disponibles.</p>
            @endforelse
        </section>
    </main>
</body>
</html>
