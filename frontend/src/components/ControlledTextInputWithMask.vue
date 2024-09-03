<script setup lang="ts">
import { useField } from 'vee-validate';
import MyTextInput from './MyTextInput.vue';
import { ref, watch, computed } from 'vue';
import { vMaska } from 'maska/vue';
import type { MaskaDetail, MaskInputOptions } from 'maska';

const props = defineProps<{
  name: string;
  label: string;
  mask?: keyof typeof maskTypes;
  placeholder?: string;
}>();

const maskTypes = {
  cep: '##.###-###',
  money: '9 99#,##',
};

const { value, errorMessage, meta, setValue } = useField<string>(
  () => props.name
);

const model = ref(value.value);

watch(value, (newValue) => {
  model.value = newValue;

});

const vMaskaOptions = computed<MaskInputOptions>(() => ({
  mask: props.mask && maskTypes[props.mask],
  reversed: props.mask === 'money',
  tokens: {
    '9': {
      pattern: /\d/,
      repeated: true,
    },
  },
  onMaska: (detail: MaskaDetail) => {
    const maxLength = props.mask === 'money' ? 11 : undefined;
    if (maxLength && detail.unmasked.length > maxLength) {
      setValue(detail.unmasked.slice(0, maxLength));
    } else if (props.mask === 'money') {
      setValue(detail.masked);
    } else {
      setValue(detail.unmasked);
    }
  },
}));

defineExpose({ value });
</script>

<template>
  <div>
    <MyTextInput
      :placeholder="props.placeholder"
      v-if="props.mask"
      v-maska="vMaskaOptions"
      :required="meta.required"
      :label="props.label"
      :error-message="errorMessage"
      v-model="model"
    />
  </div>
</template>
