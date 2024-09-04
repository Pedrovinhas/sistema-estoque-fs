<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useForm } from 'vee-validate';
import { RouterLink } from 'vue-router';
import { useUserStore } from '@/stores';
import useService from '@/composables/useService';
import MyTable from '@/components/MyTable.vue';
import HeaderCard from '@/components/HeaderCard.vue';
import MyButton from '@/components/MyButton.vue';
import ControlledTextInput from '@/components/ControlledTextInput.vue';
import ControlledSelect from '@/components/ControlledSelect.vue';

const userStore = useUserStore();
const { produtoService, pedidoService, userService, categoriaService, estabelecimentoService } = useService();
const { handleSubmit, resetForm } = useForm();
const userId = userStore.obterIdUsuario;

const TABLE_HEADERS = [
  { title: 'Nome', key: 'name' },
  { title: 'Valor', key: 'value' },
  { title: 'Categoria', key: 'categoria_produto_name' },
  { title: 'Estabelecimento', key: 'estabelecimento_name' },
  { title: 'Ações', key: 'actions' },
];

interface Estabelecimento {
  id: number;
  name: string;
  value: string;
  categoria_produto_name: string;
  estabelecimento_name: string;
  estabelecimento_id: number;
}

const produtos = ref<Estabelecimento[]>([]);
const categorias = ref<{ id: number; name: string }[]>([]);
const estabelecimentos = ref<{ id: number; name: string }[]>([]);

const handleGetAllProdutos = handleSubmit(async (payload: any) => {
  console.log(payload);
  const produtosResponse = await produtoService.getAll({
    ...payload
  });

  produtos.value = produtosResponse.map((produto: any) => ({
    id: produto.id,
    name: produto.name,
    value: produto.value,
    categoria_produto_name: produto.categoria_produto_name,
    estabelecimento_name: produto.estabelecimento_name,
    estabelecimento_id: produto.estabelecimento_id,
  }));
});

const getAllCategorias = async () => {
  const categoriasResponse = await categoriaService.getAllCategoriasProduto();
  categorias.value = categoriasResponse.map((categoria: any) => ({
    id: categoria.id,
    name: categoria.nome,
  }));
};

const getAllEstabelecimentos = async () => {
  const estabelecimentosResponse = await estabelecimentoService.getAll();

  estabelecimentos.value = estabelecimentosResponse.map((estabelecimento: any) => ({
    id: estabelecimento.id,
    name: estabelecimento.name,
  }));
};

const createPedido = async (produtoId: number, estabelecimentoId: number, userId: number) => {
  await pedidoService.create({
    produto_id: produtoId,
    estabelecimento_id: estabelecimentoId,
    user_id: userId,
  });

  const updatedUser = await userService.obterUsuario(userId);
  userStore.buscarUsuario(updatedUser);
};

const clearSearch = () => {
  resetForm();
};

onMounted(async () => {
  clearSearch();
  await handleGetAllProdutos();
  await getAllCategorias();
  await getAllEstabelecimentos();
});
</script>

<template>
  <v-container>
    <v-row class="mb-7">
      <v-col cols="12" class="px-0">
        <HeaderCard class="mb-8" title="Consulta de Produtos" subtitle="Consulte os produtos cadastrados no sistema"
          @submit="handleGetAllProdutos">
          <template #inputs>
            <v-container>
              <v-row class="mb-0 mt-2">
                <v-col cols="12" lg="4" md="6">
                  <ControlledTextInput label="Nome" name="name" />
                </v-col>
                <v-col cols="12" lg="4" md="4">
                  <ControlledSelect name="categoria_produto_id" label="Categoria" :items="categorias" />
                </v-col>
                <v-col cols="12" lg="4" md="4">
                  <ControlledSelect name="estabelecimento_id" label="Estabelecimento" :items="estabelecimentos" />
                </v-col>
              </v-row>
            </v-container>
          </template>

          <template #actions>
            <MyButton variant="text" @click="clearSearch">
              Limpar
            </MyButton>

            <MyButton type="submit">CONSULTAR</MyButton>
          </template>
        </HeaderCard>

        <MyTable title="Produtos cadastrados" subtitle="Listagem de produtos cadastrados no sistema"
          :headers="TABLE_HEADERS" :items="produtos">
          <template #header-actions>
            <RouterLink :to="{ name: 'cadastrar-produto' }">
              <MyButton>Cadastrar Produto</MyButton>
            </RouterLink>
          </template>
          <template #row-actions="{ item }">
            <MyButton @click="() => createPedido(item.id!, item.estabelecimento_id, userId!)">
              Comprar
            </MyButton>
          </template>
        </MyTable>
      </v-col>
    </v-row>
  </v-container>
</template>
