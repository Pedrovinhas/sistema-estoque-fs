import * as yup from 'yup';

const cadastrarProdutoSchema = yup.object({
  name: yup.string().required('Campo obrigatório'),
  value: yup.string().required('Campo obrigatório'),
  categoria_produto_id: yup.number().required('Campo obrigatório'),
  estabelecimento_id: yup.number().required('Campo obrigatório')
});

export default cadastrarProdutoSchema;
