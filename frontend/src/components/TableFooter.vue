<script setup lang="ts">
import MyButton from './MyButton.vue';
import MyIcon from './MyIcon.vue';
import MySelect from './MySelect.vue';
import MyTypography from './MyTypography.vue';

defineProps<{
  paginacao: {
    page: number;
    quantidade: number;
    lastPage: number;
  };
}>();

defineEmits<{
  (e: 'proximo'): void;
  (e: 'anterior'): void;
  (e: 'atualizar-quantidade', quantidade: number): void;
}>();
</script>

<template>
  <footer class="w-100 d-flex justify-end align-center">
    <div class="d-flex justify-end align-center pa-4 ga-2" style="width: 35%">
      <MyButton
        :disabled="paginacao.page === 1"
        variant="text"
        @click="$emit('anterior')">
        <MyIcon name="mdi-arrow-left" />
      </MyButton>

      <MyTypography variant="subtitle-1">
        {{ paginacao.page }} / {{ paginacao.lastPage }}
      </MyTypography>
      <MyButton
        :disabled="paginacao.page === paginacao.lastPage"
        variant="text"
        @click="$emit('proximo')">
        <MyIcon name="mdi-arrow-right" />
      </MyButton>
      <MySelect
        density="compact"
        :model-value="paginacao.quantidade"
        @update:model-value="$emit('atualizar-quantidade', $event)"
        :items="[5, 10] as any"
        label="Itens por página"
        hide-details />
    </div>
  </footer>
</template>
