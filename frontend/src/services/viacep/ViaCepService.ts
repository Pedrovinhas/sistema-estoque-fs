import axios, { type AxiosInstance } from "axios";
import type { ViaCepResponse } from "./interfaces/ViaCepResponse";

export default class ViaCepService {
  private readonly apiInstance: AxiosInstance;

  constructor() {
    this.apiInstance = axios.create({
      baseURL: 'https://viacep.com.br/ws/',
    });
  }

  async getCep(cep: string): Promise<ViaCepResponse> {
    try {
      const { data } = await this.apiInstance.get<ViaCepResponse>(`${cep}/json`);

      if (data.erro) {
        throw new Error('CEP não encontrado.');
      }
      
      return data;
    } catch (error: any) {
      throw new Error();
    }
  }
}