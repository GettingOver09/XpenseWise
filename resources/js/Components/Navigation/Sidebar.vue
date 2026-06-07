<script setup>
    import navigation from '@/Data/navigation.js';
    import Logo from '@/Assets/Logo.svg';
    import { CircleArrowLeft02Icon } from '@/Components/Icons';
    import { useSidebarStore } from '@/Stores/sidebar';
    import { Link, usePage } from '@inertiajs/vue3';
    import { reactive } from 'vue';

    const page = usePage();
    const sidebarStore = useSidebarStore();
    const tooltip = reactive({
        visible: false,
        label: '',
        top: 0,
        left: 0,
    });

    const isActive = (routeName) => {
        if (!routeName) return false;
        const currentRoute = route().current();
        
        return currentRoute === routeName ||
            currentRoute === `${routeName}.index` ||
            (currentRoute && currentRoute.startsWith(routeName + '.')) ||
            page.url.startsWith(`/${routeName}`);
    };

    const itemClasses = (item) => [
        'flex w-full items-center gap-3 rounded-lg px-4 py-3 text-left transition',
        isActive(item.route)
            ? 'bg-gray-200 text-ctext dark:bg-gray-700'
            : 'text-muted hover:bg-gray-100 hover:text-ctext dark:hover:bg-gray-700',
    ];

    const sidebarButtonClasses = [
        'flex w-full items-center gap-3 rounded-lg px-4 py-3 text-left transition',
        'text-muted hover:bg-gray-100 hover:text-ctext dark:hover:bg-gray-700',
    ];

    const toggleCollapse = () => {
        sidebarStore.toggle();
    };

    const showTooltip = (event, item) => {
        if (!sidebarStore.collapsed) return;

        const rect = event.currentTarget.getBoundingClientRect();

        tooltip.visible = true;
        tooltip.label = item.label;
        tooltip.top = rect.top + rect.height / 2;
        tooltip.left = rect.right + 12;
    };

    const hideTooltip = () => {
        tooltip.visible = false;
    };
</script>

<template>
    <aside  :class="[
        'flex flex-col min-h-screen bg-background no-scrollbar overflow-y-auto overflow-x-hidden transition-all duration-300',
        sidebarStore.collapsed ? 'w-20' : 'w-52'
    ]">
    
        <!-- Brand Logo -->
        <div class="flex items-end pl-5 py-4 gap-3 dark:border-gray-700">
            <img
                :src="Logo"
                alt="XpenseWise Logo"
                class="h-8 w-8 shrink-0"
            />

            <h1
                v-show="!sidebarStore.collapsed"
                class="text-xl font-bold bg-gradient-to-r from-[#083264] to-[#ACF517] bg-clip-text text-transparent"
            >
                XpenseWise
            </h1>
        </div>

        <!-- Main Navigation -->
        <nav class="flex-1 p-3 flex flex-col gap-2">
            <div
                v-for="item in navigation.main"
                :key="item.label"
                class="group relative"
            >   
                <Link
                    :href="route(item.route)"
                    :class="itemClasses(item)"
                    @mouseenter="showTooltip($event, item)"
                    @mouseleave="hideTooltip"
                    @focusin="showTooltip($event, item)"
                    @focusout="hideTooltip"
                >
                    <component :is="item.icon" class="shrink-0" size="22" />
                    <span v-show="!sidebarStore.collapsed">{{ item.label }}</span>
                </Link>
            </div>
        </nav>

        <!-- Secondary Items + Collapse (at bottom) -->
        <div class="p-3 border-muted/20 dark:border-gray-700 mt-auto">
            <div class="flex flex-col gap-2">
                <div
                    v-for="item in navigation.secondary"
                    :key="item.label"
                    class="group relative"
                >
                    <Link
                        :href="route(item.route)"
                        :class="itemClasses(item)"
                        @mouseenter="showTooltip($event, item)"
                        @mouseleave="hideTooltip"
                        @focusin="showTooltip($event, item)"
                        @focusout="hideTooltip"
                    >
                        <component :is="item.icon" class="shrink-0" size="22" />
                        <span v-show="!sidebarStore.collapsed">{{ item.label }}</span>
                    </Link>
                </div>

                <!-- Collapse Button -->
               <button
                    @click="toggleCollapse"
                    :class="sidebarButtonClasses"
                >
                    <component :is="CircleArrowLeft02Icon" 
                        class="shrink-0" 
                        size="22" 
                        :class="{
                            'rotate-180': sidebarStore.collapsed
                        }"
                    />
                    <span v-show="!sidebarStore.collapsed">Collapse</span>
                </button>
            </div>
        </div>
    </aside>

    <Teleport to="body">
        <div
            v-if="tooltip.visible"
            class="pointer-events-none fixed z-50 -translate-y-1/2 whitespace-nowrap rounded-md bg-gray-900 px-3 py-2 text-sm text-white shadow-lg"
            :style="{ top: `${tooltip.top}px`, left: `${tooltip.left}px` }"
        >
            {{ tooltip.label }}
        </div>
    </Teleport>
</template>
