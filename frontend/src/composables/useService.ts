import { useAuthStore } from '@/stores';
import { AuthService } from '@/services/auth/AuthService';
import ViaCepService from '@/services/viacep/ViaCepService';
import CategoriaService from '@/services/categoria/CategoriaService';
import EstabelecimentoService from '@/services/estabelecimento/EstabelecimentoService';
import ProdutoService from '@/services/produto/ProdutoService';
import UserService from '@/services/user/UserService';

export default function useService() {
  const authStore = useAuthStore();

  const storeToken = authStore.getToken ? authStore.getToken : '';

  return {
    authService: new AuthService(),
    cepService: new ViaCepService(),
    userService: new UserService(storeToken),
    categoriaService: new CategoriaService(storeToken),
    estabelecimentoService: new EstabelecimentoService(storeToken),
    produtoService: new ProdutoService(storeToken)
  };
}
