<script setup>
import { Head } from "@inertiajs/vue3";
import Header from "./Partials/Header.vue";
import Footer from "./Partials/Footer.vue";

const props = defineProps({
    title: String,
    status: Number,
    search: String,
});
</script>

<template>
    <div>
        <Head :title="title"></Head>

        <div class="flex flex-col h-screen overflow-hidden">
            <Header :status="props.status" :search="props.search"></Header>
            <div
                class="flex justify-center gap-2 pt-2 bg-white w-full flex-grow select-none text-gray-900"
            >
                <slot></slot>
            </div>
            <Footer></Footer>
        </div>
        <notifications position="top center" />
    </div>
</template>
