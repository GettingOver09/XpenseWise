<script setup>
import Sidebar from '@/Components/Navigation/Sidebar.vue';
import Topbar from '@/Components/Navigation/Topbar.vue';
</script>

<template>
    <div class="flex h-screen bg-background text-ctext">
        <Sidebar />

        <!-- Container -->
        <div class="flex-1 flex flex-col pr-2 py-2">

            <!-- Wrapper -->
            <main class="flex-1 flex flex-col overflow-hidden border border-1 border-muted/20 rounded-xl">
                <Topbar/>
                  <div class="flex-1 overflow-y-auto pb-2 custom-scrollbar">
                    <div class="max-w-[1224px] mx-auto pb-2">
                        <slot/>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>