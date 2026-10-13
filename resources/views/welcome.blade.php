<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EcoEntrega | Moda circular</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #fafaf9;
            color: #1c1917;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        input,
        select {
            font: inherit;
        }

        /* Header */
        header {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid #e7e5e4;
            backdrop-filter: blur(10px);
        }

        header > div {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 16px 32px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;

            font-size: 20px;
            font-weight: 900;
            letter-spacing: -0.02em;
            color: #065f46;
        }

        .logo-icon {
            width: 36px;
            height: 36px;

            display: grid;
            place-items: center;

            border-radius: 12px;
            background: #047857;
            color: #fff;

            font-size: 18px;
        }

        header nav {
            display: flex;
            align-items: center;
            gap: 20px;

            color: #57534e;
            font-size: 14px;
            font-weight: 600;
        }

        header nav a {
            transition: color 0.2s ease, background 0.2s ease;
        }

        header nav a:hover {
            color: #047857;
        }

        .nav-login {
            padding: 11px 16px;

            border-radius: 10px;
            background: #047857;
            color: #fff !important;
        }

        .nav-login:hover {
            background: #065f46;
        }

        .nav-register {
            color: #047857;
        }

        .nav-admin {
            padding: 11px 16px;

            border-radius: 10px;
            background: #d97706;
            color: #fff !important;

            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .nav-admin:hover {
            background: #b45309;
        }

        .nav-account {
            padding: 11px 16px;

            border-radius: 10px;
            background: #047857;
            color: #fff !important;
        }

        .nav-account:hover {
            background: #065f46;
        }

        /* Hero */
        .hero {
            overflow: hidden;
            background: #064e3b;
        }

        .hero-inner {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;

            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 40px;

            padding: 86px 32px;
        }

        .hero-content {
            max-width: 700px;
        }

        .hero-badge {
            display: inline-flex;

            margin-bottom: 20px;
            padding: 7px 16px;

            border-radius: 999px;
            background: #065f46;
            color: #d1fae5;

            font-size: 14px;
            font-weight: 600;
        }

        .hero h1 {
            margin: 0;

            color: #fff;

            font-size: 58px;
            line-height: 1.1;
            font-weight: 900;
            letter-spacing: -0.04em;
        }

        .hero h1 span {
            color: #bef264;
        }

        .hero-description {
            max-width: 600px;

            margin: 24px 0 0;

            color: #d1fae5;

            font-size: 18px;
            line-height: 1.6;
        }

        .hero-button {
            display: inline-block;

            margin-top: 28px;
            padding: 14px 24px;

            border-radius: 10px;
            background: #bef264;
            color: #14532d;

            font-weight: 700;

            transition: background 0.2s ease, transform 0.2s ease;
        }

        .hero-button:hover {
            background: #d9f99d;
            transform: translateY(-2px);
        }

        /* Hero visual */
        .hero-visual {
            position: relative;
            min-height: 300px;
        }

        .hero-square {
            position: absolute;

            width: 256px;
            height: 256px;

            border-radius: 40px;
        }

        .hero-square-lime {
            top: 12px;
            right: 32px;

            background: #bef264;
            transform: rotate(6deg);
        }

        .hero-square-green {
            bottom: 0;
            left: 0;

            display: grid;
            place-items: center;

            background: #047857;
            color: #fff;

            font-size: 84px;

            transform: rotate(-6deg);

            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .hero-card {
            position: absolute;

            right: 0;
            bottom: 24px;

            padding: 16px 20px;

            border-radius: 16px;
            background: #fff;

            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.18);
        }

        .hero-card strong {
            display: block;

            color: #065f46;

            font-size: 24px;
        }

        .hero-card span {
            color: #78716c;
            font-size: 14px;
        }

        /* Catalog */
        .catalog {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;

            padding: 64px 32px;
        }

        .catalog-header {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 20px;
        }

        .eyebrow {
            margin: 0;

            color: #047857;

            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.18em;
        }

        .catalog h2,
        .how-section h2 {
            margin: 8px 0 0;

            font-size: 32px;
            line-height: 1.2;
            font-weight: 900;
            letter-spacing: -0.03em;
        }

        .product-count {
            color: #78716c;
            font-size: 14px;
        }

        /* Search */
        .search-form {
            display: grid;
            grid-template-columns: 1fr 220px auto;
            gap: 12px;

            margin-top: 30px;
            padding: 16px;

            border: 1px solid #e7e5e4;
            border-radius: 16px;

            background: #fff;

            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .search-form input,
        .search-form select {
            width: 100%;

            padding: 13px 15px;

            border: 1px solid #d6d3d1;
            border-radius: 10px;

            outline: none;
            background: #fff;
        }

        .search-form input:focus,
        .search-form select:focus {
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
        }

        .search-form button {
            padding: 13px 24px;

            border: 0;
            border-radius: 10px;

            background: #047857;
            color: #fff;

            font-weight: 700;
            cursor: pointer;

            transition: background 0.2s ease;
        }

        .search-form button:hover {
            background: #065f46;
        }

        /* Products */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 24px;

            margin-top: 40px;
        }

        .product-card {
            overflow: hidden;

            border: 1px solid #e7e5e4;
            border-radius: 16px;

            background: #fff;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.10);
        }

        .product-image {
            position: relative;

            aspect-ratio: 4 / 5;

            overflow: hidden;

            background: #f5f5f4;
        }

        .product-image img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .image-fallback {
            width: 100%;
            height: 100%;

            display: grid;
            place-items: center;
            align-content: center;
            gap: 10px;

            color: #78716c;

            font-size: 48px;
            text-align: center;
        }

        .image-fallback span {
            font-size: 13px;
            font-weight: 700;
        }

        .condition {
            position: absolute;

            top: 12px;
            left: 12px;

            padding: 6px 10px;

            border-radius: 999px;

            background: rgba(255, 255, 255, 0.95);
            color: #065f46;

            font-size: 12px;
            font-weight: 700;
        }

        .product-info {
            padding: 20px;
        }

        .product-category {
            margin: 0;

            color: #047857;

            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .product-title {
            margin: 6px 0;

            overflow: hidden;

            color: #1c1917;

            font-size: 18px;
            font-weight: 700;

            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .product-bottom {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 12px;

            margin-top: 12px;
        }

        .product-price {
            margin: 0;

            color: #065f46;

            font-size: 20px;
            font-weight: 900;
        }

        .product-meta {
            margin: 4px 0 0;

            color: #78716c;

            font-size: 12px;
        }

        .product-button {
            padding: 9px 12px;

            border: 1px solid #047857;
            border-radius: 9px;

            background: #fff;
            color: #065f46;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;
        }

        .product-button:hover {
            background: #047857;
            color: #fff;
        }

        /* Empty */
        .empty-state {
            margin-top: 40px;
            padding: 64px 24px;

            border: 1px dashed #d6d3d1;
            border-radius: 16px;

            background: #fff;

            text-align: center;
        }

        .empty-icon {
            font-size: 42px;
        }

        .empty-state h3 {
            margin: 16px 0 0;

            font-size: 20px;
        }

        .empty-state p {
            margin: 8px 0 0;

            color: #78716c;
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 40px;
        }

        .pagination {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;

            padding: 0;
            margin: 0;

            list-style: none;
        }

        .pagination a,
        .pagination span {
            display: inline-block;

            padding: 8px 12px;

            border: 1px solid #ddd;
            border-radius: 8px;

            background: #fff;
        }

        /* How it works */
        .how-section {
            background: #ecfdf5;
        }

        .how-inner {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;

            padding: 64px 32px;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;

            margin-top: 32px;
        }

        .step-card {
            padding: 24px;

            border-radius: 16px;
            background: #fff;

            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .step-number {
            font-size: 30px;
        }

        .step-card h3 {
            margin: 16px 0 0;
        }

        .step-card p {
            margin: 8px 0 0;

            color: #57534e;

            font-size: 14px;
            line-height: 1.6;
        }

        .donation-section { padding: 0 32px 64px; }
        .donation-card {
            max-width: 1216px; margin: 0 auto; padding: 36px 40px;
            display: flex; align-items: center; justify-content: space-between; gap: 24px;
            border-radius: 20px; background: #ecfdf5; border: 1px solid #bbf7d0;
        }
        .donation-card h2 { margin: 8px 0; color: #064e3b; font-size: 28px; }
        .donation-card p { margin: 0; color: #57534e; line-height: 1.6; }
        .donation-contact {
            display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;
            padding: 14px 20px; border-radius: 10px; background: #047857; color: #fff; font-weight: 700;
        }
        .donation-contact:hover { background: #065f46; }

        /* Footer */
        footer {
            padding: 30px;

            background: #022c22;
            color: #d1fae5;

            font-size: 14px;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 1000px) {
            .products-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 800px) {
            header > div {
                padding: 16px 20px;
            }

            header nav {
                display: none;
            }

            .hero-inner {
                display: block;

                padding: 60px 20px;
            }

            .hero h1 {
                font-size: 42px;
            }

            .hero-visual {
                display: none;
            }

            .catalog {
                padding: 50px 20px;
            }

            .catalog-header {
                display: block;
            }

            .product-count {
                margin-top: 10px;
            }

            .search-form {
                grid-template-columns: 1fr;
            }

            .products-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .how-inner {
                padding: 50px 20px;
            }

            .donation-section { padding: 0 20px 50px; }
            .donation-card { align-items: flex-start; flex-direction: column; padding: 28px 24px; }

            .steps-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 36px;
            }
        }
    </style>
</head>

<body>

<header>
    <div>
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="logo">
            <span class="logo-icon">♻</span>
            EcoEntrega
        </a>

        <nav>
            <a href="#catalogo">Explorar</a>
            <a href="#como-funciona">Cómo funciona</a>

            @auth
                {{-- Usuario autenticado --}}
                @if (auth()->user()->isSuperAdmin())
                    <a
                        href="{{ url('/admin') }}"
                        class="nav-admin"
                    >
                        ⚙️ Panel Admin
                    </a>
                @endif

                <a
                    href="{{ route('cart') }}"
                    class="nav-account"
                >
                    🛒 Mi carrito ({{ $cartCount ?? 0 }})
                </a>

                @if (Route::has('account'))
                    <a
                        href="{{ route('account') }}"
                        class="nav-account"
                    >
                        Mi cuenta
                    </a>
                @endif
            @else
                <a
                    href="{{ route('login') }}"
                    class="nav-login"
                >
                    Iniciar sesión
                </a>

                <a
                    href="{{ route('register') }}"
                    class="nav-register"
                >
                    Registrarse
                </a>
            @endauth
        </nav>
    </div>
</header>

<main>

    {{-- Banner de pedido exitoso y alertas --}}
    @if(session('order_success'))
        <div style="max-width:1280px; margin:24px auto 0; padding:0 32px;">
            <div style="background:#ecfdf5; border:2px solid #059669; padding:24px 28px; border-radius:18px; box-shadow:0 8px 30px rgba(5,150,105,0.15); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
                <div>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span style="font-size:32px;">🎉</span>
                        <h2 style="margin:0; color:#064e3b; font-size:22px; font-weight:800;">¡Tu compra se ha realizado con éxito!</h2>
                    </div>
                    <p style="margin:8px 0 0; color:#065f46; font-size:15px; font-weight:600;">
                        Pedido <strong>#{{ session('order_success')['id'] }}</strong> registrado por un valor de <strong>${{ session('order_success')['total'] }}</strong>.
                        Se enviará a: <strong>{{ session('order_success')['address'] }}</strong> (Método: {{ session('order_success')['payment_method'] }}).
                    </p>
                </div>
                <div>
                    <a href="{{ route('account') }}" style="background:#059669; color:#fff; padding:12px 20px; border-radius:10px; font-weight:700; text-decoration:none; font-size:14px; box-shadow:0 4px 12px rgba(5,150,105,0.3); display:inline-block;">
                        Ver en Mis Pedidos →
                    </a>
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div style="max-width:1280px; margin:20px auto 0; padding:0 32px;">
            <div style="background:#dcfce7; color:#166534; padding:14px 20px; border-radius:12px; font-weight:600; border:1px solid #bbf7d0;">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div style="max-width:1280px; margin:20px auto 0; padding:0 32px;">
            <div style="background:#fee2e2; color:#991b1b; padding:14px 20px; border-radius:12px; font-weight:600; border:1px solid #fecaca;">
                ⚠️ {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- HERO --}}
    <section class="hero">
        <div class="hero-inner">

            <div class="hero-content">

                <p class="hero-badge">
                    Moda que vuelve a tener historia
                </p>

                <h1>
                    Viste diferente.<br>
                    <span>Cuida el planeta.</span>
                </h1>

                <p class="hero-description">
                    Encuentra prendas únicas de segunda mano y dale
                    una nueva vida a tu estilo.
                </p>

                <a
                    href="#catalogo"
                    class="hero-button"
                >
                    Ver productos
                </a>

            </div>

            <div class="hero-visual">

                <div class="hero-square hero-square-lime"></div>

                <div class="hero-square hero-square-green">
                    👕
                </div>

                <div class="hero-card">
                    <strong>Circular</strong>
                    <span>Moda responsable</span>
                </div>

            </div>

        </div>
    </section>


    {{-- DONACIONES --}}
    <section class="donation-section" aria-labelledby="donation-title">
        <div class="donation-card">
            <div>
                <p class="eyebrow">Dale otra vida a tu ropa</p>
                <h2 id="donation-title">¿Quieres donar ropa?</h2>
                <p>Nos encantaría recibir prendas en buen estado. Escríbenos para coordinar tu donación.</p>
            </div>

            @if (config('services.donations.whatsapp'))
                @php $donationPhone = preg_replace('/\D+/', '', config('services.donations.whatsapp')); @endphp
                <a class="donation-contact" href="https://wa.me/{{ $donationPhone }}" target="_blank" rel="noopener noreferrer">
                    Contactar por WhatsApp
                </a>
            @else
                <p>Pronto publicaremos aquí nuestro número de contacto.</p>
            @endif
        </div>
    </section>

    {{-- CATÁLOGO --}}
    <section id="catalogo" class="catalog">

        <div class="catalog-header">

            <div>
                <p class="eyebrow">
                    Catálogo
                </p>

                <h2>
                    Encuentra tu próxima prenda
                </h2>
            </div>

            <p class="product-count">
                {{ $products->total() }}

                {{ $products->total() === 1
                    ? 'producto disponible'
                    : 'productos disponibles'
                }}
            </p>

        </div>


        {{-- BUSCADOR --}}
        <form
            method="GET"
            action="{{ url()->current() }}"
            class="search-form"
        >

            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Busca por prenda, color o descripción..."
                aria-label="Buscar productos"
            >

            <select
                name="category"
                aria-label="Filtrar por categoría"
            >
                <option value="">
                    Todas las categorías
                </option>

                @foreach ($categories as $category)

                    <option
                        value="{{ $category->id_category }}"
                        @selected((string) request('category') === (string) $category->id_category)
                    >
                        {{ $category->category_name }}
                    </option>

                @endforeach
            </select>

            <button type="submit">
                Buscar
            </button>

        </form>


        {{-- PRODUCTOS --}}
        @if ($products->isEmpty())

            <div class="empty-state">

                <div class="empty-icon">
                    🌱
                </div>

                <h3>
                    Aún no hay productos para mostrar
                </h3>

                <p>
                    Agrega productos desde el panel de administración
                    para que aparezcan aquí.
                </p>

            </div>

        @else

            <div class="products-grid">

                @foreach ($products as $product)

                    <article class="product-card">

                        <div class="product-image">

                            @if ($product->image)

                                <img
                                    src="{{ $product->image_url }}"
                                    alt="{{ $product->product_name }}"
                                    loading="lazy"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';"
                                >

                                <div
                                    class="image-fallback"
                                    style="display:none;"
                                >
                                    👚
                                    <span>
                                        Imagen no disponible
                                    </span>
                                </div>

                            @else

                                <div class="image-fallback">
                                    👚
                                    <span>
                                        Imagen no disponible
                                    </span>
                                </div>

                            @endif


                            @if ($product->stock <= 0)
                                <span class="condition" style="background:#fee2e2; color:#b91c1c;">
                                    Agotado
                                </span>
                            @elseif ($product->garment_condition)

                                <span class="condition">
                                    {{ $product->garment_condition }}
                                </span>

                            @endif

                        </div>


                        <div class="product-info">

                            <p class="product-category">
                                {{ $product->category?->category_name ?? 'Sin categoría' }}
                            </p>

                            <h3 class="product-title">
                                {{ $product->product_name }}
                            </h3>

                            <div class="product-bottom">

                                <div>

                                    <p class="product-price">
                                        ${{ number_format($product->price, 0, ',', '.') }}
                                    </p>

                                    <p class="product-meta">
                                        Talla {{ $product->size ?? 'N/A' }}
                                        ·
                                        {{ $product->color ?? 'Sin color' }}
                                    </p>

                                </div>

                                <div style="display:flex; gap:6px; align-items:center;">
                                    @if ($product->stock > 0)
                                        <form method="POST" action="{{ route('cart.add', $product) }}" style="margin:0;">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="product-button"
                                                title="Agregar al carrito"
                                                style="padding:9px 12px; font-size:15px; background:#ecfdf5; border-color:#059669; color:#065f46;"
                                            >
                                                🛒
                                            </button>
                                        </form>

                                        <a
                                            href="{{ route('checkout.show', $product) }}"
                                            class="product-button"
                                            style="text-decoration:none; display:inline-block; background:#059669; color:#fff; border-color:#059669; padding:9px 15px; font-weight:800;"
                                        >
                                            Comprar
                                        </a>
                                    @else
                                        <span style="display:inline-block; padding:9px 15px; font-weight:800; background:#f3f4f6; color:#9ca3af; border-radius:9px;">
                                            Agotado
                                        </span>
                                    @endif
                                </div>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- PAGINACIÓN --}}
            @if ($products->hasPages())

                <div class="pagination-wrapper">
                    {{ $products->withQueryString()->links() }}
                </div>

            @endif

        @endif

    </section>


    {{-- CÓMO FUNCIONA --}}
    <section
        id="como-funciona"
        class="how-section"
    >

        <div class="how-inner">

            <p class="eyebrow">
                Simple y sostenible
            </p>

            <h2>
                Así funciona EcoEntrega
            </h2>


            <div class="steps-grid">

                <div class="step-card">

                    <span class="step-number">
                        1️⃣
                    </span>

                    <h3>
                        Explora
                    </h3>

                    <p>
                        Descubre prendas en buen estado
                        publicadas por la comunidad.
                    </p>

                </div>


                <div class="step-card">

                    <span class="step-number">
                        2️⃣
                    </span>

                    <h3>
                        Elige
                    </h3>

                    <p>
                        Encuentra tu talla, color y estilo
                        ideal a un precio justo.
                    </p>

                </div>


                <div class="step-card">

                    <span class="step-number">
                        3️⃣
                    </span>

                    <h3>
                        Da una nueva vida
                    </h3>

                    <p>
                        Reduce residuos y forma parte
                        de una moda más consciente.
                    </p>

                </div>

            </div>

        </div>

    </section>

</main>


<footer>
    © {{ now()->year }}
    EcoEntrega · Moda circular para un futuro mejor.
</footer>

</body>
</html>
