@extends('layouts.home')

@section('content')
<!-- Enhanced Hero Carousel -->
<div class="hero-carousel">
    <div class="carousel-slides">
        <div class="carousel-slide active"
            style="background-image: url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1800&q=80')">
            <div class="slide-overlay"></div>
            <div class="hero-content">
                <h1>Great Deals on <span>Summer Essentials</span></h1>
                <p>Discover amazing discounts on top brands. Limited time offer - shop now and save big!</p>
                <a href="#" class="hero-btn">Shop Now <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="carousel-slide"
            style="background-image: url('https://images.unsplash.com/photo-1498049794561-7780e7231661?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1800&q=80')">
            <div class="slide-overlay"></div>
            <div class="hero-content">
                <h1>New Tech <span>Innovations</span></h1>
                <p>Explore the latest gadgets and cutting-edge technology at unbeatable prices.</p>
                <a href="/products/Electronics" class="hero-btn">Discover Tech <i class="fas fa-microchip"></i></a>
            </div>
        </div>

        <div class="carousel-slide"
            style="background-image: url('https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1800&q=80')">
            <div class="slide-overlay"></div>
            <div class="hero-content">
                <h1>Fashion <span>Trends 2023</span></h1>
                <p>Refresh your wardrobe with the hottest styles of the season. Free shipping on orders over $50!</p>
                <a href="/products/Fashion" class="hero-btn">Shop Fashion <i class="fas fa-tshirt"></i></a>
            </div>
        </div>
    </div>

    <div class="carousel-controls">
        <div class="carousel-indicator active"></div>
        <div class="carousel-indicator"></div>
        <div class="carousel-indicator"></div>
    </div>

    <div class="carousel-arrow prev">
        <i class="fas fa-chevron-left"></i>
    </div>
    <div class="carousel-arrow next">
        <i class="fas fa-chevron-right"></i>
    </div>
</div>

<!-- Categories Section -->
<section class="section">
    <h2 class="section-title">Shop by Category</h2>
    <div class="categories">
        <div class="category-card">
            <div class="category-img"
                style="background-image: url('https://images.unsplash.com/photo-1603302576837-37561b2e2302?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');">
            </div>
            <div class="category-content">
                <h3>Electronics</h3>
                <a href="/products/Electronics" class="btn"
                    style="background: var(--accent3); color: white; padding: 0.7rem 1.5rem; border-radius: 50px; text-decoration: none; display: inline-block;">Shop
                    Now</a>
            </div>
        </div>

        <div class="category-card">
            <div class="category-img"
                style="background-image: url('https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');">
            </div>
            <div class="category-content">
                <h3>Fashion</h3>
                <a href="/products/Fashion" class="btn"
                    style="background: var(--accent3); color: white; padding: 0.7rem 1.5rem; border-radius: 50px; text-decoration: none; display: inline-block;">Shop
                    Now</a>
            </div>
        </div>

        <div class="category-card">
            <div class="category-img"
                style="background-image: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');">
            </div>
            <div class="category-content">
                <h3>Home & Kitchen</h3>
                <a href="/products/Home & Kitchen" class="btn"
                    style="background: var(--accent3); color: white; padding: 0.7rem 1.5rem; border-radius: 50px; text-decoration: none; display: inline-block;">Shop
                    Now</a>
            </div>
        </div>

        <div class="category-card">
            <div class="category-img"
                style="background-image: url('https://images.unsplash.com/photo-1517649763962-0c623066013b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');">
            </div>
            <div class="category-content">
                <h3>Sports & Outdoors</h3>
                <a href="/products/Sports" class="btn"
                    style="background: var(--accent3); color: white; padding: 0.7rem 1.5rem; border-radius: 50px; text-decoration: none; display: inline-block;">Shop
                    Now</a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="section" style="background: var(--light-bg);">
    <h2 class="section-title">Featured Products</h2>
    <div class="products">
        <div class="product-card">
            <div class="product-img"
                style="background-image: url('https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');">
                <span class="product-badge">Sale</span>
            </div>
            <div class="product-content">
                <h3 class="product-title">Wireless Headphones</h3>
                <p class="product-price">$89.99 <span class="old-price">$129.99</span></p>
                <button class="add-to-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
        </div>

        <div class="product-card">
            <div class="product-img"
                style="background-image: url('https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');">
                <span class="product-badge">New</span>
            </div>
            <div class="product-content">
                <h3 class="product-title">Smart Watch Series 5</h3>
                <p class="product-price">$199.99</p>
                <button class="add-to-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
        </div>

        <div class="product-card">
            <div class="product-img"
                style="background-image: url('https://images.unsplash.com/photo-1576566588028-4147f3842f27?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');">
                <span class="product-badge">Hot</span>
            </div>
            <div class="product-content">
                <h3 class="product-title">Running Shoes</h3>
                <p class="product-price">$79.99 <span class="old-price">$99.99</span></p>
                <button class="add-to-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
        </div>

        <div class="product-card">
            <div class="product-img"
                style="background-image: url('https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80');">
                <span class="product-badge">-30%</span>
            </div>
            <div class="product-content">
                <h3 class="product-title">Bluetooth Speaker</h3>
                <p class="product-price">$59.99 <span class="old-price">$85.99</span></p>
                <button class="add-to-cart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
        </div>
    </div>
</section>

<!-- Deals Section -->
<div class="deals-section">
    <h2>Flash Sale Ending Soon!</h2>
    <p>Huge discounts on top brands - don't miss out on these limited time offers</p>

    <div class="countdown">
        <div class="countdown-item">
            <div class="countdown-number">02</div>
            <div class="countdown-label">Days</div>
        </div>
        <div class="countdown-item">
            <div class="countdown-number">12</div>
            <div class="countdown-label">Hours</div>
        </div>
        <div class="countdown-item">
            <div class="countdown-number">45</div>
            <div class="countdown-label">Minutes</div>
        </div>
        <div class="countdown-item">
            <div class="countdown-number">30</div>
            <div class="countdown-label">Seconds</div>
        </div>
    </div>

    <a href="#" class="btn"
        style="background: var(--primary); color: var(--text); padding: 1rem 2rem; font-size: 1.1rem; display: inline-block; border-radius: 50px; text-decoration: none;">
        Shop Flash Sale <i class="fas fa-bolt"></i>
    </a>
</div>

<!-- Seller Section -->
<section class="section"
    style="background: linear-gradient(135deg, rgba(222, 104, 27, 0.05), rgba(255, 192, 0, 0.05));">
    <div class="section-title">Become a Seller</div>
    <div style="max-width: 800px; margin: 0 auto; text-align: center; padding: 0 20px;">
        <p style="font-size: 1.1rem; margin-bottom: 30px; color: var(--text-light);">
            Join thousands of sellers on Mart and start your online business today. Enjoy low fees, powerful tools,
            and a massive customer base.
        </p>
        <a href="#" class="btn"
            style="background: var(--accent1); color: white; padding: 1rem 2.5rem; font-size: 1.1rem; display: inline-block; border-radius: 50px; text-decoration: none;">
            Start Selling <i class="fas fa-store"></i>
        </a>
    </div>
</section>
@endsection

@section('script')
<script>
    // Enhanced Carousel Functionality
        const carouselSlides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');
        const prevArrow = document.querySelector('.carousel-arrow.prev');
        const nextArrow = document.querySelector('.carousel-arrow.next');
        let currentSlide = 0;
        
        // Function to go to a specific slide
        function goToSlide(index) {
            // Remove active class from current slide and indicator
            carouselSlides[currentSlide].classList.remove('active');
            indicators[currentSlide].classList.remove('active');
            
            // Update current slide
            currentSlide = (index + carouselSlides.length) % carouselSlides.length;
            
            // Add active class to new slide and indicator
            carouselSlides[currentSlide].classList.add('active');
            indicators[currentSlide].classList.add('active');
        }
        
        // Set up indicators
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => goToSlide(index));
        });
        
        // Set up arrows
        prevArrow.addEventListener('click', () => goToSlide(currentSlide - 1));
        nextArrow.addEventListener('click', () => goToSlide(currentSlide + 1));
        
        // Auto advance carousel
        setInterval(() => goToSlide(currentSlide + 1), 5000);

        // Cart functionality
        const cartCount = document.querySelector('.cart-count');
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        
        let cartItems = 0;
        
        addToCartButtons.forEach(button => {
            button.addEventListener('click', () => {
                cartItems++;
                cartCount.textContent = cartItems;
                
                // Add animation to cart icon
                cartCount.classList.remove('cart-animation');
                void cartCount.offsetWidth; // Trigger reflow
                cartCount.classList.add('cart-animation');
            });
        });
        
        
        // Countdown timer
        function updateCountdown() {
            const days = document.querySelector('.countdown-item:nth-child(1) .countdown-number');
            const hours = document.querySelector('.countdown-item:nth-child(2) .countdown-number');
            const minutes = document.querySelector('.countdown-item:nth-child(3) .countdown-number');
            const seconds = document.querySelector('.countdown-item:nth-child(4) .countdown-number');
            
            let timeLeft = {
                days: parseInt(days.textContent),
                hours: parseInt(hours.textContent),
                minutes: parseInt(minutes.textContent),
                seconds: parseInt(seconds.textContent)
            };
            
            if (timeLeft.seconds > 0) {
                timeLeft.seconds--;
            } else {
                timeLeft.seconds = 59;
                if (timeLeft.minutes > 0) {
                    timeLeft.minutes--;
                } else {
                    timeLeft.minutes = 59;
                    if (timeLeft.hours > 0) {
                        timeLeft.hours--;
                    } else {
                        timeLeft.hours = 23;
                        if (timeLeft.days > 0) {
                            timeLeft.days--;
                        }
                    }
                }
            }
            
            days.textContent = timeLeft.days.toString().padStart(2, '0');
            hours.textContent = timeLeft.hours.toString().padStart(2, '0');
            minutes.textContent = timeLeft.minutes.toString().padStart(2, '0');
            seconds.textContent = timeLeft.seconds.toString().padStart(2, '0');
        }
        
        // Update countdown every second
        setInterval(updateCountdown, 1000);
</script>        
@endsection
