import ApiService from "@/services/api/apiService";
import type { GetAllParams } from "./interfaces/GetAllParams";
import type { GetAllCategoriasResponse } from "./interfaces/GetAllCategoriasResponse";
import type { CreateCategoriaRequest } from "./interfaces/CreateCategoriaRequest";

export default class CategoriaService extends ApiService {
    constructor(token: string | null ) {
        super('api', token);
    }

    async createCategoriaEstabelecimento(
        categoria: CreateCategoriaRequest
    ): Promise<CreateCategoriaRequest> {
        try {
            const { data } = await this.apiInstance.post(
                '/categorias-estabelecimento',
                categoria
            );

            return data;
        } catch (error) {
            throw this.handleError(error);
        }
    }

    async createCategoriaProduto(
      categoria: CreateCategoriaRequest
  ): Promise<CreateCategoriaRequest> {
      try {
          const { data } = await this.apiInstance.post(
              '/categorias-estabelecimento',
              categoria
          );

          return data;
      } catch (error) {
          throw this.handleError(error);
      }
  }

    async getAllCategoriasEstabelecimento(
      params?: GetAllParams
    ): Promise<GetAllCategoriasResponse> {
      try {
        // eslint-disable-next-line prefer-const
        let filter: any = {
          quantidade: params?.quantidade,
        };
        if(params?.name !== undefined) filter.name = params?.name; 
        
        const { data } = await this.apiInstance.get<GetAllCategoriasResponse>(
        'categorias-estabelecimento',
        {
          params: filter,
        }
      )

      return data;
        
      } catch (error) {
        throw this.handleError(error)
      }
    }

    async getAllCategoriasProduto(
      params?: GetAllParams
    ): Promise<GetAllCategoriasResponse> {
      try {
        // eslint-disable-next-line prefer-const
        let filter: any = {
          quantidade: params?.quantidade,
        };
        if(params?.name !== undefined) filter.name = params?.name; 
        
        const { data } = await this.apiInstance.get<GetAllCategoriasResponse>(
        'categorias-produto',
        {
          params: filter,
        }
      )

      return data;
        
      } catch (error) {
        throw this.handleError(error)
      }
    }
}