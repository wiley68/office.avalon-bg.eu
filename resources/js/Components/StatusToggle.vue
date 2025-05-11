<script setup>
const emit = defineEmits(["update:modelValue"]);

defineProps({
    modelValue: Number,
});

const toggleChecked = (checked) => {
    emit("update:modelValue", checked);
};
</script>

<template>
    <label
        @click.prevent="toggleChecked(modelValue === 0 ? 1 : 0)"
        class="inline-flex items-center cursor-pointer"
    >
        <div
            class="relative w-11 h-6 rounded-full after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600"
            :class="
                modelValue === 1
                    ? 'bg-gray-200 dark:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 after:translate-x-full rtl:after:-translate-x-full after:border-white'
                    : 'bg-blue-600'
            "
        ></div>
        <span
            class="ms-3 text-sm font-medium"
            :class="
                modelValue === 1
                    ? 'line-through text-gray-400 dark:text-gray-700'
                    : 'text-gray-900 dark:text-gray-300'
            "
            >{{ modelValue === 1 ? "Приключена" : "Активна" }}</span
        >
    </label>
</template>
