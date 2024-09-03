<script setup lang="ts">
import { useForm } from 'vee-validate';
import { toTypedSchema } from '@vee-validate/yup';
import { useRouter } from 'vue-router';
import toast from '@/plugins/vueToast';
import ControlledTextInput from '@/components/ControlledTextInput.vue';
import MyFieldSet from '@/components/MyFieldSet.vue';
import ActionButtons from '@/components/ActionButtons.vue';
import useService from '@/composables/useService';
import cadastrarEstabelecimentoSchema from './validations/cadastrarEstabelecimentoSchema';
import ControlledTextInputWithMask from '@/components/ControlledTextInputWithMask.vue';
import ControlledSelect from '@/components/ControlledSelect.vue';
import { onMounted, ref } from 'vue';
import type { DomainList } from '@/common/types/DomainList';
import MyButton from '@/components/MyButton.vue'; 

const { estabelecimentoService, categoriaService, cepService } = useService();
const router = useRouter();

const categorias = ref<DomainList>([]);

const { handleSubmit, isSubmitting, setFieldValue, values } = useForm({
  validationSchema: toTypedSchema(cadastrarEstabelecimentoSchema),
});

const onSubmit = async () => {
  await handleSubmit(async (payload) => {
    await estabelecimentoService.create(payload);

    router.push({ name: 'estabelecimentos' });

    toast.success('Estabelecimento cadastrado com sucesso');
  })();
};

onMounted(async () => {
  const categoriasResponse = await categoriaService.getAllCategoriasEstabelecimento();

  categorias.value = categoriasResponse.map((categoria: any) => ({
    id: categoria.id,
    name: categoria.nome,
  }));
});

const searchCep = async () => {
  try {
    const cepValue = values.cep;  

    if (!cepValue) {
      throw new Error('CEP não informado.');
    }

    const endereco = await cepService.getCep(cepValue);
    setFieldValue('bairro', endereco.bairro);
    setFieldValue('logradouro', endereco.logradouro);
    setFieldValue('uf', endereco.uf);
    setFieldValue('localidade', endereco.localidade);
    setFieldValue('complemento', endereco.complemento || '');
    toast.success('Endereço encontrado com sucesso.');
  } catch (error: any) {
    toast.error(`Erro ao buscar o CEP: ${error.message}`);
  }
}
</script>

<template>
  <v-container>
    <v-row class="mb-7">
      <v-col cols="12" class="px-0">
        <form @submit.prevent="onSubmit">
          <v-container>
            <MyFieldSet legend="Cadastro do Estabelecimento" class="mb-8">
              <v-col class="mb-8">
                <v-row class="mb-0 mt-2">
                  <v-col cols="12" lg="4" md="4">
                    <ControlledTextInput name="name" label="Nome do Estabelecimento" maxLength="100" />
                  </v-col>
                  <v-col cols="12" lg="4" md="4">
                    <ControlledTextInput name="description" label="Descrição" maxLength="200" />
                  </v-col>
                  <v-col cols="12" lg="4" md="4">
                    <ControlledSelect name="categoria_estabelecimento_id" label="Categoria" :items="categorias" />
                  </v-col>
                </v-row>
              </v-col>
            </MyFieldSet>

            <MyFieldSet legend="Endereço do Estabelecimento">
              <v-col>
                <v-row class="mb-0 mt-2">
                  <v-col cols="12" lg="6" md="6">
                    <v-row>
                      <v-col cols="9">
                        <ControlledTextInputWithMask name="cep" label="CEP" mask="cep"/>
                      </v-col>
                      <v-col cols="3" class="d-flex align-center justify-center">
                        <MyButton @click="searchCep" class="ml-2 mb-6">
                          Buscar CEP
                        </MyButton>
                      </v-col>
                    </v-row>
                  </v-col>
                  <v-col cols="12" lg="6" md="6">
                    <ControlledTextInput name="bairro" label="Bairro" maxLength="25" disabled />
                  </v-col>
                </v-row>
                <v-row class="mb-0 mt-2">
                  <v-col cols="12" lg="6" md="6">
                    <ControlledTextInput name="logradouro" label="Logradouro" maxLength="200" disabled />
                  </v-col>
                  <v-col cols="12" lg="6" md="6">
                    <ControlledTextInput name="complemento" label="Complemento" maxLength="200" disabled />
                  </v-col>
                  <v-col cols="12" lg="6" md="6">
                    <ControlledTextInput name="uf" label="UF" maxLength="200" disabled />
                  </v-col>
                  <v-col cols="12" lg="6" md="6">
                    <ControlledTextInput name="localidade" label="Localidade" maxLength="200" disabled />
                  </v-col>
                </v-row>
              </v-col>
            </MyFieldSet>
          </v-container>
          <ActionButtons @cancelar="() => router.push({ name: 'estabelecimentos' })" :is-submitting="isSubmitting" />
        </form>
      </v-col>
    </v-row>
  </v-container>
</template>
