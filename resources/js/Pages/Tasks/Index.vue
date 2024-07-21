<script lang="ts" setup>
import Layout from "../../Layouts/DefaultLayout.vue";
import { defineProps } from "vue";

const props = defineProps<{
  tasks: {
    data: Record<string, any>[],
    links: Record<string, any>,
    meta: Record<string, any>,
  },
}>()

</script>

<template>
    <Layout>
        <h1>Tareas</h1>

        <a class="nav-link" :href="route('tasks.create')">Create Task</a>

        <ul>
            <li v-for="task in props.tasks.data" :key="task.id">
                <h3>{{ task.title }}</h3>
                <ul>
                    <p><strong>Description:</strong> {{ task.description }}</p>
                    <p><strong>Status:</strong> {{ task.status }}</p>
                    <p><strong>Priority:</strong> {{ task.priority }}</p>
                    <p><strong>Due date:</strong> {{ task.due_date }}</p>
                    <p><strong>Category:</strong> {{ task.category.name }}</p>
                    <a class="nav-link" :href="route('tasks.show', task.id)">More details</a>
                </ul>
            </li>
        </ul>
    </Layout>
</template>
