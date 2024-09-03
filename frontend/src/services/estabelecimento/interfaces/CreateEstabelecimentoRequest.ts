export interface CreateEstabelecimentoRequest {
  name: string;
  description: string;
  cep: string;
  categoria_estabelecimento_id: number;
}