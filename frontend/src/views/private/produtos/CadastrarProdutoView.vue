<script setup lang="ts">
import { useForm } from 'vee-validate';
import { toTypedSchema } from '@vee-validate/yup';
import { useRouter } from 'vue-router';
import toast from '@/plugins/vueToast';
import ControlledTextInput from '@/components/ControlledTextInput.vue';
import MyFieldSet from '@/components/MyFieldSet.vue';
import ActionButtons from '@/components/ActionButtons.vue';
import useService from '@/composables/useService';
import ControlledTextInputWithMask from '@/components/ControlledTextInputWithMask.vue';
import ControlledSelect from '@/components/ControlledSelect.vue';
import { onMounted, ref } from 'vue';
import type { DomainList } from '@/common/types/DomainList';
import parseValue from '@/utils/parse-value';
import cadastrarProdutoSchema from './validations/cadastrarProdutoSchema';

const { produtoService, categoriaService, estabelecimentoService } = useService();
const router = useRouter();

const categorias = ref<{ name: string; id: number }[]>([]);

// const categorias = ref<DomainList>([]);
const estabelecimentos = ref<DomainList>([]);

const { handleSubmit, isSubmitting } = useForm({
  validationSchema: toTypedSchema(cadastrarProdutoSchema),
});

const onSubmit = async () => {
  await handleSubmit(async (payload) => {


    await produtoService.create({
      ...payload,
      value: parseValue(payload.value)
    });

    router.push({ name: 'produtos' });

    toast.success('Produto cadastrado com sucesso');
  })();
};

onMounted(async () => {
  const categoriasResponse = await categoriaService.getAllCategoriasProduto();

    categorias.value = categoriasResponse.map((categoria: any) => ({
      id: categoria.id,
      name: categoria.nome,
    }));

    const estabelecimentoResponse = await estabelecimentoService.getAll();

    estabelecimentos.value = estabelecimentoResponse.map((estabelecimento: any) => ({
      id: estabelecimento.id,
      name: estabelecimento.nome,
    }));
});
</script>

<template>
  <v-container>
    <v-row class="mb-7">
      <v-col cols="12" class="px-0">
        <form @submit.prevent="onSubmit">
          <v-container>
            <MyFieldSet legend="Cadastro do Produto" class="mb-8">
              <v-col class="mb-8">
                <v-row class="mb-0 mt-2">
                  <v-col cols="12" lg="4" md="4">
                    <ControlledTextInput name="name" label="Nome do Produto" maxLength="100" />
                  </v-col>
                  <v-col cols="12" lg="4" md="4">
                    <ControlledTextInputWithMask name="value" label="Valor do Produto" mask="money" />
                  </v-col>
                  <v-col cols="12" lg="4" md="4">
                    <ControlledSelect name="categoria_produto_id" label="Categoria" :items="categorias" />
                  </v-col>
                  <v-col cols="12" lg="4" md="4">
                    <ControlledSelect name="estabelecimento_id" label="Estabelecimento" :items="estabelecimentos" />
                  </v-col>
                </v-row>
              </v-col>
            </MyFieldSet>
          </v-container>
          <ActionButtons @cancelar="() => router.push({ name: 'produtos' })" :is-submitting="isSubmitting" />
        </form>
      </v-col>
    </v-row>
  </v-container>
</template>
