<script setup lang="ts">
import MyTable from '@/components/MyTable.vue';
import MyTextInput from '@/components/MyTextInput.vue';
import HeaderCard from '@/components/HeaderCard.vue';
import { onMounted } from 'vue';
import categoriasStore from './store';
import TableFooter from '@/components/TableFooter.vue';
import MyButton from '@/components/MyButton.vue';
import { RouterLink } from 'vue-router';

const TABLE_HEADERS = [
  { title: 'Nome', key: 'nome' },
];

const handleGetAllCategoriaProdutos = async () => {
  await categoriasStore.getAllCategorias();
};

onMounted(async () => {
  categoriasStore.clearSearch();
  await categoriasStore.getAllCategorias();
});
</script>

<template>
  <v-container>
    <v-row class="mb-7">
      <v-col cols="12" class="px-0">
        <HeaderCard class="mb-8" title="Consulta de Categoria de Produtos"
          subtitle="Consulte as categorias dos produtos cadastrados no sistema"
          @submit="() => handleGetAllCategoriaProdutos()">
          <template #inputs>
            <v-container>
              <v-row class="mb-0 mt-2">
                <v-col cols="12" lg="4" md="6">
                  <MyTextInput label="Nome"
                    v-model="categoriasStore.searchParams.name" hide-details />
                </v-col>
              </v-row>
            </v-container>
          </template>

          <template #actions>
            <MyButton variant="text" @click="() => categoriasStore.clearSearch()">
              Limpar
            </MyButton>

            <MyButton type="submit">CONSULTAR</MyButton>
          </template>
        </HeaderCard>

        <MyTable title="Categoria de Produtos Cadastrados"
          subtitle="Listagem de categorias de produtos cadastrados no sistema" :headers="TABLE_HEADERS"
          :items="categoriasStore.categorias">
          <template #header-actions>
            <RouterLink  :to="{ name: 'cadastrar-categoria-produto' }">
              <MyButton>Cadastrar Categoria de Produto</MyButton>
            </RouterLink>
          </template>

          <template #rodape>
            <TableFooter :paginacao="categoriasStore.paginacao" @proximo="() => {
              categoriasStore.paginacao.page += 1;
              handleGetAllCategoriaProdutos();
            }
              " @anterior="() => {
                categoriasStore.paginacao.page -= 1;
                handleGetAllCategoriaProdutos();
              }
                " @atualizar-quantidade="(quantidade: any) => {
                  categoriasStore.paginacao.quantidade = quantidade;
                  categoriasStore.paginacao.page = 1;
                  handleGetAllCategoriaProdutos();
                }
                  " />
          </template>
        </MyTable>
      </v-col>
    </v-row>
  </v-container>
</template>
