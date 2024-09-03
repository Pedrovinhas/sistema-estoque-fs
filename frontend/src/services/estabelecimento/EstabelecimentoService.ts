import ApiService from "@/services/api/apiService";
import type { GetAllParams } from "./interfaces/GetAllParams";
import type { GetAllResponse } from "./interfaces/GetAllResponse";
import type { CreateEstabelecimentoRequest } from "./interfaces/CreateEstabelecimentoRequest";

export default class EstabelecimentoService extends ApiService {
    constructor(token: string | null ) {
        super('api', token);
    }

    async create(
        estabelecimento: CreateEstabelecimentoRequest
    ): Promise<CreateEstabelecimentoRequest> {
        try {
            const { data } = await this.apiInstance.post(
                '/estabelecimentos',
                estabelecimento
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
        'estabelecimentos',
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