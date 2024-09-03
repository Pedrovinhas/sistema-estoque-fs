<script setup lang="ts">
import MyTable from '@/components/MyTable.vue';
import MyTextInput from '@/components/MyTextInput.vue';
import HeaderCard from '@/components/HeaderCard.vue';
import { onMounted } from 'vue';
import TableFooter from '@/components/TableFooter.vue';
import MyButton from '@/components/MyButton.vue';
import { RouterLink } from 'vue-router';
import produtosStore from './store';
import estabelecimentosStore from '../estabelecimentos/store';


const TABLE_HEADERS = [
  { title: 'Nome',  key: 'name' },
  { title: 'Valor', key: 'value' },
  { title: 'Categoria', key: 'categoria_produto_name' },
  { title: 'Estabelecimento', key: 'estabelecimento_name' },
  { title: 'Ações', key: 'actions' },
];

const handleGetAllProdutos = async () => {
  await produtosStore.getAllProdutos();
};

onMounted(async () => {
  produtosStore.clearSearch();
  await produtosStore.getAllProdutos();
});
</script>

<template>
  <v-container>
    <v-row class="mb-7">
      <v-col cols="12" class="px-0">
        <HeaderCard class="mb-8" title="Consulta de Produtos"
          subtitle="Consulte os produtos cadastrados no sistema"
          @submit="() => handleGetAllProdutos()">
          <template #inputs>
            <v-container>
              <v-row class="mb-0 mt-2">
                <v-col cols="12" lg="4" md="6">
                  <MyTextInput label="Nome"
                    v-model="produtosStore.searchParams.name" hide-details />
                </v-col>
              </v-row>
            </v-container>
          </template>

          <template #actions>
            <MyButton variant="text" @click="() => produtosStore.clearSearch()">
              Limpar
            </MyButton>

            <MyButton type="submit">CONSULTAR</MyButton>
          </template>
        </HeaderCard>

        <MyTable title="Produtos cadastrados"
          subtitle="Listagem de produtos cadastrados no sistema" :headers="TABLE_HEADERS"
          :items="produtosStore.produtos">
          <template #header-actions>
            <RouterLink  :to="{ name: 'cadastrar-produto' }">
              <MyButton>Cadastrar Produto</MyButton>
            </RouterLink>
          </template>

          <template #rodape>
            <TableFooter :paginacao="estabelecimentosStore.paginacao" @proximo="() => {
              estabelecimentosStore.paginacao.page += 1;
              handleGetAllProdutos();
            }
              " @anterior="() => {
                estabelecimentosStore.paginacao.page -= 1;
                handleGetAllProdutos();
              }
                " @atualizar-quantidade="(quantidade: any) => {
                  estabelecimentosStore.paginacao.quantidade = quantidade;
                  estabelecimentosStore.paginacao.page = 1;
                  handleGetAllProdutos();
                }
                  " />
          </template>
        </MyTable>
      </v-col>
    </v-row>
  </v-container>
</template>
