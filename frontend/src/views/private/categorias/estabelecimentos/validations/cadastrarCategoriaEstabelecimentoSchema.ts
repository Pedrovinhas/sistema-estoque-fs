import * as yup from 'yup';

const cadastrarCategoriaEstabelecimentoSchema = yup.object({
  name: yup.string().required('Campo obrigatório'),
});

export default cadastrarCategoriaEstabelecimentoSchema;
