<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Professional Shop</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="fixed top-0 z-50 w-full bg-white shadow-md">
        <div class="flex items-center justify-between px-4 py-3 lg:px-8">
            <div class="flex items-center">
                <!-- Mobile Menu Button -->
                <button id="menu-toggle"
                    class="lg:hidden p-2 text-gray-500 hover:bg-gray-100 rounded-md focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <a href="{{ url('dashboard') }}">
                    <span class="ml-3 text-xl font-bold text-gray-900">Shop Now!</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen bg-white border-r border-gray-200 shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        <div class="pt-20 h-full flex flex-col">
            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ url('/dashboard') }}"
                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                    <span class="ml-3 font-medium">Products</span>
                </a>
                <a href="{{ url('/orders') }}"
                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                    <span class="ml-3 font-medium">Orders</span>
                </a>
                <a href="{{ url('/profile') }}"
                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                    <span class="ml-3 font-medium">Profile</span>
                </a>
                <a href="javascript:void(0);" onclick="openModal()"
                    class="flex items-center p-3 rounded-lg text-red-600 hover:bg-red-50 transition">
                    <span class="ml-3 font-medium">Logout</span>
                </a>

            </nav>
        </div>
    </aside>

    <div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-semibold text-gray-800">Confirm Logout</h2>
            <p class="text-gray-600 mt-2">Are you sure you want to logout?</p>

            <div class="flex justify-end space-x-3 mt-6">
                <!-- Cancel -->
                <button onclick="closeModal()"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">
                    Cancel
                </button>

                <!-- Logout (redirect or form submit) -->
                <form method="POST" action="{{ url('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
