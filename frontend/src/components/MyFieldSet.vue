<script setup lang="ts">
defineProps<{
  legend: string;
  noPadding?: boolean;
}>();
</script>

<template>
  <fieldset class="rounded-lg">
    <legend class="text-primary px-4 font-weight-bold ml-4">
      {{ legend }}
    </legend>
    <div :class="`${noPadding ? '' : 'px-8 pt-4'}`">
      <slot />
    </div>
  </fieldset>
</template>
