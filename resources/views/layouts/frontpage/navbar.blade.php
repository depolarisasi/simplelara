<nav class="navbar bg-base-100 fixed top-0 z-50 shadow-sm  md:flex">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <!-- Left side: Logo and Menu -->
        <div class="flex items-center">
            <!-- Logo -->
            <a href="/" class="btn btn-ghost normal-case text-xl mr-4 px-0">
                <img src="{{asset('assets/media/logos/logo.png')}}" alt="logo" class="h-8">
            </a>
            
            <!-- Navigation Links -->
            <ul class="menu menu-horizontal px-1 hidden md:flex">
                <li>
                    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
                        <i class="ri-home-4-line"></i> Home
                    </a>
                </li>
                <li>
                    <a href="/search" class="{{ request()->is('search') ? 'active' : '' }}">
                        <i class="ri-search-line"></i> Search
                    </a>
                </li>
                <li>
                    <a href="/explore" class="{{ request()->is('explore') ? 'active' : '' }}">
                        <i class="ri-compass-3-line"></i> Explore
                    </a>
                </li>
                <li>
                    <a href="/collections" class="{{ request()->is('collections') ? 'active' : '' }}">
                        <i class="ri-bookmark-line"></i> Collection
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Right side: Theme Toggle and Auth Controls -->
        <div class="flex items-center gap-4">
            <!-- Theme toggle -->
            <button id="theme-toggle" class="btn btn-ghost btn-circle">
                <i class="ri-sun-line dark:hidden text-xl"></i>
                <i class="ri-moon-line hidden dark:inline-block text-xl"></i>
            </button>
            @auth
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img src="https://picsum.photos/200" alt="profile" />
                        </div>
                    </label>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="/profile">Profile</a></li>
                        <li><a href="/settings">Settings</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                        <i class="ri-login-box-line"></i>
                        <span class="ml-1">Login</span>
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline btn-sm">Register</a>
                </div>
            @endauth
        </div>
    </div>
</nav>