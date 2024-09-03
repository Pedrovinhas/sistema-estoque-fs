type Produto = {
  id: number;
  name: string;
  value: number;
  categoria_produto_name: string;
  estabelecimento_name: string;
};

export type GetAllResponse = Produto[];