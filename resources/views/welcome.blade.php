<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Website</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
        <style>
            :root {
            --primary-color: #6c5ce7;
            --secondary-color: #a29bfe;
            --dark-color: #2d3436;
            --light-color: #f5f6fa;
            --accent-color: #fd79a8;
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
        

        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            padding: 5rem 0;
        }
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #0d6efd;
        }
        .feature-card {
            transition: transform 0.3s;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .tip-box {
            background-color: #e7f1ff;
            border-left: 4px solid #0d6efd;
        }
    </style>

</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-utensils"></i> Cafe Express
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            

  
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <div class="navbar-nav">
        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
          <i class="fas fa-sign-in-alt me-1" ></i> Login
        </a>
        <a href="{{ route('register') }}" class="btn btn-primary">
          <i class="fas fa-user-plus me-1"></i> Register
        </a>
      </div>
    </div>
  </div>
</nav>
<!-- Hero Section -->
    <section class="hero-section text-white text-center mb-5">
        <div class="container py-5">
            <h1 class="display-4 fw-bold mb-3">Welcome to Cafe Express</h1>
            <p class="lead fs-4 mb-4">Your Complete Restaurant Management Solution</p>
            <p class="mb-5">Streamline every aspect of your restaurant operations with our intuitive system that puts you in complete control.</p>
            <a href="#features" class="btn btn-primary btn-lg animate__animated animate__fadeInUp animate__delay-2s">
                <i class="fas fa-arrow-down me-2"></i>Explore Features
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="container mb-5">
        <div class="row g-4">
            <!-- Customer Management -->
            <div class="col-md-4">
                <div class="card feature-card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-users feature-icon"></i>
                            <h3>Customer Management</h3>
                            <p class="text-muted">Build loyalty through personalized service</p>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> 360° Customer Profiles</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> VIP Recognition</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Marketing Tools</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Feedback System</li>
                        </ul>
                        <div class="tip-box p-3 rounded-end mb-3">
                            <strong>Tip:</strong> Use the notes field to record allergies or favorite tables.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Management -->
            <div class="col-md-4">
                <div class="card feature-card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-utensils feature-icon"></i>
                            <h3>Menu Management</h3>
                            <p class="text-muted">Your digital menu command center</p>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Real-Time Updates</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Ingredient-Level Tracking</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Menu Analytics</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Seasonal Flexibility</li>
                        </ul>
                        <div class="tip-box p-3 rounded-end mb-3">
                            <strong>Did you know?</strong> Items with photos get 30% more orders.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Processing -->
            <div class="col-md-4">
                <div class="card feature-card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-clipboard-list feature-icon"></i>
                            <h3>Order Processing</h3>
                            <p class="text-muted">From kitchen to table seamlessly</p>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Table Mapping</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Kitchen Display</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Payment Integration</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Reporting Suite</li>
                        </ul>
                        <div class="tip-box p-3 rounded-end mb-3">
                            <strong>Pro Tip:</strong> Color-code rush orders during peaks.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="bg-light py-5 mb-5">
        <div class="container">
            <h2 class="text-center mb-5">Why Restaurants Love Cafe Express</h2>
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="p-3">
                        <i class="fas fa-bolt fa-2x text-success mb-3"></i>
                        <h4>30% faster</h4>
                        <p class="text-muted">order-to-table time</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="p-3">
                        <i class="fas fa-users fa-2x text-success mb-3"></i>
                        <h4>22% increase</h4>
                        <p class="text-muted">in repeat customers</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="p-3">
                        <i class="fas fa-recycle fa-2x text-success mb-3"></i>
                        <h4>15% reduction</h4>
                        <p class="text-muted">in food waste</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="p-3">
                        <i class="fas fa-headset fa-2x text-success mb-3"></i>
                        <h4>24/7 support</h4>
                        <p class="text-muted">from hospitality experts</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded shadow-sm mt-4 w-75 mx-auto">
                <blockquote class="blockquote mb-0">
                    <p class="fst-italic">"Since implementing Cafe Express, our dinner service runs smoother than ever before."</p>
                </blockquote>
            </div>
        </div>
    </section>

    
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">© 2025 Cafe Express. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
