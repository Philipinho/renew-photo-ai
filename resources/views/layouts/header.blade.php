<!-- Site header -->
<header class="fixed w-full z-30 md:bg-opacity-90 transition duration-300 ease-in-out" x-data="{ top: true }"
        @scroll.window="top = window.pageYOffset > 10 ? false : true"
        :class="{ 'bg-white dark:bg-gray-800 backdrop-blur-sm shadow-lg' : !top }">
    <div class="max-w-6xl mx-auto px-5 sm:px-6">
        <div class="flex items-center justify-between h-16 md:h-20">

            <!-- Site branding -->
            <div class="shrink-0 mr-4">
                <!-- Logo -->
                <a class="block" href="/" aria-label="home">
                    <svg class="w-8 h-8" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <radialGradient cx="21.152%" cy="86.063%" fx="21.152%" fy="86.063%" r="79.941%"
                                            id="header-logo">
                                <stop stop-color="#4FD1C5" offset="0%"/>
                                <stop stop-color="#81E6D9" offset="25.871%"/>
                                <stop stop-color="#338CF5" offset="100%"/>
                            </radialGradient>
                        </defs>
                        <rect width="32" height="32" rx="16" fill="url(#header-logo)" fill-rule="nonzero"/>
                    </svg>
                </a>
            </div>

            <!-- Desktop navigation -->
            <nav class="hidden md:flex md:grow">

                <!-- Desktop menu links -->
                <ul class="flex grow justify-end flex-wrap items-center">
                    <li>
                        <a class="px-3 lg:px-5 py-2 flex items-center transition duration-150 ease-in-out"
                           href="/">Home</a>
                    </li>
                    <li>
                        <a class="px-3 lg:px-5 py-2 flex items-center transition duration-150 ease-in-out"
                           href="#faq">FAQ</a>
                    </li>
                    <li>
                        <a class="px-3 lg:px-5 py-2 flex items-center transition duration-150 ease-in-out"
                           href="/">About</a>
                    </li>
                </ul>


                <!-- Desktop lights switch -->
                <div class="form-switch flex flex-col justify-center ml-3">
                    <input type="checkbox" name="light-switch" id="light-switch-desktop" class="light-switch sr-only" />
                    <label class="relative" for="light-switch-desktop">
                        <span class="relative bg-gradient-to-t from-gray-100 to-white dark:from-gray-800 dark:to-gray-700 shadow-sm z-10" aria-hidden="true"></span>
                        <svg class="absolute inset-0" width="44" height="24" viewBox="0 0 44 24" xmlns="http://www.w3.org/2000/svg">
                            <g class="fill-current text-white" fill-rule="nonzero" opacity=".88">
                                <path d="M32 8a.5.5 0 00.5-.5v-1a.5.5 0 10-1 0v1a.5.5 0 00.5.5zM35.182 9.318a.5.5 0 00.354-.147l.707-.707a.5.5 0 00-.707-.707l-.707.707a.5.5 0 00.353.854zM37.5 11.5h-1a.5.5 0 100 1h1a.5.5 0 100-1zM35.536 14.829a.5.5 0 00-.707.707l.707.707a.5.5 0 00.707-.707l-.707-.707zM32 16a.5.5 0 00-.5.5v1a.5.5 0 101 0v-1a.5.5 0 00-.5-.5zM28.464 14.829l-.707.707a.5.5 0 00.707.707l.707-.707a.5.5 0 00-.707-.707zM28 12a.5.5 0 00-.5-.5h-1a.5.5 0 100 1h1a.5.5 0 00.5-.5zM28.464 9.171a.5.5 0 00.707-.707l-.707-.707a.5.5 0 00-.707.707l.707.707z" />
                                <circle cx="32" cy="12" r="3" />
                                <circle fill-opacity=".4" cx="12" cy="12" r="6" />
                                <circle fill-opacity=".88" cx="12" cy="12" r="3" />
                            </g>
                        </svg>
                        <span class="sr-only">Switch to light / dark mode</span>
                    </label>
                </div>

                <!-- Desktop sign in links -->
                <ul class="flex grow justify-end flex-wrap items-center">
                    <li>
                        <a class="font-medium px-5 py-3 flex items-center transition duration-150 ease-in-out"
                           href="">Sign in</a>
                    </li>
                    <li>
                        <a href="">
                            <x-primary-button>
                                <span>Sign up</span>
                                <svg class="w-3 h-3 fill-current text-gray-400 shrink-0 ml-2 -mr-1" viewBox="0 0 12 12"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.707 5.293L7 .586 5.586 2l3 3H0v2h8.586l-3 3L7 11.414l4.707-4.707a1 1 0 000-1.414z"
                                        fill-rule="nonzero"/>
                                </svg>
                            </x-primary-button>
                        </a>
                    </li>
                </ul>

            </nav>

            <!-- Mobile menu -->
            <div class="flex md:hidden" x-data="{ expanded: false }">

                <!-- Mobile lights switch -->
                <div class="form-switch flex flex-col justify-center mr-6 -mt-0.5">
                    <input type="checkbox" name="light-switch" id="light-switch-mobile" class="light-switch sr-only" />
                    <label class="relative" for="light-switch-mobile">
                        <span class="relative bg-gradient-to-t from-gray-100 to-white dark:from-gray-800 dark:to-gray-700 shadow-sm z-10" aria-hidden="true"></span>
                        <svg class="absolute inset-0" width="44" height="24" viewBox="0 0 44 24" xmlns="http://www.w3.org/2000/svg">
                            <g class="fill-current text-white" fill-rule="nonzero" opacity=".88">
                                <path d="M32 8a.5.5 0 00.5-.5v-1a.5.5 0 10-1 0v1a.5.5 0 00.5.5zM35.182 9.318a.5.5 0 00.354-.147l.707-.707a.5.5 0 00-.707-.707l-.707.707a.5.5 0 00.353.854zM37.5 11.5h-1a.5.5 0 100 1h1a.5.5 0 100-1zM35.536 14.829a.5.5 0 00-.707.707l.707.707a.5.5 0 00.707-.707l-.707-.707zM32 16a.5.5 0 00-.5.5v1a.5.5 0 101 0v-1a.5.5 0 00-.5-.5zM28.464 14.829l-.707.707a.5.5 0 00.707.707l.707-.707a.5.5 0 00-.707-.707zM28 12a.5.5 0 00-.5-.5h-1a.5.5 0 100 1h1a.5.5 0 00.5-.5zM28.464 9.171a.5.5 0 00.707-.707l-.707-.707a.5.5 0 00-.707.707l.707.707z" />
                                <circle cx="32" cy="12" r="3" />
                                <circle fill-opacity=".4" cx="12" cy="12" r="6" />
                                <circle fill-opacity=".88" cx="12" cy="12" r="3" />
                            </g>
                        </svg>
                        <span class="sr-only">Switch to light / dark mode</span>
                    </label>
                </div>

                <!-- Hamburger button -->
                <button
                    class="hamburger"
                    :class="{ 'active': expanded }"
                    @click.stop="expanded = !expanded"
                    aria-controls="mobile-nav"
                    :aria-expanded="expanded"
                >
                    <span class="sr-only">Menu</span>
                    <svg class="w-6 h-6 fill-current text-gray-900" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <rect y="4" width="24" height="2"/>
                        <rect y="11" width="24" height="2"/>
                        <rect y="18" width="24" height="2"/>
                    </svg>
                </button>

                <!-- Mobile navigation -->
                <nav
                    id="mobile-nav"
                    class="absolute top-full h-screen pb-16 z-20 left-0 w-full overflow-scroll bg-white"
                    @click.outside="expanded = false"
                    @keydown.escape.window="expanded = false"
                    x-show="expanded"
                    x-transition:enter="transition ease-out duration-200 transform"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-out duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    x-cloak
                >
                    <ul class="px-5 py-2">
                        <li>
                            <a class="flex py-2" href="/">Home</a>
                        </li>
                        <li>
                            <a class="flex py-2" href="#faq">FAQ</a>
                        </li>
                        <li>
                            <a class="flex py-2" href="">About</a>
                        </li>
                        <div class="py-2 my-2 border-b border-gray-200"></div>


                        <li>
                            <a class="flex font-medium w-full py-2 justify-center"
                               href="">Sign in</a>
                        </li>
                        <li>
                            <a href="">
                                <x-primary-button class="bg-gray-900 hover:bg-gray-800 w-full my-2">
                                    <span>Sign up</span>
                                    <svg class="w-3 h-3 fill-current text-gray-400 shrink-0 ml-2 -mr-1" viewBox="0 0 12 12"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.707 5.293L7 .586 5.586 2l3 3H0v2h8.586l-3 3L7 11.414l4.707-4.707a1 1 0 000-1.414z"
                                            fill-rule="nonzero"/>
                                    </svg>
                                </x-primary-button>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>

        </div>
    </div>
</header>
