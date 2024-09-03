export interface CreateProdutoRequest {
  name: string;
  value: number;
  categoria_produto_id: number;
  estabelecimento_id: number;
}