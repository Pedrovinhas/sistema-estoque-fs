import useService from '@/composables/useService';
import { reactive } from 'vue';

const { pedidoService } = useService();

const pedidosStore = reactive<State>({
  pedidos: [],
  searchParams: {
    name: '',
  },

  async getEstabelecimentoPedidos(estabelecimentoId: number) {
    const pedidos = await pedidoService.getPedidosByEstabelecimento(estabelecimentoId);

    this.pedidos = pedidos.map((pedido: any) => ({
      id: pedido.id,
      produto_name: pedido.produto_name,
      produto_value: pedido.produto_value,
      receiver: pedido.receiver,
    }));
  },

  clearSearch() {
    this.pedidos = [];
    this.searchParams = {
      name: '',
    };
  },
});

type State = {
  pedidos: {
    id: number;
    produto_name: string;
    produto_value: number;
    receiver: string;
  }[];
  searchParams: {
    name: string;
  };

  getEstabelecimentoPedidos(estabelecimentoId: number): Promise<void>;
  clearSearch(): void;
};

export default pedidosStore;
