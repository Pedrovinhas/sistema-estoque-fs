import type { AxiosInstance } from 'axios';
import axiosApi from './axiosApi';
import toast from '@/plugins/vueToast';

const handleGenericError = (error: any) => {
  toast.error('Ocorreu um erro desconhecido.');
};

interface ErrorHandlers {
  [key: string]: (data: any) => void;
}

const errorHandlers: ErrorHandlers = {};

class ApiService {
  protected readonly apiInstance: AxiosInstance;
  protected readonly token: string | null;

  constructor(path: string, token: string | null) {
    this.token = token;

    this.apiInstance = token
      ? axiosApi(path, { Authorization: `Bearer ${token}` })
      : axiosApi(path);
  }

  protected handleError(error: any) {
    const { response } = error;

    if (response) {
      const errorHandler = errorHandlers[response.data.type];
      if (errorHandler) {
        return errorHandler(response.data);
      } else {
        handleGenericError(error);
      }
    } else if (error.request) {
      handleGenericError(error);
    } else {
      handleGenericError(error);
    }
  }

  protected success(mensagem: string) {
    toast.success(mensagem);
  }
}

export default ApiService;