import * as yup from 'yup';

const loginSchema = yup.object().shape({
  email: yup.string().email().required('Campo obrigatório'),
  password: yup
    .string()
    .required('Campo obrigatório')
    .min(5, 'Senha deve ter no mínimo 6 caracteres'),
});

export default loginSchema;
