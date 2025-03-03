<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Input from "@/Components/Input.vue";
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3'
import ProjectUploadFile from '@/Components/ProjectUploadFile.vue';

const props = defineProps({
    product: Object
});

const isLoading = ref(false);
const currentImage = ref(null);

function upload_file(e) {
    data_form.image = e;
}

const data_form = useForm({
    id: props.product?.data.id || null,
    name: props.product?.data.name || null,
    description: props.product?.data.description || null,
    rank: props.product?.data.rank || null,
    price: props.product?.data.price || null,
    stock: props.product?.data.stock || null,
    image: null,
    _method: 'PUT'
});

onMounted(() => {
    if (props.product?.image) {
        currentImage.value = props.product.image;
    }
});

const updateProduct = async () => {
    isLoading.value = true;

    data_form.post(route('products.update', props.product.data.id), {
        preserveScroll: true,
        onSuccess: () => {
            showNotification('Product updated successfully!', 'success');
            isLoading.value = false;
        },
        onError: errors => {
            showNotification('Please check form errors', 'error');
            isLoading.value = false;
        },
        onFinish: () => {
            isLoading.value = false;
        },
    });
}

const showNotification = (message, type) => {
    // This is a placeholder for a notification system
    console.log(`${type}: ${message}`);
}
</script>

<template>
    <Head title="Edit Product" />

    <main class="min-h-screen flex items-center justify-center bg-gradient-to-b from-gray-800 to-gray-900 text-white py-12 px-4">
        <div class="max-w-3xl w-full bg-gray-700 rounded-lg shadow-xl p-8">
            <header class="mb-8">
                <h2 class="text-3xl font-bold text-white border-b border-gray-600 pb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block mr-2 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit Product: {{ product?.name }}
                </h2>
            </header>

            <form @submit.prevent="updateProduct" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                class="w-full rounded-md bg-gray-600 border-gray-500 text-white focus:border-blue-400 focus:ring focus:ring-blue-400 focus:ring-opacity-50"
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
                                Product Image
                            </label>
                            <div v-if="currentImage" class="mb-3">
                                <p class="text-sm text-gray-300 mb-2">Current Image:</p>
                                <div class="relative w-40 h-40 rounded overflow-hidden">
                                    <img :src="currentImage" alt="Current product image" class="object-cover w-full h-full">
                                </div>
                            </div>
                            <div class="border-2 border-dashed border-gray-500 rounded-lg p-4 hover:border-blue-400 transition-colors">
                                <ProjectUploadFile @upload_file="upload_file($event)" :input-id="'photo'" />
                            </div>
                            <p class="text-sm text-gray-400 mt-1">Upload new image only if you want to change it</p>
                            <span v-if="data_form.errors.image" class="text-red-400 text-sm block">
                                {{ data_form.errors.image }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <Link
                        :href="route('products.index')"
                        class="px-6 py-3 bg-gray-600 text-white font-medium rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-colors"
                    >
                        CANCEL
                    </Link>

                    <button
                        type="submit"
                        class="px-8 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors disabled:opacity-50"
                        :disabled="isLoading"
                    >
                        <span v-if="isLoading" class="inline-block mr-2">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                        UPDATE PRODUCT
                    </button>
                </div>
            </form>
        </div>
    </main>
</template>
