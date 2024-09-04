<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useForm } from 'vee-validate';
import { useUserStore } from '@/stores';
import useService from '@/composables/useService';
import MyTable from '@/components/MyTable.vue';
import HeaderCard from '@/components/HeaderCard.vue';
import MyButton from '@/components/MyButton.vue';
import ControlledTextInput from '@/components/ControlledTextInput.vue';

const userStore = useUserStore();
const { pedidoService } = useService();
const { handleSubmit, resetForm } = useForm();
const userId = userStore.obterIdUsuario;

const TABLE_HEADERS = [
  { title: 'Nome', key: 'name' },
  { title: 'Valor', key: 'value' },
  { title: 'Estabelecimento', key: 'estabelecimento' },
];

interface Pedido {
  produto_name: string;
  produto_value: string;
  estabelecimento_name: string;
}

const pedidos = ref<Pedido[]>([]);

const handleGetAllPedidos = handleSubmit(async (payload: any) => {1
  const pedidosResponse = await pedidoService.getPedidosByUser(userId!, {
    ...payload
  });

  pedidos.value = pedidosResponse.map((pedido: any) => ({
    name: pedido.produto_name,
    value: pedido.produto_value,
    estabelecimento: pedido.estabelecimento_name,
  }));
});

const clearSearch = () => {
  resetForm();
};

onMounted(async () => {
  clearSearch();
  await handleGetAllPedidos();
});
</script>

<template>
  <v-container>
    <v-row class="mb-7">
      <v-col cols="12" class="px-0">
        <HeaderCard class="mb-8" title="Consulta de Produtos" subtitle="Consulte os pedidos realizados por você no sistema"
          @submit="handleGetAllPedidos">
          <template #inputs>
            <v-container>
              <v-row class="mb-0 mt-2">
                <v-col cols="12" lg="4" md="6">
                  <ControlledTextInput label="Nome" name="name" />
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

        <MyTable title="Meus Pedidos" subtitle="Listagem de pedidos realizados"
          :headers="TABLE_HEADERS" :items="pedidos">
        </MyTable>
      </v-col>
    </v-row>
  </v-container>
</template>
