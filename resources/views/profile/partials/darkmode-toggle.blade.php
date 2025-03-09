<section>
    <header>
        <h2 class="text-lg font-medium text-ctext dark:text-ctext-dark">
            {{ __('Dark Mode') }}
        </h2>

        <p class="mt-1 text-sm text-ctext dark:text-ctext-dark">
            {{ __('Toggle dark mode on or off.') }}
        </p>
    </header>

    <div x-data x-bind:class="{ 'dark': theme === 'dark' }" class="mt-5">
        <label class="relative flex items-center cursor-pointer">
            <input type="checkbox" class="sr-only" @click="theme = (theme === 'dark' ? 'light' : 'dark')">

            <!-- Background -->
            <div class="w-12 h-6 bg-gray-300 rounded-full shadow-inner transition"
                :class="{ 'bg-blue-500': theme === 'dark' }"></div>

            <!-- Knob -->
            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transition-transform"
                :class="{ 'translate-x-6': theme === 'dark' }"></div>
        </label>
    </div>

</section>
