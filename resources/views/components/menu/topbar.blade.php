<div
    class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
    <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
            x-on:click="isMobileMenuOpen = !isMobileMenuOpen;">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </svg>
    </button>

    <!-- Separator
    <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true"></div>
    -->

    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6 justify-end">

        <div class="flex items-center gap-x-4 lg:gap-x-6">

            <!-- Notification
            <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                <span class="sr-only">View notifications</span>
                <x-laravel-ai::icons.outline-bell class="h-6 w-6" />
            </button>
            -->

            <!-- Separator
            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"></div>

            -->

            <!-- Profile dropdown -->
            <div
                class="relative"
                x-data="{ isProfileMenuOpen: false }"
            >
                <button
                    x-on:click="isProfileMenuOpen = !isProfileMenuOpen"
                    type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button" aria-expanded="false"
                    aria-haspopup="true">

                    <span class="sr-only">Open user menu</span>
                    <img class="h-8 w-8 rounded-full bg-gray-50" src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(auth()->user()->email)))  }}" alt="">
                    <span class="hidden lg:flex lg:items-center">
                    <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">{{ auth()->user()->name }}</span>
                        <x-laravel-ai::icons.mini-chevron-down class="ml-2 h-5 w-5 text-gray-400" />
                    </span>
                </button>

                <!-- Dropdown menu -->
                <div
                    x-show="isProfileMenuOpen"
                    :class="isProfileMenuOpen ? 'transition ease-out duration-100 transform opacity-100 scale-100' : 'transition ease-in duration-75 transform opacity-0 scale-95'"
                    class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                >
                    <!-- Active: "bg-gray-50", Not Active: "" -->
                    <a target="_blank" href="{{ route(insideauth()->route_profile_edit) }}"
                       class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50" role="menuitem"
                       tabindex="-1" id="user-menu-item-0">Your profile</a>
                    <form method="post" action="{{ route(insideauth()->route_logout) }}"
                          class="block m-0 p-0 w-full">
                        @csrf
                        <button type="submit"
                                class="block text-left w-full px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50"
                                role="menuitem" tabindex="-1" id="user-menu-item-1">Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
