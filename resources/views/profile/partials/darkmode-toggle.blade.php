<section>
    <header>
        <h2 class="text-lg font-medium text-ctext dark:text-ctext-dark">
            {{ __('Dark Mode') }}
        </h2>
        <p class="mt-1 text-sm text-ctext dark:text-ctext-dark">
            {{ __('Toggle dark mode on or off.') }}
        </p>
    </header>

    <div class="mt-5">
        <label class="relative flex items-center cursor-pointer">
            <!-- Checkbox -->
            <input type="checkbox" class="sr-only peer" :checked="theme === 'dark'"
                @click="theme = (theme === 'dark' ? 'light' : 'dark')">

            <!-- Background -->
            <div class="w-12 h-6 bg-gray-300 rounded-full shadow-inner transition peer-checked:bg-blue-600"></div>

            <!-- Knob -->
            <div
                class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transition-transform peer-checked:translate-x-6">
            </div>
        </label>
    </div>
</section>
