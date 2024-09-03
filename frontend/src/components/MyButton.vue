<script setup lang="ts">
withDefaults(
  defineProps<{
    variant?: 'outlined' | 'text' | 'flat';
  }>(),
  {
    variant: 'flat',
  }
);
</script>

<template>
  <v-btn
    :variant="variant"
    color="primary"
    density="comfortable"
    class="rounded-xl text-none font-weight-bold">
    <slot />
  </v-btn>
</template>
