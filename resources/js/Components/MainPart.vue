<script setup>
import { Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
    products: Object,
})


</script>

<template>
    <section class="tp-course-filter-area tp-course-filter-bg p-relative pt-180 pb-220">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tp-breadcrumb__content-filter mb-50">
                        <h3 class="tp-breadcrumb__title text-[40px] md:text-[56px] font-semibold m-0">
                            All Products
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tp-filter-mt-2">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div v-for="product in props.products.data" :key="product.id" class="tp-course-item col-xl-4 col-md-6 bg-gray-100 m-5 p-3 rounded w-full">
                                <div class="tp-course-thumb w-full max-w-[500px]">
                                    <img :src="`/product_images/${product.image}`"  :alt="product.name">
                                </div>
                                <div class="tp-course-content">
                                    <div class="tp-course-meta">
                                        <span class="flex items-center justify-start text-[30px] text-violet-900">
                                            <span>{{ product.name }}</span>
                                        </span>
                                          <span class="flex items-center justify-start text-[16px]">
                                            <span>{{ product.description }}</span>
                                          </span>
                                    </div>

                                    <div class="tp-course-rating d-flex align-items-center justify-content-between gap-2">
                                        <div class="text-blue-900 font-extrabold text-[14px] md:text-[1.3em] rounded w-[140px] text-left">
                                            Price: {{ product.price }}
                                        </div>
                                        <div class="text-blue-900 font-extrabold text-[14px] md:text-[1.3em] rounded w-[140px] text-left">
                                            Rank: {{ product.rank }}
                                        </div>
                                        <div class="text-blue-900 font-extrabold text-[14px] md:text-[1.3em] rounded w-[140px] text-left">
                                            Stock: {{ product.stock }}
                                        </div>
                                    </div>
                                </div>
                        <div class="flex gap-2">
                            <Link :href="route('products.destroy', product.id)" method="delete" class="bg-red-600 text-white p-2 rounded">
                               Delete Product
                            </Link>

<!--                            <Link :href="route('products.edit', product.id)" class="bg-green-600 text-white p-2 rounded">-->
<!--                                Edit Product-->
<!--                            </Link>-->
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>


<style scoped>

</style>
