import ApiService from "@/services/api/apiService";
import type { CreatePedidoRequest } from "./interfaces/CreatePedidoRequest";
import type { GetPedidoResponse } from "./interfaces/GetPedidosResponse";

export default class PedidoService extends ApiService {
  constructor(token: string | null) {
    super('api', token);
  }

  async create(
    produto: CreatePedidoRequest
  ): Promise<CreatePedidoRequest> {
    try {
      const { data } = await this.apiInstance.post(
        '/pedidos',
        produto
      );

      return data;
    } catch (error) {
      throw this.handleError(error);
    }
  }

  async getPedidosByEstabelecimento(
    estabelecimentoId: number
  ): Promise<GetPedidoResponse[]> {
    try {
      const { data } = await this.apiInstance.get<GetPedidoResponse[]>(
        `/estabelecimentos/${estabelecimentoId}/pedidos`,
      );

      return data;
    } catch (error) {
      throw this.handleError(error);
    }
  }
}