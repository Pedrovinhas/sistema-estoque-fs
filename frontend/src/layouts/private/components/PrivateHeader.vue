<script setup lang="ts">
import MyIcon from '@/components/MyIcon.vue';
import MyTypography from '@/components/MyTypography.vue';

withDefaults(
  defineProps<{
    username?: string;
    balance?: number;
  }>(),
  {}
);

const emits = defineEmits<{
  toggleDrawer: [];
}>();
</script>

<template>
  <v-app-bar class="bg-primary" :elevation="0">
    <v-app-bar-nav-icon
      class="toggle-drawer"
      @click="emits('toggleDrawer')"></v-app-bar-nav-icon>

    <div class="d-flex justify-end align-center w-100 pr-8">
      <MyIcon name="mdi-account" />
      <MyTypography variant="body-2" weight="black" class="ml-2">
        {{ username }} - R$ {{ balance }}
      </MyTypography>
    </div>
  </v-app-bar>
</template>
