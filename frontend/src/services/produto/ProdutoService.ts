import ApiService from "@/services/api/apiService";
import type { GetAllParams } from "./interfaces/GetAllParams";
import type { GetAllResponse } from "./interfaces/GetAllResponse";
import type { CreateProdutoRequest } from "./interfaces/CreateProdutoRequest";

export default class ProdutoService extends ApiService {
    constructor(token: string | null ) {
        super('api', token);
    }

    async create(
        produto: CreateProdutoRequest
    ): Promise<CreateProdutoRequest> {
        try {
            const { data } = await this.apiInstance.post(
                '/produtos',
                produto
            );

            return data;
        } catch (error) {
            throw this.handleError(error);
        }
    }

    async getAll(
      params?: GetAllParams
    ): Promise<GetAllResponse> {
      try {
        // eslint-disable-next-line prefer-const
        let filter: any = {};
        
        if(params?.name !== undefined) filter.name = params?.name; 
        
        const { data } = await this.apiInstance.get<GetAllResponse>(
        'produtos',
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