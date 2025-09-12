<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFC000',
                        accent1: '#C13608',
                        accent2: '#D24C0E',
                        accent3: '#DE681B',
                        dark: '#1E293B',
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        montserrat: ['Montserrat', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    <style type="text/tailwindcss">
        @layer utilities {
            .bg-dots {
                background-image: radial-gradient(#CBD5E1 1px, transparent 1px);
                background-size: 20px 20px;
            }
            .card-shadow {
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4 font-poppins">
    <!-- Floating background elements -->
    <div class="absolute inset-0 overflow-hidden z-0">
        <div class="absolute top-1/5 left-1/4 w-96 h-96 rounded-full bg-primary/10 blur-3xl animate-float"></div>
        <div class="absolute bottom-1/5 right-1/4 w-80 h-80 rounded-full bg-accent1/10 blur-3xl animate-float animation-delay-2000"></div>
    </div>
    
    <!-- Logo Section Above the Card -->
    <div class=" z-10 text-center animate-fade-in-down">
        <div class="inline-flex items-center justify-center mb-4 p-3">
          
                <h1 class="text-6xl font-bold text-primary" style="font-family: 'Informal Roman', 'Montserrat', sans-serif;">
                    Pro<span class="text-accent1">Mart</span>
                </h1>
            
        </div>
    </div>
    
    <!-- Login Card -->
    <div class="w-full max-w-md z-10 animate-fade-in-up">
        <div class="bg-white rounded-3xl overflow-hidden card-shadow transform transition-all duration-500 hover:shadow-xl">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
                    <p class="text-gray-600 mt-2">Sign in to access your account</p>
                </div>
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    @if ($errors->has('email'))
                    <p class="mt-2 font-medium text-red-500 bg-red-100 p-3 rounded-md">{{ $errors->first('email') }}</p>
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="email">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <input type="email" id="email" name="email"
                                class="w-full pl-10 pr-4 py-3.5 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent ring-offset-2 transition-all duration-300 shadow-sm" 
                                placeholder="you@example.com"
                            >
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="password">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" id="password" name="password"
                                class="w-full pl-10 pr-10 py-3.5 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent ring-offset-2 transition-all duration-300 shadow-sm" 
                                placeholder="••••••••"
                            >
                            <button type="button" id="eyeButton" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="remember"
                                class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                            >
                            <label for="remember" class="ml-2 block text-gray-700 text-sm">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-accent1 hover:text-accent2 font-medium transition">Forgot Password?</a>
                    </div>
                    
                    <button 
                        type="submit"
                        class="w-full bg-gradient-to-r from-accent1 to-accent2 hover:from-accent2 hover:to-accent3 text-white py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center"
                    >
                        <i class="fas fa-unlock-alt mr-2"></i> Sign In
                    </button>
                    
                    <div class="relative flex items-center my-6">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="flex-shrink mx-4 text-gray-500 text-sm">Or continue with</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-3">
                        <button class="py-3.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 transition flex items-center justify-center shadow-sm hover:shadow-md">
                            <i class="fab fa-google text-red-500 text-xl"></i>
                        </button>
                        <button class="py-3.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 transition flex items-center justify-center shadow-sm hover:shadow-md">
                            <i class="fab fa-facebook-f text-blue-600 text-xl"></i>
                        </button>
                        <button class="py-3.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 transition flex items-center justify-center shadow-sm hover:shadow-md">
                            <i class="fab fa-apple text-gray-800 text-xl"></i>
                        </button>
                    </div>
                    
                    <p class="text-center text-gray-600 text-sm mt-6">
                        Don't have an account? 
                        <a href="#" class="text-accent1 hover:text-accent2 font-medium transition">Sign up now</a>
                    </p>
                </form>
            </div>
            
            <div class="bg-gray-50 p-4 text-center">
                <p class="text-xs text-gray-500">
                    © 2023 ProMart. All rights reserved. Privacy Policy | Terms of Service
                </p>
            </div>
        </div>
    </div>
   
    <script>
        // Toggle password visibility
        const passwordInput = document.getElementById('password');
        const eyeButton = document.getElementById('eyeButton');
        
        eyeButton.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
        
       
    </script>
</body>
</html>