<script setup lang="ts">
import MyIcon from '@/components/MyIcon.vue';
import MyTypography from '@/components/MyTypography.vue';
import { useUserStore } from '@/stores';
import { computed } from 'vue';

const userStore = useUserStore();

const username = computed(() => userStore.obterNomeUsuario);
const balance = computed(() => userStore.getUserBalance);

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
      <div>
        <div class="d-flex align-center">
        <MyIcon name="mdi-account" />
        <MyTypography variant="body-2" weight="black" class="ml-2">
          {{ username }}
        </MyTypography>
       </div>
       <div class="d-flex align-center">
        <MyIcon name="mdi-cash" />
        <MyTypography variant="body-1" weight="black" class="ml-2">
          R$ {{ balance }}
        </MyTypography>
       </div>
  
      </div>
    </div>
  </v-app-bar>
</template>
