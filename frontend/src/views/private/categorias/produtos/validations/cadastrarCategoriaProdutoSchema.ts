import * as yup from 'yup';

const cadastrarCategoriaProdutoSchema = yup.object({
  name: yup.string().required('Campo obrigatório'),
});

export default cadastrarCategoriaProdutoSchema;
