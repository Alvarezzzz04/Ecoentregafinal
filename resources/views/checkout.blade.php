<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finalizar Compra | EcoEntrega</title>
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
            font-size: 18px;
        }
        .container {
            max-width: 1000px;
            margin: 36px auto;
            padding: 0 20px;
        }
        .page-title {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 24px;
        }
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 28px;
        }
        .card {
            background: #fff;
            border-radius: 16px;
            padding: 26px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        .card-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 18px;
            color: #065f46;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            transition: border-color .2s;
        }
        .form-control:focus {
            outline: none;
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.15);
        }
        .payment-methods {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }
        .payment-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            cursor: pointer;
            transition: all .2s;
        }
        .payment-option:hover {
            border-color: #059669;
            background: #f0fdf4;
        }
        .payment-option input[type="radio"] {
            accent-color: #059669;
            width: 17px;
            height: 17px;
        }
        .item-row {
            display: flex;
            gap: 14px;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .item-row:last-child {
            border-bottom: 0;
        }
        .item-thumb {
            width: 54px;
            height: 54px;
            border-radius: 8px;
            background: #f1f5f9;
            display: grid;
            place-items: center;
            font-size: 24px;
            overflow: hidden;
            flex-shrink: 0;
        }
        .item-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .item-info {
            flex-grow: 1;
        }
        .item-info h4 {
            margin: 0 0 4px;
            font-size: 14px;
            color: #0f172a;
        }
        .item-info p {
            margin: 0;
            font-size: 12px;
            color: #64748b;
        }
        .item-price {
            font-weight: 700;
            color: #065f46;
            font-size: 15px;
            text-align: right;
        }
        .summary-total {
            margin-top: 18px;
            padding-top: 16px;
            border-top: 2px dashed #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 19px;
            font-weight: 800;
            color: #064e3b;
        }
        .btn-submit {
            width: 100%;
            margin-top: 22px;
            padding: 15px;
            border: 0;
            border-radius: 12px;
            background: #059669;
            color: #fff;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(5, 150, 105, 0.35);
            transition: background .2s, transform .1s;
        }
        .btn-submit:hover {
            background: #047857;
        }
        .btn-submit:active {
            transform: scale(0.98);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 14px;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
        }
        .back-link:hover {
            color: #059669;
        }
        .badge-mode {
            display: inline-block;
            background: #d1fae5;
            color: #065f46;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 12px;
        }
        @media(max-width: 820px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('home') }}">♻ EcoEntrega</a>
        <a href="{{ route('cart') }}" style="font-size:14px;font-weight:500;">🛒 Volver al carrito</a>
    </header>

    <main class="container">
        <h1 class="page-title">Finalizar tu Compra</h1>

        <form method="POST" action="{{ route('checkout.process') }}">
            @csrf
            <input type="hidden" name="mode" value="{{ $mode }}">
            @if($mode === 'single' && $product)
                <input type="hidden" name="product_id" value="{{ $product->id_product }}">
                <input type="hidden" name="quantity" value="1">
            @endif

            <div class="checkout-grid">
                {{-- Formulario de entrega y pago --}}
                <div class="card">
                    <div class="badge-mode">
                        {{ $mode === 'single' ? '⚡ Compra directa de producto' : '🛒 Compra de todo el carrito' }}
                    </div>

                    <h2 class="card-title">📍 Datos de Envío</h2>

                    <div class="form-group">
                        <label for="shipping_address">Dirección completa de entrega *</label>
                        <input
                            type="text"
                            id="shipping_address"
                            name="shipping_address"
                            class="form-control"
                            placeholder="Ej: Calle 45 # 12-34, Apto 302, Barrio Laureles, Medellín"
                            value="{{ old('shipping_address', $client?->address) }}"
                            required
                        >
                        @error('shipping_address')
                            <small style="color:#ef4444;font-size:12px;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="shipping_phone">Teléfono de contacto / WhatsApp *</label>
                        <input
                            type="tel"
                            id="shipping_phone"
                            name="shipping_phone"
                            class="form-control"
                            placeholder="Ej: 300 123 4567"
                            value="{{ old('shipping_phone', $client?->phone) }}"
                            required
                        >
                        @error('shipping_phone')
                            <small style="color:#ef4444;font-size:12px;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="notes">Notas o indicaciones para el repartidor (opcional)</label>
                        <textarea
                            id="notes"
                            name="notes"
                            class="form-control"
                            rows="2"
                            placeholder="Ej: Dejar en portería o llamar antes de llegar..."
                        >{{ old('notes') }}</textarea>
                    </div>

                    <h2 class="card-title" style="margin-top:28px;">💳 Método de Pago</h2>

                    <div class="payment-methods">
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="Contraentrega" checked>
                            <div>
                                <strong>💵 Pago Contra Entrega</strong>
                                <div style="font-size:12px;color:#64748b;">Pagas en efectivo o transferencia al recibir tu pedido</div>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="Nequi" {{ old('payment_method') === 'Nequi' ? 'checked' : '' }}>
                            <div>
                                <strong>🟣 Nequi</strong>
                                <div style="font-size:12px;color:#64748b;">Transferencia directa por Nequi</div>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="Daviplata" {{ old('payment_method') === 'Daviplata' ? 'checked' : '' }}>
                            <div>
                                <strong>🔴 Daviplata</strong>
                                <div style="font-size:12px;color:#64748b;">Transferencia rápida por Daviplata</div>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="Transferencia Bancaria" {{ old('payment_method') === 'Transferencia Bancaria' ? 'checked' : '' }}>
                            <div>
                                <strong>🏦 Transferencia Bancaria</strong>
                                <div style="font-size:12px;color:#64748b;">Bancolombia, Davivienda, etc.</div>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="Tarjeta de Crédito" {{ old('payment_method') === 'Tarjeta de Crédito' ? 'checked' : '' }}>
                            <div>
                                <strong>💳 Tarjeta de Crédito / Débito</strong>
                                <div style="font-size:12px;color:#64748b;">Visa, Mastercard, American Express</div>
                            </div>
                        </label>
                    </div>
                    @error('payment_method')
                        <small style="color:#ef4444;font-size:12px;">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Resumen del pedido --}}
                <div class="card" style="height: fit-content;">
                    <h2 class="card-title">🛍️ Resumen del Pedido</h2>

                    <div>
                        @foreach($items as $item)
                            <div class="item-row">
                                <div class="item-thumb">
                                    @if($item['product']->image)
                                        <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->product_name }}" onerror="this.parentElement.innerHTML='👚'">
                                    @else
                                        👚
                                    @endif
                                </div>
                                <div class="item-info">
                                    <h4>{{ $item['product']->product_name }}</h4>
                                    <p>Talla: {{ $item['product']->size ?? 'Única' }} · Cant: {{ $item['quantity'] }}</p>
                                </div>
                                <div class="item-price">
                                    ${{ number_format($item['subtotal'], 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="summary-total">
                        <span>Total a pagar</span>
                        <span>${{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn-submit">
                        ✅ Confirmar y Pagar
                    </button>

                    <a href="{{ route('home') }}" class="back-link">
                        ← Continuar explorando productos
                    </a>
                </div>
            </div>
        </form>
    </main>
</body>
</html>
