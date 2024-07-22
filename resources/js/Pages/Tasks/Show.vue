<script lang="ts" setup>
import Layout from "../../Layouts/DefaultLayout.vue";
import { computed } from "vue";

const props = defineProps<{
    task: Record<string, any>;
}>();

const priority = computed(() => {
    if (props.task.priority === 1) {
        return "High priority";
    }

    return "Low Priority";
});
</script>

<template>
    <Layout>
        <div>
            <h1>Information about the task</h1>
            <p>Task name: {{ props.task.title }}</p>
            <p>Description: {{ props.task.description }}</p>
            <p>Status: {{ props.task.status }}</p>
            <p>Priority: {{ priority }}</p>
            <p>Due date: {{ props.task.due_date }}</p>
            <p>Category: {{ props.task.category.name }}</p>
        </div>

        <div>
            <h2>Tags</h2>
            <ul>
                <li v-for="tag in props.task.tags" :key="tag.id">
                    {{ tag.name }}
                </li>
            </ul>
        </div>
        <div>
            <h2>Las 3 Comments</h2>
            <ul>
                <li v-for="comment in props.task.comments" :key="comment.id">
                    {{ comment.content }}
                </li>
            </ul>
        </div>

        <div>
            <h2>Last 3 Sub Tasks</h2>
            <ul>
                <li v-for="subtask in props.task.subtasks" :key="subtask.id">
                    {{ subtask.title }}
                </li>
            </ul>
        </div>

        <div>
            <h2>Last 3 Reminders</h2>
            <ul>
                <li v-for="reminder in props.task.reminders" :key="reminder.id">
                    Remint At: {{ reminder.remind_at }},
                    {{ reminder.is_sent !== 0 ? "Sended" : "Not Sended" }}
                </li>
            </ul>
        </div>
    </Layout>
</template>
