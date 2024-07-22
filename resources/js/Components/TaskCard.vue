<script lang="ts" setup>
import { computed } from "vue";
import { useDateFormat } from "../Composables/useDateFormat";

const props = defineProps<{
    task: Record<string, any>;
}>();

const priority = computed(() => {
    if (props.task.priority === 1) {
        return {
            color: "red",
            icon: "pi pi-angle-double-up",
            severity: "danger",
            name: "High priority",
        };
    }

    return {
        color: "#54ab16",
        icon: "pi pi-angle-up",
        severity: "warning",
        name: "Low priority",
    };
});

const { formattedDate } = useDateFormat(props.task.due_date);
</script>

<template>
    <div class="bg-white shadow rounded px-3 pt-3 pb-2 border border-white">
        <div class="flex justify-between">
            <p
                class="text-gray-700 font-semibold font-sans tracking-wide text-sm"
            >
                {{ task.title }}
            </p>
        </div>
        <div class="flex mt-1 justify-between items-center">
            <span class="text-sm text-gray-600">{{ task.description }}</span>
        </div>

        <div class="flex mt-4 justify-between items-center">
            <span class="text-sm text-gray-600">{{ formattedDate }}</span>
            <Badge :value="task.category.name" severity="secondary"></Badge>
        </div>
        <div class="flex mt-2 justify-between items-center">
            <span class="text-sm align-middle">
                <i
                    class="pi text-sm aling-middle"
                    :class="priority.icon"
                    :style="{ color: priority.color }"
                ></i>
                {{ priority.name }}
            </span>
        </div>
    </div>
</template>
