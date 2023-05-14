<!--suppress JSUnresolvedReference -->

<!-- Off-canvas menu for mobile -->
<div
    class="relative z-50 lg:hidden" role="dialog" aria-modal="true"
    x-show="isMobileMenuOpen === true"
>
    <!-- Off-canvas menu backdrop -->
    <div
        :class="isMobileMenuOpen === true ? 'opacity-100 transition-opacity ease-linear duration-300' : 'opacity-0 transition-opacity ease-linear duration-300'"
        class="fixed inset-0 bg-gray-900/80 opacity-0"></div>

    <div class="fixed inset-0 flex">
        <!-- Off-canvas menu -->
        <div
            :class="isMobileMenuOpen === true ? 'transition ease-in-out duration-300 transform translate-x-0' : 'transition ease-in-out duration-300 transform -translate-x-full'"
            class="relative mr-16 flex w-full max-w-xs flex-1"
        >
            <!-- Close button -->
            <div
                :class="isMobileMenuOpen === true ? 'ease-in-out duration-300 opacity-100' : 'ease-in-out duration-300 opacity-0'"
                class="absolute left-full top-0 flex w-16 justify-center pt-5"
            >
                <button type="button" class="-m-2.5 p-2.5" x-on:click="isMobileMenuOpen = false;">
                    <span class="sr-only">Close sidebar</span>
                    <x-laravel-ai::icons.close class="h-6 w-6 text-white" />
                </button>
            </div>

            <x-laravel-ai::menu.menu-items/>

        </div>
    </div>
</div>
