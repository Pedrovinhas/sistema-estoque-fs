<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { RouterLink } from 'vue-router';
import { useForm } from 'vee-validate';
import MyTable from '@/components/MyTable.vue';
import HeaderCard from '@/components/HeaderCard.vue';
import MyButton from '@/components/MyButton.vue';
import useService from '@/composables/useService';
import ControlledTextInput from '@/components/ControlledTextInput.vue';
import MyIcon from '@/components/MyIcon.vue';

const { categoriaService } = useService();
const { handleSubmit, resetForm } = useForm();

const TABLE_HEADERS = [
  { title: 'Nome', key: 'name' },
];

interface Categoria {
  id: number;
  name: string;
}

const categorias = ref<Categoria[]>([]);

const handleGetAllCategorias = handleSubmit(async (payload: any) => {
  const categoriasResponse = await categoriaService.getAllCategoriasEstabelecimento({
    ...payload
  });

  categorias.value = categoriasResponse.map((categoria: any) => ({
    id: categoria.id,
    name: categoria.nome,
  }));
});

const clearSearch = () => {
  resetForm();
};

onMounted(async () => {
  await handleGetAllCategorias();
});
</script>

<template>
  <v-container>
    <v-row class="mb-7">
      <v-col cols="12" class="px-0">
        <HeaderCard class="mb-8" title="Consulta de Categoria de Estabelecimento"
          subtitle="Consulte as categorias dos estabelecimento cadastrados no sistema" @submit="handleGetAllCategorias">
          <template #inputs>
            <v-container>
              <v-row class="mb-0 mt-2">
                <v-col cols="12" lg="4" md="6">
                  <ControlledTextInput label="Nome" name="name" hide-details />
                </v-col>
              </v-row>
            </v-container>
          </template>

          <template #actions>
            <MyButton variant="text" @click="clearSearch">
              Limpar
            </MyButton>
            <MyButton type="submit" class="ml-2">
              <span>Filtrar</span>
              <MyIcon name="mdi-filter-variant" class="ml-1"/>
            </MyButton>
          </template>
        </HeaderCard>

        <MyTable title="Categoria de Estabelecimentos Cadastrados"
          subtitle="Listagem de categorias de estabelecimentos cadastrados no sistema" :headers="TABLE_HEADERS"
          :items="categorias">
          <template #header-actions>
            <RouterLink  :to="{ name: 'cadastrar-categoria-estabelecimento' }">
              <MyButton>Cadastrar Categoria de Estabelecimento</MyButton>
            </RouterLink>
          </template>
        </MyTable>
      </v-col>
    </v-row>
  </v-container>
</template>
