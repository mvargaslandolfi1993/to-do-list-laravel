<script setup>
import TheMenu from "../Components/TheMenu.vue";
</script>

<template>
    <div class="flex h-screen">
        <div
            class="fixed top-0 left-0 w-64 h-full p-4 border border-1 border-slate-300"
        >
            <TheMenu />
        </div>
        <div class="flex-1 ml-64 p-4 overflow-auto">
            <slot />
        </div>
    </div>
</template>
