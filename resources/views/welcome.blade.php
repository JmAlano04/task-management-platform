<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hirable PH</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- TailwindCSS CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS (Animate On Scroll) Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body class="bg-white font-sans text-black">

    <!-- Header -->
    <header class="w-full py-6 px-6 lg:px-20 flex justify-between items-center shadow-sm bg-white sticky top-0 z-50">
        <div class="flex items-center space-x-2">
            <span class="text-2xl font-bold text-black">Hireable PH</span>
        </div>
        <nav class="flex space-x-4">
            @auth
             <a href="/login" class="px-4 py-2 rounded-lg bg-black text-white hover:bg-gray-800 transition">Dashboard</a>
             @else
            <a href="/login" class="px-4 py-2 rounded-lg bg-black text-white hover:bg-gray-800 transition">Login</a>
            <a href="/register" class="px-4 py-2 rounded-lg bg-black text-white hover:bg-gray-800 transition">Register</a>
             @endauth
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="bg-white py-28 text-center">
        <h1 class="text-5xl font-extrabold mb-4 text-black">Manage Tasks Effortlessly</h1>
        <p class="text-lg md:text-xl mb-8 text-black">Assign, track, and monitor tasks in real-time with ease.</p>
        <a href="/register" class="bg-black text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition">Get Started</a>
    </section>

    <!-- Why Hirable PH Section -->
    <section class="bg-white py-24">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-4xl font-bold mb-6 text-black">Why Hireable PH?</h2>
            <p class="text-lg md:text-xl mb-12 text-black">Boost productivity and keep your team aligned with our easy-to-use task management platform.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Feature 1 -->
                <div data-aos="fade-up" class="bg-pink-100 p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m6-9a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-black">Easy to Use</h3>
                    <p class="text-black">Intuitive interface that your team can start using immediately without training.</p>
                </div>

                <!-- Feature 2 -->
                <div data-aos="fade-up" data-aos-delay="100" class="bg-orange-100 p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-black">Track Everything</h3>
                    <p class="text-black">Real-time dashboards let you monitor tasks, deadlines, and team performance at a glance.</p>
                </div>

                <!-- Feature 3 -->
                <div data-aos="fade-up" data-aos-delay="200" class="bg-blue-100 p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-black">Boost Productivity</h3>
                    <p class="text-black">Organize tasks, assign responsibilities, and get more done without chaos or confusion.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-4xl font-bold mb-12 text-black">Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Admin -->
                <div data-aos="fade-up" class="bg-pink-100 p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-2-4-2-4-4 0-2 4-2 4-4s4 0 4 2-4 2-4 4z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13c-4 0-8 2-8 6v3h16v-3c0-4-4-6-8-6z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-black">Admin</h3>
                    <ul class="text-black space-y-2">
                        <li>Manage users and assign roles</li>
                        <li>View all tasks</li>
                        <li>Monitor progress and generate reports</li>
                    </ul>
                </div>

                <!-- Task Creator -->
                <div data-aos="fade-up" data-aos-delay="100" class="bg-orange-100 p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-black">Task Creator</h3>
                    <ul class="text-black space-y-2">
                        <li>Create tasks and assign to takers</li>
                        <li>Edit or delete your tasks</li>
                        <li>Track task progress</li>
                    </ul>
                </div>

                <!-- Task Taker -->
                <div data-aos="fade-up" data-aos-delay="200" class="bg-blue-100 p-8 rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m6-9a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-black">Task Taker</h3>
                    <ul class="text-black space-y-2">
                        <li>View assigned tasks</li>
                        <li>Update task status</li>
                        <li>Focus on completing tasks efficiently</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-24 text-center bg-white">
        <h2 class="text-4xl font-bold mb-6 text-black">Ready to streamline your tasks?</h2>
        <a href="/register" class="bg-black text-white px-10 py-4 rounded-xl font-semibold hover:bg-gray-800 transition">Sign Up Now</a>
    </section>

    <!-- Footer -->
    <footer class="py-12 text-center text-sm text-black">
        © 2025. All rights reserved. | Developed by Jenmar Alano
    </footer>

    <!-- Initialize AOS -->
    <script>
        AOS.init({ duration: 800, once: true });
    </script>

</body>
</html>
