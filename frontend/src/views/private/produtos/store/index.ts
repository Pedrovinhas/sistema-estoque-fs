import useService from '@/composables/useService';
import { reactive } from 'vue';

const { produtoService } = useService();

const produtosStore = reactive<State>({
  produtos: [],
  searchParams: {
    name: '',
  },

  async getAllProdutos() {
    const produtos = await produtoService.getAll({
      ...this.searchParams,
    });

    this.produtos = produtos.map((produto: any) => ({
      id: produto.id,
      name: produto.name,
      value: produto.value,
      categoria_produto_name: produto.categoria_produto_name,
      estabelecimento_name: produto.estabelecimento_name
    }));
  },

  clearSearch() {
    this.produtos = [];
    this.searchParams = {
      name: '',
    };
  },
});

type State = {
  produtos: {
    id: number;
    name: string;
    value: string;
    categoria_produto_name: string;
    estabelecimento_name: string;
  }[];
  searchParams: {
    name: string;
  };

  getAllProdutos(): Promise<void>;
  clearSearch(): void;
};

export default produtosStore;
