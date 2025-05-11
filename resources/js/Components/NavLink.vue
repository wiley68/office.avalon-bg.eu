<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  href: String,
  active: Boolean,
})

const classes = computed(() => {
  return props.active
    ? 'flex justify-center items-center text-neutral-200 bg-gray-800 rounded-md p-2'
    : 'flex justify-center items-center text-neutral-200 hover:bg-gray-800 p-2 hover:rounded-md'
})
</script>

<template>
  <Link :href="href" :class="classes">
    <slot></slot>
  </Link>
</template>
