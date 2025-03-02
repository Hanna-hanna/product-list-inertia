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
            <Link :href="route('products.add-product')" class="bg-green-600 text-white p-2 rounded">
                Add Product
            </Link>
            <MainPart :products="products"></MainPart>
        </div>
    </main>
</template>
