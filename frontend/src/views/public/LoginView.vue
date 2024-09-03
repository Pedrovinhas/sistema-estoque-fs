<script setup lang="ts">
import { useForm } from 'vee-validate';
import MyButton from '@/components/MyButton.vue';
import MyTypography from '@/components/MyTypography.vue';
import useService from '@/composables/useService';
import ControlledTextInput from '@/components/ControlledTextInput.vue';
import { useAuthStore, useUserStore } from '@/stores';
import { ref } from 'vue';
import loginSchema from './validation/loginSchema';
import { useRouter } from 'vue-router';
import { toTypedSchema } from '@vee-validate/yup';
import UserService from '@/services/user/UserService';

const router = useRouter();
const isLoaded = ref(false);

const { authService } = useService();

const authStore = useAuthStore();
const userStore = useUserStore();

const { handleSubmit } = useForm({
  validationSchema: toTypedSchema(loginSchema),
});

const onSubmit = handleSubmit(async (payload) => {

  isLoaded.value = true;

  const token = await authService
    .login({
      email: payload.email,
      password: payload.password,
    })
    .finally(() => {
      isLoaded.value = false;
    });

  await authStore.login(token);

  const userService = new UserService(token.access_token);

  const user = await userService.buscarUsuario().finally(() => {
    isLoaded.value = false;
  });

  const userData = await userService.obterUsuario(user).finally(() => {
    isLoaded.value = false;
  })

  await userStore.buscarUsuario(userData);

  isLoaded.value = false;

  router.push({ name: 'home' });
});
</script>

<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="12" sm="8" md="7">
        <MyTypography
          class="text-center ma-6 text-primary"
          variant="h3"
          weight="bold">
          Entrar
        </MyTypography>
        <form @submit="onSubmit" class="d-flex flex-column">
          <ControlledTextInput
            name="email"
            label="Login"
            >
          </ControlledTextInput>
          <ControlledTextInput
            name="password"
            label="Senha"
            type="password"
            maxLength="12"
            class="pb-3">
          </ControlledTextInput>
          <v-row>
            <v-col class="py-0">
              <MyButton type="submit" class="w-100" :loading="isLoaded"
                >Entrar</MyButton
              >
            </v-col>
          </v-row>
        </form>
      </v-col>
    </v-row>
  </v-container>
</template>
