<script setup lang="ts">
import MyTypography from './MyTypography.vue';

interface Headers {
  key: string;
  title: string;
}

interface Items {
  id?: number;
  actions?: any;

  [key: string]: any;
}

withDefaults(
    defineProps<{
      headers: Headers[];
      items: Items[];
      title?: string;
      subtitle?: string;
      color?: string;
    }>(),
    {
      color: 'background',
    }
);
</script>

<template>
  <v-container v-if="subtitle || title">
    <v-row>
      <v-col>
        <MyTypography v-if="subtitle" muted variant="subtitle-1" class="mb-2">
          {{ subtitle }}
        </MyTypography>
        <MyTypography v-if="title" variant="h5" weight="black" class="mb-2">
          {{ title }}
        </MyTypography>
      </v-col>

      <v-col>
        <div class="d-flex justify-end align-center w-100">
          <slot name="header-actions"/>
        </div>
      </v-col>
    </v-row>
  </v-container>

  <v-data-table
      density="compact"
      :items="items"
      items-per-page="10"
      :headers="headers"
      :class="`bg-${color}`">
    <template #headers="{ columns }">
      <th v-for="header in columns" :key="header.title">
        <MyTypography
            variant="subtitle-1"
            weight="black"
            class="text-primary text-start pl-4 pb-2 header-divider">
          {{ header.title }}
        </MyTypography>
        <v-divider></v-divider>
      </th>
    </template>

    <template #item="{ item }">
      <tr>
        <td v-for="header in headers" :key="header.key">
          <div v-if="header.key === 'actions'" class="d-flex align-center">
            <slot name="row-actions" :item="item"/>
          </div>
          <MyTypography v-else variant="subtitle-1" class="text-start">
            {{ item[header.key] }}
          </MyTypography>
        </td>
      </tr>
    </template>

    <template #no-data>
      <MyTypography
          variant="subtitle-1"
          muted
          weight="bold"
          class="text-center pa-6">
        Nenhum conteúdo para visualizar
      </MyTypography>
    </template>

    <template #bottom>
      <slot name="rodape" v-if="items.length > 0"/>
    </template>
  </v-data-table>
</template>
