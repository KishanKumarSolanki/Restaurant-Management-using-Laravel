<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Express - Home </title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --secondary-color: #a29bfe;
            --dark-color: #2d3436;
            --light-color: #f5f6fa;
            --accent-color: #fd79a8;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        /* Navbar Styles */
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, var(--dark-color), #3d3d3d) !important;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 0.3rem;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            background-color: var(--primary-color);
        }
        
        /* Banner Styles */
        .banner {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('{{ asset("img/bg5.jpg") }}') no-repeat center center;
            background-size: cover;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .banner::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            background: linear-gradient(to bottom, transparent, var(--light-color));
        }
        
        .banner-content {
            z-index: 1;
            animation: fadeInUp 1s ease;
        }
        
        .banner h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }
        
        .banner p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 2rem;
        }
        
        /* Card Styles */
        .card-container {
            margin-top: -80px;
            position: relative;
            z-index: 10;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            background-color: white;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        
        .card-img-top {
            height: 180px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .card:hover .card-img-top {
            transform: scale(1.05);
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .card-title {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.75rem;
        }
        
        .card-text {
            color: #666;
            margin-bottom: 1.5rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #5649d6;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.4);
        }
        
        /* Features Section */
        .features-section {
            padding: 5rem 0;
            background-color: white;
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        /* Footer Styles */
        footer {
            background: linear-gradient(135deg, var(--dark-color), #3d3d3d);
            color: white;
            padding: 2rem 0;
            margin-top: 5rem;
        }
        
        .social-icons {
            margin: 1rem 0;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .banner h1 {
                font-size: 2.5rem;
            }
            
            .banner {
                height: 300px;
            }
            
            .card-container {
                margin-top: -50px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-utensils"></i> Cafe Express
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('customers*') ? 'active' : '' }}" href="{{ url('/customers') }}">
                        <i class="fas fa-users"></i> Customers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('items*') ? 'active' : '' }}" href="{{ url('/items') }}">
                        <i class="fas fa-utensils"></i> Menu Items
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}" href="{{ url('/orders') }}">
                        <i class="fas fa-receipt"></i> Orders
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <!-- Dashboard Button (Right Side) -->
                <a class="btn btn-outline-light btn-sm {{ request()->is('dashboard*') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                    <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                </a>
                
                <!-- Logout Button -->
                <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>
    <!-- Banner Section -->
    <div class="banner animate__animated animate__fadeIn">
        <div class="banner-content">
            <h1 class="animate__animated animate__fadeInDown">Welcome to Cafe Express</h1>
            <p class="animate__animated animate__fadeInUp animate__delay-1s">Streamline your restaurant operations with our powerful management system</p>
            <a href="#features" class="btn btn-primary btn-lg animate__animated animate__fadeInUp animate__delay-2s">
                <i class="fas fa-arrow-down me-2"></i>Explore Features
            </a>
        </div>
    </div>

    <!-- Cards Section -->
    <div class="container card-container">
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="card">
                    <img src="{{ asset('img/bg6.jpg') }}" class="card-img-top" alt="Customer Management">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-users me-2"></i>Customers
                        </h5>
                        <p class="card-text">Manage all customer information, track preferences, and build lasting relationships with your patrons.</p>
                        <a href="{{ url('/customers') }}" class="btn btn-primary">
                            <i class="fas fa-cog me-1"></i> Manage Customers
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-1s">
                <div class="card">
                    <img src="{{ asset('img/bg3.jpg') }}" class="card-img-top" alt="Menu Management">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-utensils me-2"></i>Menu Items
                        </h5>
                        <p class="card-text">Create, update, and organize your restaurant's menu items with categories, prices, and descriptions.</p>
                        <a href="{{ url('/items') }}" class="btn btn-primary">
                            <i class="fas fa-cog me-1"></i> Manage Menu
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-2s">
                <div class="card">
                    <img src="{{ asset('img/bg1.jpg') }}" class="card-img-top" alt="Order Management">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-receipt me-2"></i>Orders
                        </h5>
                        <p class="card-text">Process orders efficiently, track order status, and manage kitchen workflow seamlessly.</p>
                        <a href="{{ url('/orders') }}" class="btn btn-primary">
                            <i class="fas fa-cog me-1"></i> Manage Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold">Powerful Features</h2>
                <p class="lead text-muted">Everything you need to run your restaurant efficiently</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>Real-time Analytics</h4>
                    <p class="text-muted">Track sales, popular items, and customer trends with our comprehensive dashboard.</p>
                </div>
                
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h4>Instant Notifications</h4>
                    <p class="text-muted">Get alerts for new orders, low inventory, and important updates in real-time.</p>
                </div>
                
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4>Mobile Friendly</h4>
                    <p class="text-muted">Access your restaurant data from anywhere with our fully responsive interface.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <h5><i class="fas fa-utensils me-2"></i>Cafe Express</h5>
                    <p>Streamlining restaurant operations since 2023</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                    <p class="mb-0">© 2025 Cafe Express. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple animation trigger on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.animate__animated');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const animation = entry.target.getAttribute('data-animation');
                        entry.target.classList.add(animation);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            
            animatedElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
</body>
</html>