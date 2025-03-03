<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainPart from "@/Components/MainPart.vue";

defineProps({
    products: Object,
})

</script>

<template>
    <Head title="Products List" />

    <main class="w-full flex items-center justify-center">
        <div class="max-w-[1000px] flex gap-3 flex-col">
            <MainPart :products="products"></MainPart>
        </div>
    </main>
</template>
