<script setup lang="ts">
import { useField } from 'vee-validate';
import MyTextInput from './MyTextInput.vue';

const props = defineProps<{
  name: string;
  label: string;
}>();

const { value, errorMessage, meta } = useField(() => props.name);
</script>

<template>
  <MyTextInput
    :required="meta.required"
    :label="label"
    :error-message="errorMessage"
    v-model="value"></MyTextInput>
</template>
