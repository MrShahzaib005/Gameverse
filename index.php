<?php
include_once('header.php')
?>
<body class="min-h-screen">
    <!-- Navigation -->
    <nav class="bg-gray-900 bg-opacity-90 backdrop-filter backdrop-blur-lg border-b border-gray-800 fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="index.html" class="text-2xl font-gaming gradient-text">GAMEVERSE</a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-8">
                            <a href="index.html" class="text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                            <a href="#about" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About</a>
                            <a href="#tournament" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Tournament</a>
                            <a href="registration.html" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center text-center">
        <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-[url('images/bg001.jpg')] bg-cover bg-center"></div>
        <div class="relative z-20 max-w-4xl mx-auto px-4">
            <h1 class="text-5xl md:text-7xl font-gaming mb-6 gradient-text">GameVerse25</h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-8">Join the Ultimate Gaming Tournament</p>
            <div class="countdown-container mb-8">
                <div class="grid grid-cols-4 gap-4 max-w-lg mx-auto">
                    <div class="countdown-item">
                        <span id="days" class="text-4xl font-gaming gradient-text">00</span>
                        <span class="text-sm text-gray-400">Days</span>
                    </div>
                    <div class="countdown-item">
                        <span id="hours" class="text-4xl font-gaming gradient-text">00</span>
                        <span class="text-sm text-gray-400">Hours</span>
                    </div>
                    <div class="countdown-item">
                        <span id="minutes" class="text-4xl font-gaming gradient-text">00</span>
                        <span class="text-sm text-gray-400">Minutes</span>
                    </div>
                    <div class="countdown-item">
                        <span id="seconds" class="text-4xl font-gaming gradient-text">00</span>
                        <span class="text-sm text-gray-400">Seconds</span>
                    </div>
                </div>
            </div>
            <a href="registration.html" class="inline-block bg-gradient-to-r from-purple-600 to-blue-500 text-white px-8 py-3 rounded-md text-lg font-medium btn-glow">
                Register Now
            </a>
        </div>
    </section>

    <!-- Tournament Info Section -->
    <section id="tournament" class="py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-gaming text-center mb-12 gradient-text">Featured Games</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- COD -->
                <div class="game-card">
                    <div class="relative h-48">
                        <img src="images/cod.jpg" alt="COD" class="w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-gaming mb-2">COD Black OPS 6</h3>
                        <p class="text-gray-400 mb-4">5v5 Team Tournament</p>
                        <div class="text-purple-500 font-gaming">Prize: 150,000 PKR</div>
                    </div>
                </div>
                
                <!-- Valorant -->
                <div class="game-card">
                    <div class="relative h-48">
                        <img src="images/valorant.jpeg" alt="Valorant" class="w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-gaming mb-2">Valorant</h3>
                        <p class="text-gray-400 mb-4">5v5 Team Tournament</p>
                        <div class="text-purple-500 font-gaming">Prize: 150,000 PKR</div>
                    </div>
                </div>

                <!-- PUBG Mobile -->
                <div class="game-card">
                    <div class="relative h-48">
                        <img src="images/pubg.jpg" alt="PUBG Mobile" class="w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-gaming mb-2">PUBG Mobile</h3>
                        <p class="text-gray-400 mb-4">4v4 Team Tournament</p>
                        <div class="text-purple-500 font-gaming">Prize: 130,000 PKR</div>
                    </div>
                </div>

                <!-- FIFA 25 -->
                <div class="game-card">
                    <div class="relative h-48">
                        <img src="images/fifa.jpg" alt="FIFA 25" class="w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-gaming mb-2">FIFA 25</h3>
                        <p class="text-gray-400 mb-4">Solo Tournament</p>
                        <div class="text-purple-500 font-gaming">Prize: 60,000 PKR</div>
                    </div>
                </div>

                <!-- Tekken 8 -->
                <div class="game-card">
                    <div class="relative h-48">
                        <img src="images/tekken.jpeg" alt="Tekken 8" class="w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-gaming mb-2">Tekken 8</h3>
                        <p class="text-gray-400 mb-4">Solo Tournament</p>
                        <div class="text-purple-500 font-gaming">Prize: 110,000 PKR</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include_once('footer.php')
?>