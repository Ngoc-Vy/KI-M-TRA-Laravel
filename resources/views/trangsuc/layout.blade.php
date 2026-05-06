<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUMIÈRE | Jewelry</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- NProgress for smooth loading bar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-charcoal: #121212;
            --soft-white: #fdfdfd;
            --gray-text: #888888;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--soft-white);
            color: var(--dark-charcoal);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, .brand-logo {
            font-family: 'Playfair Display', serif;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: 0.3s ease;
        }

        /* Glassmorphism Navbar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            background: rgba(253, 253, 253, 0.8);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            z-index: 1000;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar.scrolled {
            padding: 12px 5%;
            background: rgba(253, 253, 253, 0.95);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .brand-logo {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--dark-charcoal);
        }

        .brand-logo span {
            color: var(--primary-gold);
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .nav-links li a {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }

        .nav-links li a:hover {
            color: var(--primary-gold);
        }

        .nav-icons {
            display: flex;
            gap: 20px;
            font-size: 1.2rem;
        }

        .nav-icons a:hover {
            color: var(--primary-gold);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(rgba(18, 18, 18, 0.6), rgba(18, 18, 18, 0.6)), url('https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover;
            color: var(--soft-white);
            padding-top: 80px;
        }

        .hero-content h1 {
            font-size: 4.5rem;
            margin-bottom: 10px;
            font-weight: 600;
            letter-spacing: 4px;
            animation: fadeInDown 1s ease;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            font-weight: 300;
            animation: fadeInUp 1s ease 0.3s;
            animation-fill-mode: both;
        }

        .btn-gold {
            display: inline-block;
            padding: 12px 35px;
            background-color: var(--primary-gold);
            color: var(--soft-white);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
            animation: fadeInUp 1s ease 0.6s;
            animation-fill-mode: both;
        }

        .btn-gold:hover {
            background-color: #bfa136;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.6);
        }

        /* Section Headings */
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background-color: var(--primary-gold);
        }

        /* Footer */
        footer {
            background-color: var(--dark-charcoal);
            color: var(--soft-white);
            padding: 60px 5% 30px;
            text-align: center;
        }

        .footer-logo {
            font-size: 2.5rem;
            margin-bottom: 20px;
            display: inline-block;
        }

        .footer-logo span {
            color: var(--primary-gold);
        }

        .footer-links {
            margin-bottom: 30px;
        }

        .footer-links a {
            margin: 0 15px;
            color: var(--gray-text);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        .footer-links a:hover {
            color: var(--primary-gold);
        }

        .copyright {
            color: var(--gray-text);
            font-size: 0.9rem;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        /* Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Global Fade-in for content */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        main {
            min-height: 80vh;
        }
    </style>
    @yield('css')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('trangsuc.index') }}" class="brand-logo">LUMIÈRE<span>.</span></a>
        <ul class="nav-links">
            <li><a href="{{ route('trangsuc.index') }}">Trang chủ</a></li>
            <li style="position:relative; display:inline-block;" class="dropdown">
                <a href="#">Bộ Sưu Tập <i class="fa-solid fa-angle-down"></i></a>
                <div class="dropdown-content" style="display:none; position:absolute; top:100%; left:0; background:#fff; padding:15px; box-shadow:0 10px 30px rgba(0,0,0,0.1); border-radius:4px; min-width:200px;">
                    @foreach($categories as $cat)
                        <a href="{{ route('trangsuc.category', $cat->id) }}" style="display:block; padding:8px 0; color:#333;">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </li>
            <li><a href="{{ route('trangsuc.contact') }}">Liên Hệ</a></li>
        </ul>
        <div class="nav-icons">
            <form action="{{ route('trangsuc.search') }}" method="GET" style="display:inline; margin-right:15px;">
                <input type="text" name="s" placeholder="Tìm kiếm..." style="border:none; border-bottom:1px solid #ccc; outline:none; width:120px; background:transparent;">
                <button type="submit" style="background:none; border:none; cursor:pointer;"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <a href="{{ route('trangsuc.wishlist') }}" title="Yêu Thích"><i class="fa-regular fa-heart"></i></a>
            <a href="{{ route('trangsuc.cart') }}" title="Giỏ Hàng"><i class="fa-solid fa-cart-shopping"></i></a>
            <a href="{{ route('trangsuc.profile') }}" title="Tài Khoản"><i class="fa-regular fa-user"></i></a>
            @if(Auth::check())
                <a href="{{ route('trangsuc.logout') }}" title="Đăng Xuất" style="font-size: 1rem;"><i class="fa-solid fa-sign-out"></i></a>
            @endif
        </div>
    </nav>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Dropdown script
        document.addEventListener('DOMContentLoaded', function() {
            NProgress.start();
            
            const dropdown = document.querySelector('.dropdown');
            if(dropdown) {
                dropdown.addEventListener('mouseenter', function() {
                    this.querySelector('.dropdown-content').style.display = 'block';
                });
                dropdown.addEventListener('mouseleave', function() {
                    this.querySelector('.dropdown-content').style.display = 'none';
                });
            }

            // Reveal animations on scroll
            function reveal() {
                var reveals = document.querySelectorAll(".reveal");
                for (var i = 0; i < reveals.length; i++) {
                    var windowHeight = window.innerHeight;
                    var elementTop = reveals[i].getBoundingClientRect().top;
                    var elementVisible = 150;
                    if (elementTop < windowHeight - elementVisible) {
                        reveals[i].classList.add("active");
                    }
                }
            }
            window.addEventListener("scroll", reveal);
            reveal(); // Initial check
            
            setTimeout(() => {
                NProgress.done();
            }, 500);
        });
    </script>

    <main>
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px 20px; text-align: center; font-weight: 500; font-size: 1.1rem; margin-top: 80px;">
                <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px 20px; text-align: center; font-weight: 500; font-size: 1.1rem; margin-top: 80px;">
                <i class="fa-solid fa-circle-exclamation" style="margin-right: 8px;"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <a href="#" class="brand-logo footer-logo">LUMIÈRE<span>.</span></a>
        <div class="footer-links">
            <a href="#">Chính Sách Bán Hàng</a>
            <a href="#">Bảo Hành</a>
            <a href="#">Liên Hệ</a>
            <a href="#">Vận Chuyển</a>
        </div>
        <div class="nav-icons" style="justify-content: center; margin-bottom: 20px;">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
        </div>
        <div class="copyright">
            &copy; 2026 LUMIÈRE Jewelry. All Rights Reserved.
        </div>
    </footer>

    @include('trangsuc.partials.chat_bubble')

    @yield('js')
</body>
</html>
