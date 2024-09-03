import type { CreateLoginRequest, GetAuthResponse }  from './interfaces/Login';
import ApiService from '@/services/api/apiService';

export class AuthService extends ApiService {
  constructor() {
    super('auth', null);
  }

  async login(request: CreateLoginRequest): Promise<GetAuthResponse> {
    try {
      const { data } = await this.apiInstance.post<GetAuthResponse>(
        '/login',
        request
      );

      return data;
    } catch (error) {
      throw this.handleError(error);
    }
  }

  async logout(): Promise<void> {
    try {
      await this.apiInstance.post('/logout');
    } catch (error) {
      throw this.handleError(error);
    }
  }
}
