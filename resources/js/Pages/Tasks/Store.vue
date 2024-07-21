<script lang="ts" setup>
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";

const form = reactive({
    title: null,
    description: null,
    due_date: null,
    priority: null,
    category_id: null,
    user_id: null,
});

function submit() {
    router.post("/tasks", form);
}
</script>

<template>
    <form @submit.prevent="submit">
        <label for="title">Title</label>
        <input type="text" id="title" v-model="form.title" />

        <label for="description">Description</label>
        <textarea id="description" v-model="form.description"></textarea>

        <label for="due_date">Due date</label>
        <input type="date" id="due_date" v-model="form.due_date" />

        <label for="priority">Priority</label>
        <select id="priority" v-model="form.priority">
            <option value="0">High</option>
            <option value="1">Low</option>
        </select>

        <label for="category_id">Category</label>
        <select id="category_id" v-model="form.category_id">
            <option value="9c925b9a-c635-4787-8907-8fe67ad22aa5">est</option>
        </select>

        <label for="user_id">User</label>
        <select id="user_id" v-model="form.user_id">
            <option value="1">User 1</option>
        </select>

        <button type="submit">Create task</button>
    </form>
</template>
