<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Carrito de Compras - Frategar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --despegar-blue: #0066cc;
            --despegar-orange: #ff6600;
            --despegar-light-blue: #e6f3ff;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--despegar-blue) !important;
        }
        
        .breadcrumb-section {
            background-color: #f8f9fa;
            padding: 15px 0;
        }
        
        .breadcrumb-item a {
            color: var(--despegar-blue);
            text-decoration: none;
        }
        
        .breadcrumb-item a:hover {
            color: var(--despegar-orange);
        }
        
        .cart-header {
            background: linear-gradient(135deg, var(--despegar-blue) 0%, #004499 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }
        
        .cart-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 20px;
        }
        
        .cart-item {
            border: 1px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        
        .cart-item:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
            background-color: var(--despegar-light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .item-details h6 {
            color: var(--despegar-blue);
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .item-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--despegar-orange);
        }
        
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .quantity-btn {
            width: 35px;
            height: 35px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .quantity-btn:hover {
            background-color: var(--despegar-blue);
            color: white;
            border-color: var(--despegar-blue);
        }
        
        .quantity-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 8px;
        }
        
        .remove-item {
            color: #dc3545;
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }
        
        .remove-item:hover {
            color: #c82333;
            transform: scale(1.1);
        }
        
        .summary-card {
            background: var(--despegar-light-blue);
            border-radius: 15px;
            padding: 25px;
            position: sticky;
            top: 20px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(0,102,204,0.2);
        }
        
        .summary-row:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 1.1rem;
            color: var(--despegar-blue);
        }
        
        .btn-checkout {
            background-color: var(--despegar-orange);
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            font-weight: bold;
            color: white;
            font-size: 1.1rem;
            width: 100%;
            margin-bottom: 15px;
        }
        
        .btn-checkout:hover {
            background-color: #e55a00;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-continue {
            background-color: transparent;
            border: 2px solid var(--despegar-blue);
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: bold;
            color: var(--despegar-blue);
            width: 100%;
        }
        
        .btn-continue:hover {
            background-color: var(--despegar-blue);
            color: white;
        }
        
        .promo-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .promo-input {
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        
        .btn-promo {
            background-color: var(--despegar-blue);
            border: none;
            color: white;
            border-radius: 8px;
            padding: 8px 20px;
        }
        
        .btn-promo:hover {
            background-color: #0052a3;
            color: white;
        }
        
        .security-badges {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        
        .security-badge {
            background: white;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
            flex: 1;
        }
        
        .security-badge i {
            color: var(--despegar-blue);
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        
        .empty-cart i {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }
        
        .footer-section {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
        }
        
        .progress-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .step {
            display: flex;
            align-items: center;
            color: #6c757d;
        }
        
        .step.active {
            color: var(--despegar-blue);
            font-weight: bold;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
        }
        
        .step.active .step-number {
            background-color: var(--despegar-blue);
            color: white;
        }
        
        .step-divider {
            width: 50px;
            height: 2px;
            background-color: #e9ecef;
            margin: 0 15px;
        }
        
        .savings-alert {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .item-tag {
            background-color: var(--despegar-orange);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
        }
        
        .flight-route {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 5px 0;
        }
        
        .route-arrow {
            color: var(--despegar-blue);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-plane text-primary"></i> Frategar
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-plane"></i> Vuelos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-bed"></i> Hoteles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-suitcase"></i> Paquetes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-car"></i> Autos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-ship"></i> Cruceros</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.html"><i class="fas fa-user"></i> Mi cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-headset"></i> Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Vuelos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carrito</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-4">
        <!-- Progress Steps -->
        <div class="progress-steps">
            <div class="step active">
                <div class="step-number">1</div>
                <span>Carrito</span>
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <div class="step-number">2</div>
                <span>Datos</span>
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <div class="step-number">3</div>
                <span>Pago</span>
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <div class="step-number">4</div>
                <span>Confirmación</span>
            </div>
        </div>

        <!-- Cart Header -->
        <div class="cart-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">Tu carrito de compras</h2>
                    <p class="mb-0">Revisá los detalles de tu viaje antes de continuar</p>
                </div>
                <div class="text-end">
                    <div class="h4 mb-0">3 productos</div>
                    <small>en tu carrito</small>
                </div>
            </div>
        </div>

        <!-- Savings Alert -->


        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="cart-card">
                    <h5 class="mb-4"><i class="fas fa-shopping-cart text-primary me-2"></i>Productos en tu carrito</h5>
                    @php $cart = session('cart', []); @endphp
                    @if(count($cart) === 0)
                        <div class="empty-cart">
                            <i class="fas fa-shopping-cart"></i>
                            <p>Tu carrito está vacío.<br>Agrega productos para verlos aquí.</p>
                        </div>
                    @else
                        @foreach($cart as $key => $item)
                        <div class="cart-item">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="item-image">
                                        @if(isset($item['imagen']))
                                            <img src="{{ $item['imagen'] }}" alt="{{ $item['nombre'] }}" class="img-fluid rounded">
                                        @else
                                            <i class="fas fa-box-open fa-2x text-primary"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="item-details">
                                        <h6 class="mb-1">{{ $item['nombre'] }}</h6>
                                        @if(isset($item['descripcion']))
                                            <p class="text-muted mb-1">{{ $item['descripcion'] }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="quantity-controls">
                                        <input type="number" class="quantity-input" value="{{ $item['cantidad'] }}" min="1" onchange="updateCartItem('{{ $key }}', this.value)">
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <div class="item-price">${{ number_format($item['precio'], 2, ',', '.') }}</div>
                                    <small class="text-muted">${{ number_format($item['precio'], 2, ',', '.') }} x {{ $item['cantidad'] }}</small>
                                    <div class="mt-2">
    <i class="fas fa-trash remove-item" style="cursor:pointer;" onclick="removeCartItem('{{ $key }}')" title="Eliminar"></i>
</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>



                <!-- Continue Shopping -->
                <div class="text-center">
                    <a href="index.html" class="btn btn-continue">
                        <i class="fas fa-arrow-left me-2"></i>Continuar comprando
                    </a>
                </div>
            </div>

            <!-- Summary Sidebar -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h5 class="mb-4 text-center">Resumen de compra</h5>
                    
                    @php
                        $cart = session('cart', []);
                        $subtotal = 0;
                    @endphp
                    @foreach($cart as $item)
                        @php $subtotal += $item['precio'] * $item['cantidad']; @endphp
                    @endforeach
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>${{ number_format($subtotal, 2, ',', '.') }}</span>
                    </div>
                    <hr>
                    <div class="summary-row">
                        <span>Total</span>
                        <span>${{ number_format($subtotal, 2, ',', '.') }}</span>
                    </div>
                    <button class="btn btn-checkout mt-4">
                        <i class="fas fa-credit-card me-2"></i>Proceder al pago
                    </button>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1"></i>
                            Compra 100% segura y protegida
                        </small>
                    </div>
                </div>

                <!-- Security Badges -->
                <div class="security-badges">
                    <div class="security-badge">
                        <i class="fas fa-lock"></i>
                        <div style="font-size: 0.8rem;">SSL</div>
                    </div>
                    <div class="security-badge">
                        <i class="fas fa-shield-alt"></i>
                        <div style="font-size: 0.8rem;">Seguro</div>
                    </div>
                    <div class="security-badge">
                        <i class="fas fa-credit-card"></i>
                        <div style="font-size: 0.8rem;">Pagos</div>
                    </div>
                </div>

                <!-- Help Section -->
                <div class="cart-card mt-3">
                    <h6><i class="fas fa-headset text-primary me-2"></i>¿Necesitás ayuda?</h6>
                    <p class="mb-2">Nuestros expertos están disponibles 24/7</p>
                    <p class="mb-0">
                        <strong>+54 11 4000-1234</strong><br>
                        <small class="text-muted">Llamada gratuita</small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5>Frategar</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Quiénes somos</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Trabaja con nosotros</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Prensa</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Inversores</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 mb-4">
                    <h5>Productos</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Vuelos</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Hoteles</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Paquetes</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Autos</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 mb-4">
                    <h5>Ayuda</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Centro de ayuda</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Contacto</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Términos y condiciones</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Privacidad</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 mb-4">
                    <h5>Síguenos</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2025 Frategar. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
    <script src="/js/cart.js"></script>
</html>