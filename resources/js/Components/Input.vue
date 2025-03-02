<template>
    <div class="flex flex-col gap-[8px] w-full" style="border-bottom: 1px solid #F9F9F9">
        <label v-if="label" class="text-primary-light text-[18px] font-medium inline-block font-sans" :for="id">{{ label }}</label>
        <span v-if="tip_text" class="text-primary-yellow text-[14px] font-sans">{{ tip_text }}</span>
        <input :id="id" v-bind="$attrs" :class="[error, classInput]"
               class="px-[12px] py-[6px] bg-transparent text-[14px] md:text-[18px] font-sans"
               :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
    </div>
</template>

<script>
import uniqueId from 'lodash.uniqueid';

export default {
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            default() {
                return `input-${uniqueId()}`
            },
        },
        modelValue: String,
        label: String,
        error: String,
        tip_text: String,
        classInput: {
            type: String,
            default() {
                return 'placeholder:text-primary-gray border-none text-primary-light ';
            }
        }
    },
    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>
