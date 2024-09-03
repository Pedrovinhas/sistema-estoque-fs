<script setup lang="ts">
import MyTypography from './MyTypography.vue';
import type { DomainList } from '@/common/types/DomainList';
import type { SelectFieldArray } from '@/common/types/SelectedFieldArray';
import { computed } from 'vue';

const props = defineProps<{
  label: string;
  errorMessage?: string;
  required?: boolean;
  items: DomainList | SelectFieldArray | string[];
}>();

const isListagemDeDominios = (
  items: DomainList | SelectFieldArray | string[]
): items is DomainList => {
  return items && (items as DomainList)[0]?.id !== undefined;
};

const isStringArray = (
  items: DomainList | SelectFieldArray | string[]
): items is string[] => {
  return items && typeof items[0] === 'string';
};

const sobrecargaSelect = computed((): SelectFieldArray => {
  if (isListagemDeDominios(props.items)) {
    return props.items.map((item) => ({
      value: String(item.id),
      title: item.name,
    }));
  } else if (isStringArray(props.items)) {
    return props.items.map((item) => ({
      value: item,
      title: item,
    }));
  } else {
    return props.items;
  }
});
</script>

<template>
  <v-select
    :label="label"
    :items="sobrecargaSelect"
    :error-messages="errorMessage"
    density="comfortable"
    class="mb-1"
    variant="outlined">
    <template #label>
      <span :class="required ? 'required-style' : ''">{{ label }}</span>
    </template>
    <template #no-data>
      <MyTypography variant="subtitle-2" class="pl-4 cursor-default">
        Sem dados para exibir.
      </MyTypography>
    </template>
  </v-select>
</template>

<style scoped>
.required-style::after {
  content: '*';
  padding-left: 0.2rem;
  color: red;
}
</style>
