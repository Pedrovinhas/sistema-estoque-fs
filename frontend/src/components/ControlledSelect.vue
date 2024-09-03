<script setup lang="ts">
import { useField } from 'vee-validate';
import MySelect from './MySelect.vue';
import type { DomainList } from '@/common/types/DomainList';
import type { SelectFieldArray } from '@/common/types/SelectedFieldArray';

const props = defineProps<{
  label: string;
  name: string;
  required?: boolean;
  items: DomainList | SelectFieldArray | string[];
}>();

const { value, errorMessage, meta } = useField(() => props.name);
</script>

<template>
  <MySelect
    :label="label"
    :items="items"
    :required="meta.required || required"
    :error-message="errorMessage"
    class="mb-3"
    variant="outlined"
    v-model="value"></MySelect>
</template>
