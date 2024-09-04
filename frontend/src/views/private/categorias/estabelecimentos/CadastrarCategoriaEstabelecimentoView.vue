<script setup lang="ts">
import { useForm } from 'vee-validate';
import { toTypedSchema } from '@vee-validate/yup';
import { useRouter } from 'vue-router';
import toast from '@/plugins/vueToast';
import ControlledTextInput from '@/components/ControlledTextInput.vue';
import MyFieldSet from '@/components/MyFieldSet.vue';
import ActionButtons from '@/components/ActionButtons.vue';
import useService from '@/composables/useService';
import cadastrarCategoriaEstabelecimentoSchema from './validations/cadastrarCategoriaEstabelecimentoSchema';

const { categoriaService } = useService();
const router = useRouter();

const { handleSubmit, isSubmitting } = useForm({
  validationSchema: toTypedSchema(cadastrarCategoriaEstabelecimentoSchema),
});

const onSubmit = async () => {
  await handleSubmit(async (payload) => {
    console.log(payload);
    await categoriaService.createCategoriaEstabelecimento(payload);

    router.push({ name: 'categoria-estabelecimentos' });

    toast.success('Categoria cadastrada com sucesso');
  })();
};

</script>

<template>
  <v-container>
    <v-row class="mb-7">
      <v-col cols="12" class="px-0">
          <form @submit.prevent="onSubmit">
            <v-container>
              <MyFieldSet legend="Cadastro de Categoria do Estabelecimento" class="mb-8">
                <v-col class="mb-8">
                  <v-row class="mb-0 mt-2">
                    <v-col cols="12" lg="4" md="6">
                      <ControlledTextInput name="nome" label="Nome da Categoria" maxLength="200" />
                    </v-col>
                  </v-row>
                </v-col>
              </MyFieldSet>
            </v-container>
            <ActionButtons @cancelar="() => router.push({ name: 'categoria-estabelecimentos' })" :is-submitting="isSubmitting" />
          </form>
      </v-col>
    </v-row>
  </v-container>
</template>
