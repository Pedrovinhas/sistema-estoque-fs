<script setup lang="ts">
import MyTypography from './MyTypography.vue';

defineProps<{
  title?: string;
  subtitle?: string;
}>();

defineEmits<{
  (e: 'submit'): void;
}>();
</script>

<template>
  <v-card class="pa-6 rounded-xl">
    <v-container>
      <v-row>
        <v-col>
          <MyTypography
            v-if="title"
            variant="h6"
            weight="black"
            class="mb-1 text-primary">
            {{ title }}
          </MyTypography>
          <MyTypography v-if="subtitle" muted variant="subtitle-1" class="mb-1">
            {{ subtitle }}
          </MyTypography>
        </v-col>
      </v-row>

      <form @submit.prevent="$emit('submit')">
        <slot name="inputs" />

        <v-row class="d-flex justify-end align-center w-100">
          <slot name="actions" />
        </v-row>
      </form>
    </v-container>

    <slot />
  </v-card>
</template>
