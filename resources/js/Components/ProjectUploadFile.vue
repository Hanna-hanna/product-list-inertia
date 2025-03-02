<template>
<div class="bg-white border border-gray-400 text-gray-700 text-xs font-bold px-4 py-2 rounded-lg dark:bg-gray-700 dark:text-white">
                    <input type="file" ref="fileUploader" class="w-full md:w-32"
                           @change="uploadFile"
                           :accept="accept"
                           :required="required"
                    />
                </div>
</template>


<script>

export default {
    name: 'project-upload-file',
    emits: ['upload_file'],
    props: {
        accept: {
            type: String,
            default: '.png,.jpg',
        },
        required: {
            type: Boolean,
            default: true
        },
        reset_file: {
            type: Boolean,
            default: false
        },
    },
    data() {
        return {
            upload_file: null,
        }
    },
    methods: {
        uploadFile(e) {
            let targetFiles = [...e.target.files];
            targetFiles.forEach((file) => {
                this.upload_file = file;
                this.$emit('upload_file', this.upload_file);
            });
        },
        dragFile(e) {
            let targetFiles = [...e.dataTransfer.files];
            targetFiles.forEach((file) => {
                this.upload_file = file;
            });
        },
        dragover(e) {
            if (!e.currentTarget.classList.contains('bg-blue-100')) {
                e.currentTarget.classList.remove('bg-gray-100');
                e.currentTarget.classList.add('bg-blue-100');
            }
        },
        dragleave(e) {
            e.currentTarget.classList.add('bg-gray-100');
            e.currentTarget.classList.remove('bg-blue-100');
        },
        drop(e) {
            e.currentTarget.classList.add('bg-gray-100');
            e.currentTarget.classList.remove('bg-blue-100');
        },
    },
    watch: {
        'reset_file'(newValue) {
            if(newValue)
            {
                this.$refs.fileUploader.value = '';
                this.upload_file = null;
            }
        },
    }
}
</script>
