export interface GetPedidoResponse {
  produto: {
    id: number;
    nome: string;
  };
  estabelecimento: {
    id: number;
    nome: string;
  };
  user: {
    id: number;
    nome: string;
  };
}