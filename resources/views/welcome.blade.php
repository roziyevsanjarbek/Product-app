<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to EGS Products</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #ffffff;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 4%;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2563eb;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #2563eb;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-login {
            background-color: transparent;
            color: #333;
            border: none;
            padding: 0.6rem 1.5rem;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            color: #2563eb;
        }

        .btn-signup {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            padding: 0.6rem 1.5rem;
            font-size: 1rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-signup:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        /* Hero Section */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5rem 4%;
            gap: 3rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .hero-content {
            flex: 1;
            min-width: 0;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .hero p {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 2rem;
            line-height: 1.8;
            max-width: 600px;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-primary {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            padding: 0.8rem 2.5rem;
            font-size: 1rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-secondary {
            background-color: transparent;
            color: #2563eb;
            border: 2px solid #2563eb;
            padding: 0.8rem 2.5rem;
            font-size: 1rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #eff6ff;
            transform: translateY(-2px);
        }

        .hero-image {
            flex: 1;
            min-width: 0;
            /* linear-gradient o'rniga yoki unga qo'shib rasm qo'yish mumkin */
            background-image: url('https://product.websol.uz/storage/app/public/egs.jpg');
            background-size: cover;       /* rasm bo'limni to'liq qamrab oladi */
            background-position: center;  /* rasm markazda joylashadi */
            background-repeat: no-repeat; /* rasm takrorlanmasligi */
            border-radius: 15px;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: 600;
        }


        /* Stats Section */
        .stats {
            background-color: #f9fafb;
            padding: 4rem 4%;
        }

        .stats-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .stat-card {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 0.5rem;
        }

        .stat-text {
            color: #6b7280;
            font-size: 1rem;
        }

        /* CTA Section */
        .cta {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 4rem 4%;
            text-align: center;
        }

        .cta-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .cta p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .cta-button {
            background-color: #ffffff;
            color: #667eea;
            border: none;
            padding: 0.8rem 2.5rem;
            font-size: 1rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background-color: #1f2937;
            color: #ffffff;
            padding: 3rem 4%;
            text-align: center;
        }

        footer p {
            opacity: 0.8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                padding: 3rem 4%;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero-image {
                height: 300px;
            }

            .nav-links {
                gap: 1rem;
                font-size: 0.9rem;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
            }

            .cta h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
<!-- Navigation -->
<nav>
    <div class="logo">EGS Product</div>
    <div class="nav-buttons">
        <a href="{{ route('login') }}" class="btn-signup">Log in</a>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Welcome to EGS Products</h1>
    </div>
    <div class="hero-image">
        
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-number">10K+</div>
            <div class="stat-text">Active Users</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">500+</div>
            <div class="stat-text">Successful Projects</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">99.9%</div>
            <div class="stat-text">Uptime Guarantee</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">24/7</div>
            <div class="stat-text">Customer Support</div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="cta-container">
        <h2>Ready to Get Started?</h2>
        <p>Join thousands of users building amazing applications with our platform.</p>
        <button class="cta-button">Start Free Trial</button>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 EGS. All rights reserved.</p>
</footer>
</body>
</html>
