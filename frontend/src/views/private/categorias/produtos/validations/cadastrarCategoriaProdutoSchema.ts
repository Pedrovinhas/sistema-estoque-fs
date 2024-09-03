import * as yup from 'yup';

const cadastrarCategoriaProdutoSchema = yup.object({
  nome: yup.string().required('Campo obrigatório'),
});

export default cadastrarCategoriaProdutoSchema;
