<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        :root {
            --primary: #FFC000;
            --accent1: #C13608;
            --accent2: #D24C0E;
            --accent3: #DE681B;
            --light: #ffffff;
            --light-bg: #f8f9fa;
            --text: #333333;
            --text-light: #666666;
            --border: #e0e0e0;
            --shadow: rgba(0, 0, 0, 0.05);
            --card-shadow: rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Header Styles */
        header {
            background-color: var(--light);
            padding: 0.8rem 5%;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid var(--border);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 2.3rem;
            font-weight: 700;
            color: var(--accent1);
            text-decoration: none;
            display: flex;
            align-items: center;
            font-family: 'Informal Roman', 'Montserrat', sans-serif;
        }

        .logo span {
            color: var(--primary);
            font-family: 'Informal Roman', 'Montserrat', sans-serif;
        }

        .search-bar {
            display: flex;
            background: var(--light-bg);
            border-radius: 30px;
            overflow: hidden;
            border: 1px solid var(--border);
            transition: box-shadow 0.3s;
        }

        .search-bar:focus-within {
            box-shadow: 0 0 0 2px var(--primary);
        }

        .search-bar input {
            width: 100%;
            padding: 0.8rem 1.5rem;
            border: none;
            background: transparent;
            font-size: 1rem;
            outline: none;
        }

        .search-bar button {
            background: var(--primary);
            border: none;
            padding: 0 1.5rem;
            cursor: pointer;
            color: var(--text);
            font-weight: 500;
            transition: background 0.3s;
        }

        .search-bar button:hover {
            background: #e6ac00;
        }

        #search-form {
            position: relative;
            flex: 0 0 45%;
        }

        #search-suggestions {
            position: absolute;
            top: calc(100% + 5px);
            left: 0;
            width: 100%;
            background: var(--light);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            z-index: 1000;
            overflow: hidden;
            display: none;
            border: 1px solid var(--border);
            max-height: 350px;
            overflow-y: auto;
        }

        #search-suggestions div {
            padding: 12px 20px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        #search-suggestions div:last-child {
            border-bottom: none;
        }

        #search-suggestions div:hover {
            background: rgba(255, 192, 0, 0.1);
        }

        #search-suggestions div span {
            font-weight: 500;
            color: var(--text);
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #search-suggestions div small {
            font-size: 0.8rem;
            color: var(--text-light);
            background: rgba(193, 54, 8, 0.1);
            padding: 3px 8px;
            border-radius: 20px;
            margin-left: 10px;
        }

        #search-suggestions div.highlighted {
            background: rgba(255, 192, 0, 0.15);
            padding-left: 25px;
        }

        .nav-icons {
            display: flex;
            gap: 1.8rem;
            position: relative;
        }

        .icon-link {
            color: var(--text);
            text-decoration: none;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .icon-link:hover {
            color: var(--accent1);
        }

        .icon-link i {
            font-size: 1.4rem;
            margin-bottom: 0.2rem;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent1);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Enhanced Account Dropdown */
        .account-dropdown {
            position: relative;
            display: inline-block;
            z-index: 1000;
        }

        .dropdown-content {
            position: absolute;
            top: calc(100% + 10px);
            right: -100px;
            background-color: var(--light);
            min-width: 280px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            border-radius: 16px;
            z-index: 100;
            padding: 20px 10px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px) scale(0.95);
            transform-origin: top right;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .account-dropdown:hover .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .dropdown-content-clicked {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .dropdown-header {
            padding: 0 25px 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent3), var(--accent1));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            margin-bottom: 3px;
            color: var(--text);
        }

        .user-email {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .dropdown-content a,
        .dropdown-content button {
            color: var(--text);
            padding: 14px 25px;
            border-radius: 10px;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .dropdown-content button {
            width: 100%;
        }

        .dropdown-content a::before,
        .dropdown-content button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 192, 0, 0.1), transparent);
            transition: 0.5s;
        }

        .dropdown-content a:hover::before,
        .dropdown-content button:hover::before {
            left: 100%;
        }

        .dropdown-content a:hover,
        .dropdown-content button:hover {
            background-color: rgba(255, 192, 0, 0.08);
            color: var(--accent1);
            padding-left: 30px;
        }

        .dropdown-content a i,
        .dropdown-content button i {
            margin-right: 15px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(193, 54, 8, 0.1);
            border-radius: 8px;
            padding: 5px;
            color: var(--accent1);
            transition: all 0.3s ease;
        }

        .dropdown-content a:hover i,
        .dropdown-content button:hover i {
            background: var(--accent1);
            color: white;
            transform: scale(1.1);
        }

        .dropdown-divider {
            height: 1px;
            background: rgba(0, 0, 0, 0.05);
            margin: 10px 0;
        }

        /* Navigation */
        nav {
            background: var(--light);
            padding: 0.8rem 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        }

        .nav-links {
            display: flex;
            list-style: none;
            justify-content: center;
            gap: 2.5rem;
            position: relative;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            font-size: 1.05rem;
            transition: color 0.3s;
            position: relative;
            padding: 8px 0;
        }

        .nav-links a:hover,
        #nav_active {
            color: var(--accent1);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--primary);
            transition: width 0.3s;
        }

        #nav_active::after,
        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-item {
            position: relative;
        }

        /* FIXED: Categories Dropdown */
        .categories-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: var(--light-bg);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 12px 12px;
            padding: 30px 5%;
            display: none;
            z-index: 850;
            border: 1px solid var(--border);
            animation: fadeIn 0.3s ease forwards;
            border-top: none;
        }

        header .item-dropdown:hover .categories-dropdown {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .category-column h4 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-bg);
            color: var(--accent1);
        }

        .category-links {
            list-style: none;
        }

        .category-links li {
            margin-bottom: 12px;
        }

        .category-links a {
            color: var(--text-light);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 8px 0;
            transition: all 0.3s;
        }

        .category-links a:hover {
            color: var(--accent1);
            transform: translateX(5px);
        }

        .category-links a i {
            margin-right: 10px;
            color: var(--primary);
            width: 20px;
            text-align: center;
        }

        /* Enhanced Hero Carousel */
        .hero-carousel {
            position: relative;
            height: 100vh;
            width: 100%;
            overflow: hidden;
            margin: 0;
        }

        .carousel-slides {
            position: relative;
            height: 100%;
            width: 100%;
        }

        .carousel-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
        }

        .carousel-slide.active {
            opacity: 1;
            z-index: 2;
        }

        .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            width: 90%;
            margin: 0 auto;
            padding: 0 5%;
            color: white;
        }

        .hero-content h1 {
            font-size: 4.5rem;
            margin-bottom: 1.2rem;
            font-family: 'Montserrat', sans-serif;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.8s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .hero-content h1 span {
            color: var(--primary);
        }

        .hero-content p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            max-width: 700px;
            text-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.8s ease 0.2s forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .hero-btn {
            background: var(--accent1);
            color: white;
            padding: 1.2rem 2.5rem;
            font-size: 1.2rem;
            display: inline-block;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease 0.4s forwards;
            opacity: 0;
            transform: translateY(20px);
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(193, 54, 8, 0.4);
        }

        .hero-btn:hover {
            background: #a52d06;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(193, 54, 8, 0.5);
        }

        .hero-btn i {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .hero-btn:hover i {
            transform: translateX(5px);
        }

        .carousel-controls {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .carousel-indicator {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-indicator.active {
            background: var(--primary);
            transform: scale(1.3);
        }

        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.7);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s;
            font-size: 1.8rem;
            color: var(--accent1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .carousel-arrow:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-arrow.prev {
            left: 30px;
        }

        .carousel-arrow.next {
            right: 30px;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Categories Section */
        .section {
            padding: 4rem 5%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2.5rem;
            color: var(--text);
            position: relative;
            font-family: 'Montserrat', sans-serif;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        .categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .category-card {
            background: var(--light);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--card-shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
            position: relative;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .category-img {
            height: 200px;
            background-size: cover;
            background-position: center;
            transition: transform 0.5s ease;
        }

        .category-card:hover .category-img {
            transform: scale(1.05);
        }

        .category-content {
            padding: 1.8rem 1.5rem;
        }

        .category-content h3 {
            font-size: 1.5rem;
            margin-bottom: 0.8rem;
            color: var(--text);
        }

        /* Products Section */
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: var(--light);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px var(--card-shadow);
            transition: transform 0.3s;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }

        .product-img {
            height: 220px;
            background-size: cover;
            background-position: center;
            position: relative;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--accent1);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            z-index: 2;
        }

        .product-content {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: var(--text);
            transition: color 0.3s;
        }

        .product-card:hover .product-title {
            color: var(--accent1);
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--accent1);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .product-price .old-price {
            color: var(--text-light);
            text-decoration: line-through;
            font-size: 1rem;
            font-weight: 500;
        }

        .add-to-cart {
            width: 100%;
            background: var(--primary);
            color: var(--text);
            border: none;
            padding: 0.8rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s, transform 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .add-to-cart::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: 0.5s;
        }

        .add-to-cart:hover::before {
            left: 100%;
        }

        .add-to-cart:hover {
            background: #e6ac00;
            transform: translateY(-2px);
        }

        /* Deals Section */
        .deals-section {
            background: linear-gradient(135deg, var(--accent3), var(--accent1));
            padding: 4rem 5%;
            color: white;
            text-align: center;
            margin: 4rem 0;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }

        .deals-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><polygon points="0,0 100,0 100,100" fill="rgba(255,255,255,0.05)"/></svg>');
            background-size: 100% 100%;
        }

        .deals-section h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            font-family: 'Montserrat', sans-serif;
            position: relative;
            z-index: 1;
        }

        .deals-section p {
            max-width: 700px;
            margin: 0 auto 2rem;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 2rem 0;
            position: relative;
            z-index: 1;
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 1.2rem;
            border-radius: 10px;
            min-width: 100px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .countdown-number {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(45deg, #ffffff, #ffdd99);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .countdown-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
        }

        /* Cart Animation */
        .cart-animation {
            animation: cartBounce 0.8s ease;
        }

        @keyframes cartBounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-15px);
            }

            60% {
                transform: translateY(-7px);
            }
        }

        /* Footer */
        footer {
            background: var(--light);
            color: var(--text);
            padding: 3rem 5% 2rem;
            border-top: 1px solid var(--border);
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-column h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            color: var(--accent1);
            position: relative;
            padding-bottom: 0.5rem;
            font-family: 'Montserrat', sans-serif;
        }

        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--primary);
            border-radius: 2px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a i {
            width: 20px;
            color: var(--accent2);
        }

        .footer-links a:hover {
            color: var(--accent1);
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: var(--light-bg);
            border-radius: 50%;
            color: var(--text);
            font-size: 1.2rem;
            transition: background 0.3s, transform 0.3s;
        }

        .social-icons a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .contact-info p {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 0.8rem;
            color: var(--text-light);
        }

        .contact-info i {
            color: var(--accent1);
            width: 20px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-content h1 {
                font-size: 3.5rem;
            }

            .hero-content p {
                font-size: 1.3rem;
            }

            .categories-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 1rem;
            }

            .search-bar {
                width: 100%;
                max-width: 500px;
            }

            .section-title {
                font-size: 2rem;
            }

            .nav-links {
                gap: 1.2rem;
                flex-wrap: wrap;
            }

            .hero-content h1 {
                font-size: 2.8rem;
            }

            .hero-content p {
                font-size: 1.1rem;
            }

            .hero-btn {
                padding: 1rem 2rem;
                font-size: 1.1rem;
            }

            .countdown {
                flex-wrap: wrap;
            }

            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .categories-dropdown-container {
                padding: 20px 5%;
            }

            .carousel-arrow {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .section {
                padding: 3rem 5%;
            }

            .nav-links {
                gap: 0.7rem;
                font-size: 0.85rem;
            }

            .categories-grid {
                grid-template-columns: 1fr;
            }

            .categories-dropdown-container {
                padding: 15px 5%;
            }

            .carousel-arrow {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .carousel-controls {
                bottom: 20px;
            }

            .dropdown-content {
                min-width: 250px;
                right: -20px;
            }
        }
    </style>
    <script>
        //Update the cart count
        function updateCartCount() {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.cart-count').innerText = data.count;
                })
                .catch(error => console.error('Error fetching cart count:', error));
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateCartCount();
        });
    </script>
</head>

<body>
    @include('components.toast')
    @if(session('toast'))
    <script>
        window.dispatchEvent(new CustomEvent('toast', {
                detail: {
                    type: "{{ session('toast.type') }}",
                    message: "{{ session('toast.message') }}"
                }
            }));
    </script>
    @endif
    <!-- Header with Navigation -->
    <header>
        <div class="header-container">
            <a href="{{ route('home') }}" class="logo">Pro<span>Mart</span></a>

            <!--Search Bar-->
            <form id="search-form" action="{{ route('products.search') }}" method="GET" style="flex: 0 0 45%;">
                <div class="search-bar">
                    <input id="search-input" name="q" type="text" autocomplete="off"
                        placeholder="Search for products, categories and more..." aria-autocomplete="list"
                        aria-controls="search-suggestions" aria-expanded="false" />
                    <button><i class="fas fa-search"></i></button>
                </div>

                <!-- Suggestions dropdown -->
                <div id="search-suggestions" role="listbox"
                    class="absolute left-0 right-0 mt-1 bg-white border rounded shadow z-50 hidden max-h-72 overflow-auto">
                    <!-- items injected here -->
                </div>
            </form>


            <div class="nav-icons">
                <div class="account-dropdown">
                    <a href="#" class="icon-link">
                        <i class="fas fa-user"></i>
                        <span>Account</span>
                    </a>
                    <div class="dropdown-content">
                        @if(Auth::check())
                        <div class="dropdown-header">
                            <div class="user-avatar">JD</div>
                            <div class="user-info">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-email">{{ Auth::user()->email }}</div>
                            </div>
                        </div>

                        <a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i> My Profile</a>
                        <a href="#"><i class="fas fa-box"></i> Orders</a>
                        <a href="#"><i class="fas fa-history"></i> Order History</a>

                        <div class="dropdown-divider"></div>

                        <a href="#"><i class="fas fa-cog"></i> Account Settings</a>
                        <a href="#"><i class="fas fa-shield-alt"></i> Security</a>
                        <a href="#"><i class="fas fa-bell"></i> Notifications</a>

                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="sumbit" style="color: var(--accent1); font-weight: 600;"><i
                                    class="fas fa-sign-out-alt"></i> Sign Out</button>
                        </form>

                        @else
                        <a href="{{ route('login') }}" style="background-color: var(--primary)"> Sign In</a>
                        @endif
                    </div>
                </div>

                <a href="#" class="icon-link">
                    <i class="fas fa-heart"></i>
                    <span>Wishlist</span>
                </a>

                <a href="{{ route('cart') }}" class="icon-link cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Cart</span>
                    <span class="cart-count">{{count(session('cart', []))}}</span>
                </a>
            </div>
        </div>

        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}" id="nav_active">Home</a></li>
                <li id="item-dropdown"><a href="#">All Categories <i class="fas fa-chevron-down"
                            style="font-size: 0.8rem;"></i></a></li>
                <li><a href="/products/Electronics">Electronics</a></li>
                <li><a href="/products/Fashion">Fashion</a></li>
                <li><a href="/products/Home & Kitchen">Home & Kitchen</a></li>
                <li><a href="/products/Beauty">Beauty</a></li>
                <li><a href="/products/Sports">Sports</a></li>
                <li><a href="#">Deals</a></li>
                <li><a href="#" style="color: var(--accent1); font-weight: 600;"><i class="fas fa-tag"></i> Sell
                        Items</a></li>
            </ul>

        </nav>
        <!-- FIXED: Moved dropdown-->
        <div class="categories-dropdown">
            <div class="categories-grid">
                <div class="category-column">
                    <h4>Electronics</h4>
                    <ul class="category-links">
                        <li><a href="/products/Electronics/Laptops"><i class="fas fa-laptop"></i> Laptops</a></li>
                        <li><a href="/products/Electronics/Smartphones"><i class="fas fa-mobile-alt"></i>
                                Smartphones</a></li>
                        <li><a href="/products/Electronics/Tablets"><i class="fas fa-tablet-alt"></i> Tablets</a></li>
                        <li><a href="/products/Electronics/Televisions"><i class="fas fa-tv"></i> Televisions</a></li>
                        <li><a href="/products/Electronics/Headphones"><i class="fas fa-headphones"></i> Headphones</a>
                        </li>
                    </ul>
                </div>

                <div class="category-column">
                    <h4>Fashion</h4>
                    <ul class="category-links">
                        <li><a href="/products/Fashion/Men's Clothing"><i class="fas fa-tshirt"></i> Men's Clothing</a>
                        </li>
                        <li><a href="/products/Fashion/Women's Clothing"><i class="fas fa-female"></i> Women's
                                Clothing</a></li>
                        <li><a href="/products/Fashion/Footwear"><i class="fas fa-shoe-prints"></i> Footwear</a></li>
                        <li><a href="/products/Fashion/Jewelry"><i class="fas fa-gem"></i> Jewelry</a></li>
                        <li><a href="/products/Fashion/Bags & Accessories"><i class="fas fa-shopping-bag"></i> Bags &
                                Accessories</a></li>
                    </ul>
                </div>

                <div class="category-column">
                    <h4>Home & Kitchen</h4>
                    <ul class="category-links">
                        <li><a href="/products/Home & Kitchen/Appliances"><i class="fas fa-blender"></i> Appliances</a>
                        </li>
                        <li><a href="/products/Home & Kitchen/Furniture"><i class="fas fa-couch"></i> Furniture</a></li>
                        <li><a href="/products/Home & Kitchen/Kitchenware"><i class="fas fa-utensils"></i>
                                Kitchenware</a></li>
                        <li><a href="/products/Home & Kitchen/Lighting"><i class="fas fa-lightbulb"></i> Lighting</a>
                        </li>
                        <li><a href="/products/Home & Kitchen/Home Decor"><i class="fas fa-home"></i> Home Decor</a>
                        </li>
                    </ul>
                </div>

                <div class="category-column">
                    <h4>More Categories</h4>
                    <ul class="category-links">
                        <li><a href="/products/Beauty"><i class="fas fa-heart"></i> Beauty</a></li>
                        <li><a href="/products/Sports"><i class="fas fa-football-ball"></i> Sports</a></li>
                        <li><a href="/products/Books"><i class="fas fa-book"></i> Books</a></li>
                        <li><a href="/products/Baby Products"><i class="fas fa-baby"></i> Baby Products</a></li>
                        <li><a href="/products/Gaming"><i class="fas fa-gamepad"></i> Gaming</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    @yield('content')


    <!-- Footer -->
    <footer>
        <div class="footer-content">

            <div class="footer-column">
                <h3>Information</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-angle-right"></i> About Us</a></li>
                    <li><a href="#"><i class="fas fa-angle-right"></i> Contact Us</a></li>
                    <li><a href="#"><i class="fas fa-angle-right"></i> Privacy Policy</a></li>
                    <li><a href="#"><i class="fas fa-angle-right"></i> Terms & Conditions</a></li>
                    <li><a href="#"><i class="fas fa-angle-right"></i> Shipping Policy</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Customer Service</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-angle-right"></i> My Account</a></li>
                    <li><a href="#"><i class="fas fa-angle-right"></i> Track Your Order</a></li>
                    <li><a href="#"><i class="fas fa-angle-right"></i> Returns & Exchanges</a></li>
                    <li><a href="#"><i class="fas fa-angle-right"></i> FAQs</a></li>
                    <li><a href="#"><i class="fas fa-angle-right"></i> Help Center</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Contact</h3>
                <div class="contact-info">
                    <p><i class="fas fa-map-marker-alt"></i> 1234 Shopping Street, Retail City</p>
                    <p><i class="fas fa-phone"></i> (123) 456-7890</p>
                    <p><i class="fas fa-envelope"></i> info@mart.com</p>
                </div>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2023 ProMart. All Rights Reserved.</p>
        </div>
    </footer>

    @yield('script')
    <script>
        // Hover Menu
        const itemDropdown = document.getElementById('item-dropdown');
        const categoriesDropdown = document.querySelector('.categories-dropdown');
        
        let hideTimeout;
        let isMouseOver = false;
        
        // Function to show categories
        function showCategories() {
            clearTimeout(hideTimeout);
            categoriesDropdown.style.display = 'block';
        }
        
        // Function to hide categories after delay
        function hideCategories() {
            hideTimeout = setTimeout(() => {
                categoriesDropdown.style.display = 'none';
            }, 100);
        }
        
        // When mouse enters either element
        itemDropdown.addEventListener('mouseenter', () => {
            isMouseOver = true;
            showCategories();
        });
        
        categoriesDropdown.addEventListener('mouseenter', () => {
            isMouseOver = true;
            showCategories();
        });
        
        // When mouse leaves either element
        itemDropdown.addEventListener('mouseleave', () => {
            isMouseOver = false;
            hideCategories();
        });
        
        categoriesDropdown.addEventListener('mouseleave', () => {
            isMouseOver = false;
            hideCategories();
        });

        //Click on the account icon
        const account = document.querySelector('.account-dropdown');
        const accountDrop = document.querySelector('.dropdown-content');
        account.addEventListener('click' , function (){
            accountDrop.classList.toggle('dropdown-content-clicked');
        });

        window.addEventListener('load', () => {
        const notification = localStorage.getItem('notification');
        if (notification) {
            const detail = JSON.parse(notification);
            window.dispatchEvent(new CustomEvent('toast', { detail }));
            localStorage.removeItem('notification');
        }
        });

        $(function() {
            $("#search-input").autocomplete({
                source: "{{ route('products.autocomplete') }}",
                minLength: 2
            });
        });

                
    </script>
    <script>
    (function () {
        const INPUT = document.getElementById('search-input');
        const DROPDOWN = document.getElementById('search-suggestions');
        const FORM = document.getElementById('search-form');
        const AUTOCOMPLETE_URL = "{{ route('products.autocomplete') }}";

        let activeIndex = -1;
        let suggestions = [];
        let controller = null;

        function debounce(fn, wait) {
            let t;
            return (...args) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...args), wait);
            };
        }

        function openDropdown() {
            DROPDOWN.style.display = 'block';
            INPUT.setAttribute('aria-expanded', 'true');
        }

        function closeDropdown() {
            DROPDOWN.style.display = 'none';
            INPUT.setAttribute('aria-expanded', 'false');
            activeIndex = -1;
            suggestions = [];
        }

        function renderSuggestions(items) {
            DROPDOWN.innerHTML = '';
            if (!items.length) {
                closeDropdown();
                return;
            }

            items.forEach((it, idx) => {
                const el = document.createElement('div');
                el.setAttribute('role', 'option');
                el.setAttribute('data-index', idx);
                el.className = 'suggestion-item';

                const label = document.createElement('span');
                label.textContent = it.label;

                const meta = document.createElement('small');
                meta.textContent = it.type;

                el.appendChild(label);
                el.appendChild(meta);

                el.addEventListener('mousedown', function (e) {
                    e.preventDefault();
                    selectSuggestion(idx);
                });

                el.addEventListener('mouseover', function () {
                    setActive(idx);
                });

                DROPDOWN.appendChild(el);
            });

            openDropdown();
        }

        function setActive(idx) {
            Array.from(DROPDOWN.children).forEach((c, i) => {
                c.classList.toggle('highlighted', i === idx);
            });
            activeIndex = idx;
        }

        function selectSuggestion(idx) {
            if (idx < 0 || idx >= suggestions.length) return;
            const item = suggestions[idx];

            if (item.url) {
                window.location.href = item.url;
            } else {
                INPUT.value = item.label;
                FORM.submit();
            }
            closeDropdown();
        }

        INPUT.addEventListener('keydown', function (e) {
            if (['ArrowDown', 'ArrowUp', 'Enter', 'Escape'].includes(e.key)) {
                e.preventDefault();
            }

            if (e.key === 'ArrowDown') {
                activeIndex = Math.min(activeIndex + 1, suggestions.length - 1);
                setActive(activeIndex);
            } else if (e.key === 'ArrowUp') {
                activeIndex = Math.max(activeIndex - 1, 0);
                setActive(activeIndex);
            } else if (e.key === 'Enter' && activeIndex >= 0) {
                selectSuggestion(activeIndex);
            } else if (e.key === 'Escape') {
                closeDropdown();
            }else if (e.key === 'Enter' && activeIndex < 0) {
                closeDropdown();
                FORM.submit();
            }
        });

        document.addEventListener('click', function (e) {
            if (!FORM.contains(e.target)) {
                closeDropdown();
            }
        });

        const fetchSuggestions = debounce(async function (query) {
            if (!query || query.length < 2) {
                closeDropdown();
                return;
            }

            if (controller) controller.abort();
            controller = new AbortController();

            try {
                const url = new URL(AUTOCOMPLETE_URL, window.location.origin);
                url.searchParams.set('term', query);

                const res = await fetch(url.toString(), {
                    signal: controller.signal,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!res.ok) return;
                const data = await res.json();

                suggestions = Array.isArray(data) ? data : [];
                renderSuggestions(suggestions);
            } catch (err) {
                if (err.name !== 'AbortError') {
                    console.error('Autocomplete fetch failed', err);
                }
            }
        }, 250);

        INPUT.addEventListener('input', function (e) {
            fetchSuggestions(e.target.value.trim());
        });

        FORM.addEventListener('submit', function (e) {
            closeDropdown();
        });
    })();    
</script>
</body>

</html>