<template>
    <DefaultLayout>
        <div class="container mx-auto p-4">
            <h1 class="text-2xl mb-4">Tareas</h1>
            <div class="flex space-x-2">
                <draggable
                    v-for="(taskGroup, index) in taskGroups"
                    :key="index"
                    v-model="taskGroup.tasks"
                    item-key="id"
                    :group="{ name: 'tasks' }"
                    @end="onTaskEndDrop($event, index)"
                    class="w-1/3 p-2 bg-gray-100 rounded"
                >
                    <template #header>
                        <h2 class="text-xl font-semibold mb-3 p-1">
                            {{ taskGroup.name }}
                        </h2>
                    </template>
                    <template #item="{ element }">
                        <div
                            class="task-item bg-white p-5 mt-2 mb-3 rounded shadow"
                        >
                            <TaskCard
                                :task="element"
                                @click="showTaskDetails(element)"
                            />
                        </div>
                    </template>
                </draggable>
            </div>
            <DynamicDialog />
        </div>
    </DefaultLayout>
</template>

<script lang="ts" setup>
import { cloneDeep } from "lodash-es";
import { reactive, defineAsyncComponent } from "vue";
import draggable from "vuedraggable";
import DefaultLayout from "../../Layouts/DefaultLayout.vue";
import TaskCard from "../../Components/TaskCard.vue";
import { useDialog } from "primevue/usedialog";

const TaskDetails = defineAsyncComponent(
    () => import("../../Components/TaskDetails.vue")
);

const dialog = useDialog();

const props = defineProps<{
    tasks: {
        data: Record<string, any>[];
        links: Record<string, any>;
        meta: Record<string, any>;
    };
}>();

const tasks = cloneDeep(props.tasks.data);

const hash = tasks.reduce(
    (previous, current) => (
        previous[current.status]
            ? previous[current.status].push(current)
            : (previous[current.status] = [current]),
        previous
    ),
    {}
);

const grouped = Object.keys(hash).map((k) => ({ name: k, tasks: hash[k] }));

const taskGroups = reactive(grouped);

const showTaskDetails = (element) => {
    const dialogRef = dialog.open(TaskDetails, {
        props: {
            header: "Task details",
            style: {
                width: "50vw",
            },
            breakpoints: {
                "960px": "75vw",
                "640px": "90vw",
            },
            modal: true,
        },
        data: {
            task: element,
        },
        onClose: (options) => {
            console.log(options);
        },
    });
};

const onTaskEndDrop = (event, index) => {
    // This event is triggered when an item is dropped in a column
    // Update the task status
    //   console.log(event)
    console.log("INDEX", index);

    if (event.from !== event.to) {
        const task = event.item;
    }
};

const log = (event, index) => {
    console.log("INDEX", index);
    //   console.log('Added', event.added);
    //   console.log('Removed', event.removed);
};
</script>

<style>
.container {
    max-width: 1200px;
}

.task-item {
    cursor: move;
}

.p-dialog-mask {
    background: rgba(0, 0, 0, 0.5) !important; /* Cambia la opacidad a 50% */
}
</style>
