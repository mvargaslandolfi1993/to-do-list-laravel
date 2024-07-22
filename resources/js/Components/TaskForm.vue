<script setup lang="ts">
import { ref } from "vue";
import { inject } from "vue";
import { router } from "@inertiajs/vue3";

const dialogRef: any = inject("dialogRef");

const closeDialog = (e) => {
    dialogRef.value.close(e);
};

const props = defineProps<{
    task: Record<string, any>;
}>();

const statuses = ref([
    { id: "Pending", name: "Pending" },
    { id: "In Progress", name: "In Progress" },
    { id: "Completed", name: "Completed" },
]);

const form = ref({
    title: props.task.title ?? "",
    description: props.task.description ?? "",
    status: props.task.status ?? "pending",
    due_date: props.task.due_date ?? "",
    category_id: props.task.category_id ?? "",
    priority: props.task.priority ?? 1,
});

const categories = ref([
    { id: 1, name: "Personal" },
    { id: 2, name: "Work" },
    { id: 3, name: "Home" },
]);

const submitForm = () => {
    router.post("/tasks", { ...form });
};
</script>

<template>
    <div class="flex flex-col w-full">
        <form class="w-full p-5" @submit.prevent="submitForm">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="title"
                    >
                        Title
                    </label>
                    <input
                        v-model="form.title"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="title"
                        type="text"
                        placeholder="Title"
                    />
                    <p class="text-red-500 text-xs italic">
                        Please fill out this field.
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="description"
                    >
                        Description
                    </label>
                    <Textarea
                        v-model="form.description"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="description"
                        autoResize
                        rows="5"
                        cols="30"
                        placeholder="Description"
                    ></Textarea>
                    <p class="text-gray-600 text-xs italic">
                        Tell us more about the task.
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="status"
                    >
                        Status
                    </label>
                    <div class="relative">
                        <select
                            v-model="form.status"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="status"
                        >
                            <option
                                v-for="status in statuses"
                                :key="status.id"
                                :value="status.id"
                                :selected="form.status === status.id"
                            >
                                {{ status.name }}
                            </option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                        >
                            <svg
                                class="fill-current h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                />
                                <path
                                    fill-rule="evenodd"
                                    d="M3 10a7 7 0 1114 0 7 7 0 01-14 0zm7-9a9 9 0 100 18 9 9 0 000-18z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="due_date"
                    >
                        Due Date
                    </label>
                    <input
                        v-model="form.due_date"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="due_date"
                        type="date"
                        placeholder="Due Date"
                    />
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="category"
                    >
                        Category
                    </label>
                    <div class="relative">
                        <select
                            v-model="form.category_id"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="category"
                        >
                            <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                        >
                            <svg
                                class="fill-current h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                />
                                <path
                                    fill-rule="evenodd"
                                    d="M3 10a7 7 0 1114 0 7 7 0 01-14 0zm7-9a9 9 0 100 18 9 9 0 000-18z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="priority"
                    >
                        Priority
                    </label>
                    <div class="relative">
                        <select
                            v-model="form.priority"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="priority"
                        >
                            <option value="0" :selected="form.priority === 0">
                                Low
                            </option>
                            <option value="1" :selected="form.priority === 1">
                                High
                            </option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                        >
                            <svg
                                class="fill-current h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                />
                                <path
                                    fill-rule="evenodd"
                                    d="M3 10a7 7 0 1114 0 7 7 0 01-14 0zm7-9a9 9 0 100 18 9 9 0 000-18z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="flex justify-end w-full px-3">
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    >
                        Save
                    </button>

                    <button
                        type="button"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 ml-4 px-4 rounded focus:outline-none focus:shadow-outline"
                        @click="closeDialog({ buttonType: 'Cancel' })"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
