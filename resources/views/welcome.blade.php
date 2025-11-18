<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GroceryTracker - Smart Shopping Made Easy</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gradient-to-br from-orange-50 to-amber-100">
            <!-- Navigation -->
            <nav class="bg-white/80 backdrop-blur-md border-b border-orange-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">🛒</span>
                                </div>
                                <span class="text-xl font-bold text-orange-600">GroceryTracker</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-orange-600 hover:text-orange-800 font-medium">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-orange-600 hover:text-orange-800 font-medium">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200">Sign up</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="relative overflow-hidden">
                <div class="max-w-7xl mx-auto">
                    <div class="relative z-10 pb-8 bg-transparent sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                        <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                            <div class="sm:text-center lg:text-left">
                                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                    <span class="block text-orange-600">Smart Grocery</span>
                                    <span class="block text-orange-500">Shopping Made Easy</span>
                                </h1>
                                <p class="mt-3 text-base text-gray-600 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                    Track your grocery expenses, manage your shopping lists, and never forget an item again. 
                                    GroceryTracker helps you shop smarter and save money with real-time expense tracking.
                                </p>
                                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                    <div class="rounded-md shadow">
                                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-500 hover:bg-orange-600 md:py-4 md:text-lg md:px-10 transition duration-200">
                                            Start Tracking Now
                                        </a>
                                    </div>
                                    <div class="mt-3 sm:mt-0 sm:ml-3">
                                        <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-orange-700 bg-orange-100 hover:bg-orange-200 md:py-4 md:text-lg md:px-10 transition duration-200">
                                            Sign In
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
                
                <!-- Grocery Icons Background -->
                <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                    <div class="h-56 w-full sm:h-72 md:h-96 lg:w-full lg:h-full relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="grid grid-cols-3 gap-8 opacity-20">
                                <!-- Grocery Icons -->
                                <div class="text-6xl text-orange-400">🍎</div>
                                <div class="text-6xl text-orange-400">🥛</div>
                                <div class="text-6xl text-orange-400">🍞</div>
                                <div class="text-6xl text-orange-400">🥦</div>
                                <div class="text-6xl text-orange-400">🥩</div>
                                <div class="text-6xl text-orange-400">🥚</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="py-12 bg-white/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="lg:text-center">
                        <h2 class="text-base text-orange-600 font-semibold tracking-wide uppercase">Features</h2>
                        <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                            Everything you need for smart shopping
                        </p>
                    </div>

                    <div class="mt-10">
                        <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                            <div class="text-center">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-orange-500 text-white mx-auto">
                                    📝
                                </div>
                                <div class="mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Easy List Management</h3>
                                    <p class="mt-2 text-base text-gray-600">
                                        Create and manage your grocery lists with ease. Add items, set quantities, and track prices.
                                    </p>
                                </div>
                            </div>

                            <div class="text-center">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-orange-500 text-white mx-auto">
                                    💰
                                </div>
                                <div class="mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Expense Tracking</h3>
                                    <p class="mt-2 text-base text-gray-600">
                                        Track your grocery spending in real-time. See total costs and manage your budget effectively.
                                    </p>
                                </div>
                            </div>

                            <div class="text-center">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-orange-500 text-white mx-auto">
                                    🔒
                                </div>
                                <div class="mt-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Personal Lists</h3>
                                    <p class="mt-2 text-base text-gray-600">
                                        Your grocery lists are private and secure. Each user has their own personalized shopping experience.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
