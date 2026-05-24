<script setup>
import Sidebar from '@/Components/Navigation/Sidebar.vue';
import Topbar from '@/Components/Navigation/Topbar.vue';
</script>

<template>
    <div class="flex min-h-screen bg-background text-ctext">
        <Sidebar />
        <div class="flex-1 flex flex-col">
            <Topbar/>
            
            <main class="p-6">
                <slot/>
            </main>
        </div>
    </div>
</template>