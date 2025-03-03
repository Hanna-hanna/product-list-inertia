<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    products: Object,
});

const searchQuery = ref('');

// Computed property for filtered and sorted products
const filteredProducts = computed(() => {
    let result = [...props.products.data];

    // Filter by search query
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        result = result.filter(product =>
            product.name.toLowerCase().includes(query) ||
            product.description.toLowerCase().includes(query)
        );
    }

    return result;
});

// For confirmation dialog
const showDeleteConfirm = ref(false);
const productToDelete = ref(null);

const confirmDelete = (product) => {
    productToDelete.value = product;
    showDeleteConfirm.value = true;
};

const cancelDelete = () => {
    showDeleteConfirm.value = false;
    productToDelete.value = null;
};

const executeDelete = () => {
    // Navigate to delete route
    window.location.href = route('products.destroy', productToDelete.value.id);
    showDeleteConfirm.value = false;
};
</script>

<template>
    <div class="product-page">
        <!-- Hero Banner Section -->
        <section class="hero-section bg-gradient-to-r from-indigo-500 to-purple-600 py-16 relative overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="relative z-10">
                    <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">
                        Product Catalog
                    </h1>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-1/4 w-32 h-32 bg-white/5 rounded-full -mb-10"></div>
            </div>
        </section>

        <!-- Filter & Search Section -->
        <section class="py-8 bg-gray-50 border-b border-gray-200">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="w-full md:w-1/3">
                        <div class="relative">
                            <input
                                type="text"
                                v-model="searchQuery"
                                placeholder="Search products..."
                                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:border-transparent"
                            />
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>


                    <div class="w-full md:w-auto">
                        <Link
                            :href="route('products.add-product')"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add New Product
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Grid Section -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <!-- Empty state -->
                <div v-if="filteredProducts.length === 0" class="text-center py-16">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-700 mb-2">No products found</h3>
                    <p class="text-gray-500">Try adjusting your search or filters to find what you're looking for.</p>
                </div>

                <!-- Products grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        v-for="product in filteredProducts"
                        :key="product.id"
                        class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100"
                    >
                        <!-- Product image -->
                        <div class="aspect-video relative overflow-hidden bg-gray-100">
                            <img
                                :src="`/product_images/${product.image}`"
                                :alt="product.name"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                            />
                        </div>

                        <!-- Product info -->
                        <div class="p-5">
                            <h3 class="font-semibold text-xl text-gray-800 mb-2">{{ product.name }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ product.description }}</p>

                            <!-- Product details -->
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                <div class="bg-indigo-50 p-2 rounded-lg">
                                    <p class="text-xs text-indigo-600 font-medium">PRICE</p>
                                    <p class="font-bold text-gray-800">${{ product.price }}</p>
                                </div>
                                <div class="bg-amber-50 p-2 rounded-lg">
                                    <p class="text-xs text-amber-600 font-medium">RANK</p>
                                    <p class="font-bold text-gray-800">{{ product.rank }}</p>
                                </div>
                                <div class="bg-emerald-50 p-2 rounded-lg">
                                    <p class="text-xs text-emerald-600 font-medium">STOCK</p>
                                    <p class="font-bold text-gray-800">{{ product.stock }}</p>
                                </div>
                            </div>

                            <!-- Action buttons -->
                            <div class="flex gap-2">
                                <button
                                    @click="confirmDelete(product)"
                                    class="flex-1 bg-white border border-red-500 text-red-500 hover:bg-red-500 hover:text-white py-2 px-3 rounded-lg transition-colors text-sm font-medium"
                                >
                                    Delete
                                </button>
                                <Link
                                    :href="route('products.edit', product.id)"
                                    class="flex-1 bg-indigo-600 text-white hover:bg-indigo-700 py-2 px-3 rounded-lg transition-colors text-sm font-medium text-center"
                                >
                                    Edit
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="props.products.links && props.products.links.length > 3" class="mt-10 flex justify-center">
                    <div class="flex space-x-1">
                        <Link
                            v-for="(link, i) in props.products.links"
                            :key="i"
                            v-html="link.label"
                            :href="link.url"
                            :class="[
                'px-4 py-2 rounded-md border',
                link.active
                  ? 'bg-indigo-600 text-white border-indigo-600'
                  : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50',
                { 'opacity-50 cursor-not-allowed': !link.url }
              ]"
                        />
                    </div>
                </div>
            </div>
        </section>

        <!-- Confirmation modal -->
        <div v-if="showDeleteConfirm" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6 shadow-xl">
                <div class="text-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Confirm Deletion</h3>
                <p class="text-gray-600 mb-6">Are you sure you want to delete "{{ productToDelete?.name }}"? This action cannot be undone.</p>
                <div class="flex justify-end space-x-3">
                    <button
                        @click="cancelDelete"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg"
                    >
                        Cancel
                    </button>
                    <Link
                        :href="route('products.destroy', productToDelete?.id)"
                        method="delete"
                        as="button"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg"
                    >
                        Delete
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.hero-section {
    background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Smooth transitions */
.transition-colors {
    transition-property: background-color, border-color, color, fill, stroke;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

.transition-shadow {
    transition-property: box-shadow;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

.transition-transform {
    transition-property: transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}
</style>
