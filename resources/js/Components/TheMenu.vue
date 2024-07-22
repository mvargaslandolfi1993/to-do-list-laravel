<template>
    <div class="card flex justify-center">
        <Menu :model="items" class="w-full h-screen md:w-60">
            <template #start>
                <span class="inline-flex items-center gap-1 px-2 py-2">
                    <svg
                        width="30"
                        height="30"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <circle cx="12" cy="12" r="10" fill="#4CAF50" />
                        <!-- Círculo base verde -->
                        <rect
                            x="7"
                            y="7"
                            width="10"
                            height="2"
                            rx="1"
                            fill="white"
                        />
                        <!-- Línea 1 -->
                        <rect
                            x="7"
                            y="11"
                            width="10"
                            height="2"
                            rx="1"
                            fill="white"
                        />
                        <!-- Línea 2 -->
                        <rect
                            x="7"
                            y="15"
                            width="10"
                            height="2"
                            rx="1"
                            fill="white"
                        />
                        <!-- Línea 3 -->
                        <rect x="9" y="7" width="2" height="2" fill="white" />
                        <!-- Checkbox 1 -->
                        <rect x="9" y="11" width="2" height="2" fill="white" />
                        <!-- Checkbox 2 -->
                        <rect x="9" y="15" width="2" height="2" fill="white" />
                        <!-- Checkbox 3 -->
                    </svg>

                    <span class="text-xl font-semibold">To do list</span>
                </span>
            </template>
            <template #submenulabel="{ item }">
                <span class="text-primary font-bold">{{ item.label }}</span>
            </template>
            <template #item="{ item, props }">
                <a v-ripple class="flex items-center" v-bind="props.action">
                    <span :class="item.icon" />
                    <span>{{ item.label }}</span>
                    <Badge
                        v-if="item.badge"
                        class="ml-auto"
                        :value="item.badge"
                    />
                    <span
                        v-if="item.shortcut"
                        class="ml-auto border border-surface rounded bg-emphasis text-muted-color text-xs p-1"
                        >{{ item.shortcut }}</span
                    >
                </a>
            </template>
            <template #end>
                <div class="absolute bottom-0">
                    <button
                        v-ripple
                        class="relative overflow-hidden w-full border-0 bg-transparent flex items-start p-2 hover:bg-surface-100 dark:hover:bg-surface-800 rounded-none cursor-pointer transition-colors duration-200"
                    >
                        <Avatar
                            image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png"
                            class="mr-2"
                            shape="circle"
                        />
                        <span class="inline-flex flex-col items-start">
                            <span class="font-bold">Amy Elsner</span>
                            <span class="text-sm">Admin</span>
                        </span>
                    </button>
                </div>
            </template>
        </Menu>
    </div>
</template>

<script setup>
import { ref } from "vue";

const items = ref([
    {
        separator: true,
    },
    {
        label: "Tasks",
        items: [
            {
                label: "New",
                icon: "pi pi-plus",
            },
            {
                label: "All",
                icon: "pi pi-list",
            },
        ],
    },
    {
        label: "Profile",
        items: [
            {
                label: "Logout",
                icon: "pi pi-sign-out",
            },
        ],
    },
    {
        separator: true,
    },
]);
</script>
