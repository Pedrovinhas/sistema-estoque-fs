import useService from '@/composables/useService';
import { reactive } from 'vue';

const { estabelecimentoService } = useService();

const estabelecimentosStore = reactive<State>({
  estabelecimentos: [],
  searchParams: {
    name: '',
  },

  async getAllEstabelecimentos() {
    const estabelecimentos = await estabelecimentoService.getAll({
      ...this.searchParams,
      name: this.searchParams.name
    });


    this.estabelecimentos = estabelecimentos.map((categoria: any) => ({
      id: categoria.id,
      nome: categoria.nome,
    }));
  },


  clearSearch() {
    this.estabelecimentos = [];
    this.searchParams = {
      name: '',
    };
  },
});

type State = {
  estabelecimentos: {
    id: number;
    nome: string;
  }[];
  searchParams: {
    name: string;
  };


  getAllEstabelecimentos(): Promise<void>;
  clearSearch(): void;
};

export default estabelecimentosStore;
