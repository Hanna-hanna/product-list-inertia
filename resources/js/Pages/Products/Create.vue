<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Input from "@/Components/Input.vue";
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'
import ProjectUploadFile from '@/Components/ProjectUploadFile.vue';

const isLoading = ref(false);

function upload_file(e) {
    data_form.image = e;
}

const data_form = useForm({
    name: null,
    description: null,
    rank: null,
    price: null,
    stock: null,
    image: null
})

const dataForm = async () => {
    isLoading.value = true;

    data_form.post(route('products.store'), {
        preserveScroll: true,
        onSuccess: () => {
            showNotification('Product added successfully!', 'success');
            isLoading.value = false;
        },
        onError: errors => {
            showNotification('Please check form errors', 'error');
            isLoading.value = false;
        },
        onFinish: () => {
            isLoading.value = false;
        },
    })
}

const showNotification = (message, type) => {
    // This is a placeholder for a notification system
    console.log(`${type}: ${message}`);
}
</script>

<template>
    <Head title="Add Product" />

    <main class="min-h-screen flex items-center justify-center bg-gradient-to-b from-gray-800 to-gray-900 text-white py-12 px-4">
        <div class="max-w-3xl w-full bg-gray-700 rounded-lg shadow-xl p-8">
            <header class="mb-8">
                <h2 class="text-3xl font-bold text-white border-b border-gray-600 pb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block mr-2 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Product
                </h2>
            </header>

            <form @submit.prevent="dataForm" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left column -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <Input
                                type="text"
                                v-model="data_form.name"
                                :label="'Product Name*'"
                                required
                                autocomplete="name"
                                class="w-full"
                            />
                            <span v-if="data_form.errors.name" class="text-red-400 text-sm block">
                                {{ data_form.errors.name }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300 block">Description*</label>
                            <textarea
                                v-model="data_form.description"
                                required
                                rows="4"
                                class="w-full rounded-md bg-gray-600 border-gray-500 text-white focus:border-emerald-400 focus:ring focus:ring-emerald-400 focus:ring-opacity-50"
                            ></textarea>
                            <span v-if="data_form.errors.description" class="text-red-400 text-sm block">
                                {{ data_form.errors.description }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <Input
                                type="number"
                                step="0.01"
                                v-model="data_form.price"
                                :label="'Price*'"
                                required
                                class="w-full"
                            />
                            <span v-if="data_form.errors.price" class="text-red-400 text-sm block">
                                {{ data_form.errors.price }}
                            </span>
                        </div>
                    </div>

                    <!-- Right column -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <Input
                                type="number"
                                v-model="data_form.rank"
                                :label="'Rank*'"
                                required
                                class="w-full"
                            />
                            <span v-if="data_form.errors.rank" class="text-red-400 text-sm block">
                                {{ data_form.errors.rank }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <Input
                                type="number"
                                v-model="data_form.stock"
                                :label="'Stock*'"
                                required
                                class="w-full"
                            />
                            <span v-if="data_form.errors.stock" class="text-red-400 text-sm block">
                                {{ data_form.errors.stock }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300 block">
                                Upload Product Image
                            </label>
                            <div class="mt-1">
                                <div class="border-2 border-dashed border-gray-500 rounded-lg p-4 hover:border-emerald-400 transition-colors">
                                    <ProjectUploadFile @upload_file="upload_file($event)" :input-id="'photo'" />
                                </div>
                            </div>
                            <span v-if="data_form.errors.image" class="text-red-400 text-sm block">
                                {{ data_form.errors.image }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-8">
                    <button
                        type="submit"
                        class="px-8 py-3 bg-emerald-600 text-white font-medium rounded-md hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 transition-colors disabled:opacity-50"
                        :disabled="isLoading"
                    >
                        <span v-if="isLoading" class="inline-block mr-2">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                        SAVE PRODUCT
                    </button>
                </div>
            </form>
        </div>
    </main>
</template>
