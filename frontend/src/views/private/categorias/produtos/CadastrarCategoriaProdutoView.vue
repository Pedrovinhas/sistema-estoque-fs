<script setup lang="ts">
import ControlledTextInput from '@/components/ControlledTextInput.vue';
import MyFieldSet from '@/components/MyFieldSet.vue';
import useService from '@/composables/useService';
import { useForm } from 'vee-validate';
import { toTypedSchema } from '@vee-validate/yup';
import toast from '@/plugins/vueToast';
import ActionButtons from '@/components/ActionButtons.vue';
import { useRouter } from 'vue-router';
import cadastrarCategoriaProdutoSchema from './validations/cadastrarCategoriaProdutoSchema';

const { categoriaService } = useService();
const router = useRouter();

const { handleSubmit, isSubmitting } = useForm({
  validationSchema: toTypedSchema(cadastrarCategoriaProdutoSchema),
});

const onSubmit = async () => {
  await handleSubmit(async (payload) => {
    await categoriaService.createCategoriaProduto(payload);

    router.push({ name: 'categoria-produtos' });

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
              <MyFieldSet legend="Cadastro de Categoria do Produto" class="mb-8">
                <v-col class="mb-8">
                  <v-row class="mb-0 mt-2">
                    <v-col cols="12" lg="4" md="6">
                      <ControlledTextInput name="name" label="Nome da Categoria" maxLength="200" />
                    </v-col>
                  </v-row>
                </v-col>
              </MyFieldSet>
            </v-container>
            <ActionButtons @cancelar="() => router.push({ name: 'categoria-produtos' })" :is-submitting="isSubmitting" />
          </form>
      </v-col>
    </v-row>
  </v-container>
</template>
