import useService from '@/composables/useService';
import { reactive } from 'vue';

const { categoriaService } = useService();

const categoriasStore = reactive<State>({
  categorias: [],
  searchParams: {
    name: '',
  },

  async getAllCategorias() {
    const categorias = await categoriaService.getAllCategoriasProduto({
      ...this.searchParams,
    });


    this.categorias = categorias.map((categoria: any) => ({
      id: categoria.id,
      nome: categoria.nome,
    }));
  },

  clearSearch() {
    this.categorias = [];
    this.searchParams = {
      name: '',
    };
  },
});

type State = {
  categorias: {
    id: number;
    nome: string;
  }[];
  searchParams: {
    name: string;
  };

  getAllCategorias(): Promise<void>;
  clearSearch(): void;
};

export default categoriasStore;
