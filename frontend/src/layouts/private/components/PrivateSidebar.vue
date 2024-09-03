<script setup lang="ts">
import MyIcon from '@/components/MyIcon.vue';
import type { SidebarItem } from '../types/SidebarItem';

const isOpen = defineModel<boolean>();

const props = defineProps<{
  currentPath: string;
  itens: SidebarItem[];
}>();

const emits = defineEmits<{
  (event: 'logout'): void;
}>();
</script>

<template>
  <v-navigation-drawer v-model="isOpen" class="bg-primary" :width="isOpen ? '300' : '64'">
    <div class="d-flex flex-column h-100 px-2">
      <v-list
        density="comfortable"
        v-for="item in props.itens"
        :key="item.title"
        class="pa-1">
        <v-list-item
          v-if="!Boolean(item.children)"
          :key="item.title"
          :prepend-icon="item.icon"
          :title="item.title"
          :to="item.route"
          rounded="lg"
          class="list-item">
        </v-list-item>
        <v-list-group density="comfortable" v-else>
          <template v-slot:activator="{ props }">
            <v-list-item
              v-bind="props"
              :key="item.title"
              :prepend-icon="item.icon"
              :title="item.title"
              rounded="lg"
              class="list-item">
            </v-list-item>
          </template>

          <v-list-item
            style="padding-left: 3rem !important"
            density="comfortable"
            v-for="children in item.children"
            :key="children.title"
            :prepend-icon="children.icon"
            :title="children.title"
            :to="children.route"
            rounded="lg"
            class="list-item">
          </v-list-item>
        </v-list-group>
      </v-list>

      <v-list class="mt-auto">
        <v-list-item
          base-color="blue-gray-800"
          rounded="lg"
          @click="emits('logout')"
          class="list-item">
          <div class="d-flex">
            <MyIcon name="mdi-logout" class="mr-4" />
            <v-list-item-title class="text-body-2 font-weight-bold">Sair</v-list-item-title>
          </div>
        </v-list-item>
      </v-list>
    </div>
  </v-navigation-drawer>
</template>

<style scoped>
.v-navigation-drawer {
  min-width: 200px;
  max-width: 300px;
}

.list-item .v-list-item__title {
  white-space: normal;
  word-break: break-word;
}
</style>
