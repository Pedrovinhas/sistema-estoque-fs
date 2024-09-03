<script setup lang="ts">
import MyButton from './MyButton.vue';

withDefaults(
  defineProps<{
    label?: string;
    isSubmitting?: boolean;
  }>(),
  {
    label: 'SALVAR',
  }
);

defineEmits<{
  (event: 'cancelar'): void;
}>();
</script>

<template>
  <div class="d-flex justify-end pa-4">
    <slot>
      <MyButton @click="$emit('cancelar')" variant="text">CANCELAR </MyButton>
      <MyButton type="submit" :loading="isSubmitting">
        {{ label }}
      </MyButton>
    </slot>
  </div>
</template>
