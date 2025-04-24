<template>
<v-alert v-if="props.errors.length>0" type="error" dismissible>
    <p v-for="(error,i) in props.errors" :key="i">{{error}}</p>
</v-alert>
</template>

<script setup>
const props = defineProps({
    errors: {
        type: Array,
        required: true
    },
});
</script>
