<script setup lang="ts">
defineProps<{
  label: string;
  errorMessage?: string;
  required?: boolean;
}>();
</script>

<template>
  <v-text-field
    :label="label"
    :error-messages="errorMessage"
    class="mb-1"
    density="comfortable"
    variant="outlined">
    <template #label>
      <span :class="required ? 'required-style' : ''">{{ label }}</span>
    </template>
  </v-text-field>
</template>

<style scoped>
.required-style::after {
  content: '*';
  padding-left: 0.2rem;
  color: red;
}
</style>
