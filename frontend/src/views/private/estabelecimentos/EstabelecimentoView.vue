<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { RouterLink } from 'vue-router';
import { useForm } from 'vee-validate';
import useService from '@/composables/useService';
import MyTable from '@/components/MyTable.vue';
import HeaderCard from '@/components/HeaderCard.vue';
import MyButton from '@/components/MyButton.vue';
import ControlledSelect from '@/components/ControlledSelect.vue';
import ControlledTextInput from '@/components/ControlledTextInput.vue';

const { estabelecimentoService, categoriaService } = useService();
const { handleSubmit, resetForm } = useForm();

const TABLE_HEADERS = [
  { title: 'Nome', key: 'nome' },
  { title: 'Descrição', key: 'descricao' },
  { title: 'Categoria', key: 'categoria' },
  { title: 'CEP', key: 'cep' },
  { title: 'Ações', key: 'actions' },
];

interface Estabelecimento {
  id: number;
  nome: string;
  descricao: string;
  categoria: string;
  cep: string;
}

const estabelecimentos = ref<Estabelecimento[]>([]);
const categorias = ref<{ id: number; name: string }[]>([]);

const getAllCategorias = async () => {
  const categoriasResponse = await categoriaService.getAllCategoriasEstabelecimento();
  categorias.value = categoriasResponse.map((categoria: any) => ({
    id: categoria.id,
    name: categoria.nome,
  }));
};

const handleGetAllEstabelecimentos = handleSubmit(async (payload: any) => {
  const estabelecimentosResponse = await estabelecimentoService.getAll({
    ...payload,
  });

  estabelecimentos.value = estabelecimentosResponse.map((estabelecimento: any) => ({
    id: estabelecimento.id,
    nome: estabelecimento.name,
    descricao: estabelecimento.description,
    cep: estabelecimento.cep,
    categoria: estabelecimento.categoria_estabelecimento_name
  }));
});

const clearSearch = () => {
  resetForm();
};

onMounted(async () => {
  await handleGetAllEstabelecimentos();
  await getAllCategorias();
});
</script>

<template>
  <v-container>
    <v-row class="mb-7">
      <v-col cols="12" class="px-0">
        <HeaderCard class="mb-8" title="Consulta de Estabelecimentos"
          subtitle="Consulte os estabelecimentos cadastrados no sistema" @submit="handleGetAllEstabelecimentos">
          <template #inputs>
            <v-container>
              <v-row class="mb-0 mt-2">
                <v-col cols="12" lg="4" md="4">
                  <ControlledTextInput label="Nome" name="name" />
                </v-col>
                <v-col cols="12" lg="4" md="4">
                  <ControlledSelect name="categoria_estabelecimento_id" label="Categoria" :items="categorias" />
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

        <MyTable title="Estabelecimentos cadastrados" subtitle="Listagem de estabelecimentos cadastrados no sistema"
          :headers="TABLE_HEADERS" :items="estabelecimentos">
          <template #header-actions>
            <RouterLink :to="{ name: 'cadastrar-estabelecimento' }">
              <MyButton>Cadastrar Estabelecimento</MyButton>
            </RouterLink>
          </template>
          <template #row-actions="{ item }">
            <RouterLink :to="{ name: 'pedidos', params: { id: item.id } }" style="padding-right: 0px;">
              <MyButton>Pedidos</MyButton>
            </RouterLink>
          </template>
        </MyTable>
      </v-col>
    </v-row>
  </v-container>
</template>