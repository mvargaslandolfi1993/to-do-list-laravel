<template>
    <div v-if="isLoading">
        <p>Cargando...</p>
    </div>
    <div v-else>
        <TaskForm :task="task" />
    </div>
</template>

<script lang="ts" setup>
import { inject, ref, onMounted } from "vue";
import TaskForm from "./TaskForm.vue";

const dialogRef: any = inject("dialogRef");

const isLoading = ref(true);

const task = ref({});

onMounted(() => {
    task.value = dialogRef.value.data.task;
    isLoading.value = false;
});
</script>
<style>
.p-dialog-mask {
    background: rgba(0, 0, 0, 0.5) !important; /* Cambia la opacidad a 50% */
}
</style>
