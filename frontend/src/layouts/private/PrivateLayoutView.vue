<script setup lang="ts">
import { ref } from 'vue';
import PrivateHeader from './components/PrivateHeader.vue';
import PrivateSidebar from './components/PrivateSidebar.vue';
import { useRoute, useRouter } from 'vue-router';
import { useAuthStore, useUserStore } from '@/stores';
import SidebarItens from './constants/SidebarItens';
import useService from '@/composables/useService';

const isDrawerOpen = ref<boolean>(true);

const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();
const userStore = useUserStore();

const { authService } = useService();

const logout = () => {
  authStore.logout();
  authService.logout();
  userStore.limparUsuario();
  router.replace({ name: 'login' });
};

</script>

<template>
  <v-app class="bg-background">
    <PrivateHeader
      @toggle-drawer="isDrawerOpen = !isDrawerOpen"
    />

    <PrivateSidebar
      v-model="isDrawerOpen"
      :current-path="route.path"
      :itens="SidebarItens"
      @logout="logout" />
    <v-main class="ma-12">
      <router-view />
    </v-main>
  </v-app>
</template>
