import * as yup from 'yup';

export default () => {
  yup.setLocale({
    mixed: {
      default: 'Inválido',
      required: 'Campo obrigatório',
      notType: 'Tipo de dado inválido',
    },
    number: {
      min: 'Campo deve ser maior que ${min}',
      max: 'Campo deve ser menor que ${max}',
    },
    string: {
      email: 'E-mail inválido',
    },
  });
};
