import * as yup from 'yup';

const cadastrarEstabelecimentoSchema = yup.object({
  name: yup.string().required('Campo obrigatório'),
  description: yup.string().required('Campo obrigatório'),
  cep: yup.string().max(8).required('Campo obrigatório'),
  categoria_estabelecimento_id: yup.number().required('Campo obrigatório'),
  bairro: yup.string().notRequired(),
  logradouro: yup.string().notRequired(),
  complemento: yup.string().notRequired(),
  localidade: yup.string().notRequired(),
  uf: yup.string().notRequired(),
});

export default cadastrarEstabelecimentoSchema;
