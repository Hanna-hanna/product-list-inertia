<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Input from "@/Components/Input.vue";
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'
import ProjectUploadFile from '@/Components/ProjectUploadFile.vue';

function upload_file(e) {
    console.log(e);
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
    data_form.post(route('products.store'), {
        preserveScroll: true,
        onSuccess: () => {
            console.log(1);
        },
        onError: errors => {
            console.log(2);
        },
        onFinish: () => {
            console.log(3);
        },
    })
}

</script>

<template>
    <Head title="Add Product" />

    <main class="w-full flex items-center justify-center bg-gray-800 text-white">
        <div class="max-w-[1000px]">
            <h2 class="text-[30px]">Add product</h2>
            <form @submit.prevent="dataForm" class="flex flex-col gap-[24px] w-full items-center justify-center">

                <div class="flex flex-col gap-2 w-full mt-[2em]">
                    <Input type="text" v-model="data_form.name" :label="'Product Name*'" required
                           autocomplete="name"/>
                    <span v-if="data_form.errors.name" class="text-primary-yellow">
                        <strong>{{ data_form.errors.name }}</strong>
                    </span>
                </div>

                <div class="flex flex-col gap-2 w-full mt-[2em]">
                    <Input type="text" v-model="data_form.description" :label="'Description*'" required/>
                    <span v-if="data_form.errors.description" class="text-primary-red">
                        <strong>{{ data_form.errors.description }}</strong>
                    </span>
                </div>

                <div class="flex flex-col gap-2 w-full mt-[2em]">
                    <Input type="text" v-model="data_form.price" :label="'Price*'" required/>
                    <span v-if="data_form.errors.price" class="text-primary-red">
                        <strong>{{ data_form.errors.price }}</strong>
                    </span>
                </div>

                <div class="flex flex-col gap-2 w-full mt-[2em]">
                    <Input type="text" v-model="data_form.rank" :label="'Rank*'" required/>
                    <span v-if="data_form.errors.rank" class="text-primary-red">
                        <strong>{{ data_form.errors.rank }}</strong>
                    </span>
                </div>

                <div class="flex flex-col gap-2 w-full mt-[2em]">
                    <Input type="text" v-model="data_form.stock" :label="'Stock*'" required/>
                    <span v-if="data_form.errors.stock" class="text-primary-red">
                        <strong>{{ data_form.errors.stock }}</strong>
                    </span>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="recipe_photo" class="text-primary-light font-unitytext text-[14px] md:text-[16px] inline-block">
                        Upload Product Photo
                    </label>
                    <div class="py-2">
                        <div style="max-width: 60%; ">
                            <ProjectUploadFile @upload_file="upload_file($event)" :input-id="'photo'" />
                        </div>
                    </div>
                </div>

                <button type="submit" class="with-rectangle-wez-udzial-bg flex flex-col items-center justify-center font-roboto font-bold text-green-800 text-[1.5em] w-[185px] h-[65px] hover:text-white text-center uppercase">
                    Send
                </button>
            </form>
        </div>
    </main>
</template>
