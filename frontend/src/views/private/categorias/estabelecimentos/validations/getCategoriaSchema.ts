import * as yup from 'yup';

const getCategoriaSchema = yup.object().shape({
    name: yup.string().optional(),
});

export default getCategoriaSchema;