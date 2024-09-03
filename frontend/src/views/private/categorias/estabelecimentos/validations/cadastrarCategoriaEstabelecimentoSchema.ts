import * as yup from 'yup';

const cadastrarCategoriaEstabelecimentoSchema = yup.object({
  nome: yup.string().required('Campo obrigatório'),
});

export default cadastrarCategoriaEstabelecimentoSchema;
