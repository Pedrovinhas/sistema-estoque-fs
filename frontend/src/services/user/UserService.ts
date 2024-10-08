import ApiService from '../api/apiService';
import type { GetUserResponse } from './interfaces/GetUserResponse';
import type { GetAuthenticatedResponse } from '../auth/interfaces/GetAuthenticatedResponse';

export default class UserService extends ApiService {
  constructor(token: string | null) {
    super('', token);
  }

  async buscarUsuario(): Promise<number> {
    try {
      const { data } = await this.apiInstance.get<number>(
        'auth/user/authenticated'
      );

      return data;
    } catch (error) {
      throw this.handleError(error);
    }
  }

  async obterUsuario(id: number): Promise<GetUserResponse> {
    try {
      const { data } = await this.apiInstance.get<GetUserResponse>(
        `api/users/${id}`
      );

      return data;
    } catch (error) {
      throw this.handleError(error);
    }
  }
}
