<script setup lang="ts">
import MyTable from '@/components/MyTable.vue';
import MyTextInput from '@/components/MyTextInput.vue';
import HeaderCard from '@/components/HeaderCard.vue';
import { onMounted } from 'vue';
import MyButton from '@/components/MyButton.vue';
import { RouterLink, useRoute } from 'vue-router';
import pedidosStore from './store';

const route = useRoute();

const TABLE_HEADERS = [
  { title: 'Cliente', key: 'receiver' },
  { title: 'Produto', key: 'produto_name' },
  { title: 'Valor do Produto', key: 'produto_value' },
];

const handleGetAllProdutos = async () => {
  await pedidosStore.getEstabelecimentoPedidos(Number(route.params.id));
};

onMounted(async () => {
  pedidosStore.clearSearch();
  await pedidosStore.getEstabelecimentoPedidos(Number(route.params.id));
});
</script>

<template>
  <v-container>
    <v-row class="mb-7">
      <v-col cols="12" class="px-4 ml-8">
        <!-- <HeaderCard class="mb-8" title="Consulta de Produtos" subtitle="Consulte os pedidos no sistema"
          @submit="() => handleGetAllProdutos()">
          <template #inputs>
            <v-container>
              <v-row class="mb-0 mt-2">
                <v-col cols="12" lg="4" md="6">
                  <MyTextInput label="Nome" v-model="pedidosStore.searchParams.name" hide-details />
                </v-col>
              </v-row>
            </v-container>
          </template>

          <template #actions>
            <MyButton variant="text" @click="() => pedidosStore.clearSearch()">
              Limpar
            </MyButton>

            <MyButton type="submit">CONSULTAR</MyButton>
          </template>
        </HeaderCard> -->

        <MyTable title="Pedidos cadastrados" subtitle="Listagem de pedidos cadastrados no sistema"
          :headers="TABLE_HEADERS" :items="pedidosStore.pedidos">
          <template #header-actions>
            <RouterLink :to="{ name: 'estabelecimentos' }">
              <MyButton>Voltar</MyButton>
            </RouterLink>
          </template>
        </MyTable>
      </v-col>
    </v-row>
  </v-container>
</template>
