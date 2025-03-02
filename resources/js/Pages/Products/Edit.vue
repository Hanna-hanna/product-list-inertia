<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    product: Object,
})

</script>

<template>
    <Head title="Edit Product" />

    <main class="w-full flex items-center justify-center">
        <div class="max-w-[1000px]">
            Edit Product
        </div>
    </main>
</template>
