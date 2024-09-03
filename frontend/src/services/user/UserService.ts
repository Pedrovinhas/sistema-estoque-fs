import ApiService from '../api/apiService';
import type { GetUserResponse } from './interfaces/GetUserResponse';
import type { GetAuthenticatedResponse } from '../auth/interfaces/GetAuthenticatedResponse';

export default class UserService extends ApiService {
  constructor(token: string | null) {
    super('', token);
  }

  async buscarUsuario(): Promise<GetAuthenticatedResponse> {
    try {
      const { data } = await this.apiInstance.get<GetAuthenticatedResponse>(
        'auth/user/autenticar'
      );

      return data;
    } catch (error) {
      throw this.handleError(error);
    }
  }

  async obterUsuario(id: number): Promise<GetUserResponse> {
    try {
      const { data } = await this.apiInstance.get<GetUserResponse>(
        `api/usuarios/${id}`
      );

      return data;
    } catch (error) {
      throw this.handleError(error);
    }
  }
}
