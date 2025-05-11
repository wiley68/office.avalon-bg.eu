<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useNotification } from "@kyvg/vue3-notification";
import Sidebar from "./Components/Sidebar.vue";
import Body from "./Components/Body.vue";

const props = defineProps({
    tasks: Array,
    status: Number,
});

const { notify } = useNotification();
const isEditing = ref(false);
const currentTaskId = ref(null);

const formTask = useForm({
    name: "",
    value: "",
    status: props.status,
});

const submitTask = () => {
    if (isEditing.value) {
        formTask.put(`/tasks/${currentTaskId.value}`, {
            onSuccess: () => {
                notify({
                    title: "Съобщение",
                    text: "Успешно записахте промените!",
                    type: "success",
                });
            },
        });
    } else {
        formTask.post("/tasks", {
            onSuccess: () => {
                notify({
                    title: "Съобщение",
                    text: "Успешно създадохте записа!",
                    type: "success",
                });
            },
        });
    }
};

const toggleTaskStatus = (task) => {
    formTask.name = task.name;
    formTask.value = task.value;
    formTask.status = task.status === 0 ? 1 : 0;
    currentTaskId.value = task.id;
    isEditing.value = true;
    formTask.put(`/tasks/${task.id}`, {
        onSuccess: () => {
            notify({
                title: "Съобщение",
                text: "Успешно променихте статуса на задачата!",
                type: "success",
            });
        },
    });
};

const editTask = (task) => {
    formTask.name = task.name;
    formTask.value = task.value;
    formTask.status = task.status;
    currentTaskId.value = task.id;
    isEditing.value = true;
};

const resetFormTask = () => {
    formTask.name = "";
    formTask.value = "";
    formTask.status = 0;
    currentTaskId.value = null;
    isEditing.value = false;
};

const deleteTask = (id) => {
    if (confirm("Are you sure you want to delete this task?")) {
        resetFormTask();
        formTask.delete(`/tasks/${id}`);
    }
};
</script>

<template>
    <AppLayout title="Dashboard" :status="props.status">
        <Sidebar
            :tasks="tasks"
            :currentTaskId="currentTaskId"
            @resetFormTask="resetFormTask"
            @editTask="editTask"
            @deleteTask="deleteTask"
            @toggleTaskStatus="toggleTaskStatus"
        ></Sidebar>
        <Body
            :formTask="formTask"
            :isEditing="isEditing"
            @submitTask="submitTask"
            @resetFormTask="resetFormTask"
        ></Body>
    </AppLayout>
</template>
