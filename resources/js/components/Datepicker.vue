<template>
<v-text-field
    v-model="props.modelValue"
    class="custom-input"
    density="comfortable"
    hide-details="auto"
    variant="outlined"
    color="primary"
    :label="props.label"
    @update:modelValue="$emit('update:modelValue', $event)"/>
<date-picker
    v-model="props.modelValue"
    custom-input=".custom-input"
    @update:modelValue="$emit('update:modelValue', $event)"/>
</template>
<script setup>
const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    label: {
        type: String
    }
});
defineEmits(['update:modelValue'])
</script>
