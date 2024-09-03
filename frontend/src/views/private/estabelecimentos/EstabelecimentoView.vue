<script setup lang="ts">
import MyTable from '@/components/MyTable.vue';
import MyTextInput from '@/components/MyTextInput.vue';
import HeaderCard from '@/components/HeaderCard.vue';
import { onMounted } from 'vue';
import estabelecimentosStore from './store';
import TableFooter from '@/components/TableFooter.vue';
import MyButton from '@/components/MyButton.vue';
import { RouterLink } from 'vue-router';

const TABLE_HEADERS = [
  { title: 'Nome', key: 'nome' },
];

const handleGetAllEstabelecimentos = async () => {
  await estabelecimentosStore.getAllEstabelecimentos();
};

onMounted(async () => {
  estabelecimentosStore.clearSearch();
  await estabelecimentosStore.getAllEstabelecimentos();
});
</script>

<template>
  <v-container>
    <v-row class="mb-7">
      <v-col cols="12" class="px-0">
        <HeaderCard class="mb-8" title="Consulta de Estabelecimentos"
          subtitle="Consulte os estabelecimentos cadastrados no sistema"
          @submit="() => handleGetAllEstabelecimentos()">
          <template #inputs>
            <v-container>
              <v-row class="mb-0 mt-2">
                <v-col cols="12" lg="4" md="6">
                  <MyTextInput label="Nome"
                    v-model="estabelecimentosStore.searchParams.name" hide-details />
                </v-col>
              </v-row>
            </v-container>
          </template>

          <template #actions>
            <MyButton variant="text" @click="() => estabelecimentosStore.clearSearch()">
              Limpar
            </MyButton>

            <MyButton type="submit">CONSULTAR</MyButton>
          </template>
        </HeaderCard>

        <MyTable title="Estabelecimentos cadastrados"
          subtitle="Listagem de estabelecimentos cadastrados no sistema" :headers="TABLE_HEADERS"
          :items="estabelecimentosStore.estabelecimentos">
          <template #header-actions>
            <RouterLink  :to="{ name: 'cadastrar-estabelecimento' }">
              <MyButton>Cadastrar Estabelecimento</MyButton>
            </RouterLink>
          </template>

          <template #rodape>
            <TableFooter :paginacao="estabelecimentosStore.paginacao" @proximo="() => {
              estabelecimentosStore.paginacao.page += 1;
              handleGetAllEstabelecimentos();
            }
              " @anterior="() => {
                estabelecimentosStore.paginacao.page -= 1;
                handleGetAllEstabelecimentos();
              }
                " @atualizar-quantidade="(quantidade: any) => {
                  estabelecimentosStore.paginacao.quantidade = quantidade;
                  estabelecimentosStore.paginacao.page = 1;
                  handleGetAllEstabelecimentos();
                }
                  " />
          </template>
        </MyTable>
      </v-col>
    </v-row>
  </v-container>
</template>
