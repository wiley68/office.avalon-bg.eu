<script setup>
const props = defineProps({
    tasks: Array,
    currentTaskId: Number,
});

defineEmits(["resetFormTask", "editTask", "deleteTask", "toggleTaskStatus"]);
</script>

<template>
    <div
        class="flex flex-col w-1/3 gap-1 p-2 mx-2 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-300"
        style="height: calc(100vh - 5rem)"
    >
        <div
            v-for="task in tasks"
            :key="task.id"
            class="flex items-center w-full border border-gray-200 p-2 cursor-pointer select-none hover:bg-gray-200 hover:border-gray-300"
            :class="
                currentTaskId === task.id
                    ? 'bg-gray-200 border-gray-300'
                    : 'bg-gray-50'
            "
        >
            <div
                class="flex items-center flex-grow font-medium"
                :class="
                    task.status ? 'line-through text-gray-400' : 'text-gray-900'
                "
                @click="
                    currentTaskId === task.id
                        ? $emit('resetFormTask')
                        : $emit('editTask', task)
                "
            >
                {{ task.name }}
            </div>
            <div class="flex-none">
                <button
                    class="px-2 py-1 rounded-md"
                    @click="$emit('toggleTaskStatus', task)"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-4 h-4 text-green-400 hover:text-green-600"
                    >
                        <path
                            d="M9,20.42L2.79,14.21L5.62,11.38L9,14.77L18.88,4.88L21.71,7.71L9,20.42Z"
                        />
                    </svg>
                </button>
            </div>
            <div class="flex-none">
                <button
                    class="px-2 py-1 rounded-md"
                    @click="$emit('deleteTask', task.id)"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-4 h-4 text-red-400 hover:text-red-600"
                    >
                        <path
                            d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>
