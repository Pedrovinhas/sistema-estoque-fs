import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: () => import('@/layouts/public/PublicLayoutView.vue'),
      children: [
        {
          name: 'login',
          path: '',
          component: () => import('@/views/public/LoginView.vue'),
        },
      ]
    },
    {
      path: '/',
      name: 'home',
      component: () => import('@/layouts/private/PrivateLayoutView.vue'),
      meta: { requiresAuth: true  },
      children: [
        {
            path: '/home',
            name: 'home',
            component: () => import('@/views/private/HomeView.vue'),
        },
        {
          path: '/categorias',
          children: [
            {
              path: 'produtos',
              children: [
                {
                  path: '',
                  name: 'categoria-produtos',
                  component: () =>import('@/views/private/categorias/produtos/CategoriaProdutoView.vue')
                },
                {
                  path: 'cadastrar',
                  name: 'cadastrar-categoria-produto',
                  component: () =>import('@/views/private/categorias/produtos/CadastrarCategoriaProdutoView.vue')
                }
              ]
            },
            {
              path: 'estabelecimentos',
              children: [
                {
                  path: '',
                  name: 'categoria-estabelecimentos',
                  component: () =>import('@/views/private/categorias/estabelecimentos/CategoriaEstabelecimentoViewww.vue')
                },
                {
                  path: 'cadastrar',
                  name: 'cadastrar-categoria-estabelecimento',
                  component: () =>import('@/views/private/categorias/estabelecimentos/CadastrarCategoriaEstabelecimentoView.vue')
                }
              ]
            }
          ]
        },
        {
          path: '/estabelecimentos',
          name: 'estabelecimentos',
          children: [
            {
              path: '',
              name: 'estabelecimentos',
              component: () =>import('@/views/private/estabelecimentos/EstabelecimentoView.vue'),
            },
            {
              path: 'cadastrar',
              name: 'cadastrar-estabelecimento',
              component: () =>import('@/views/private/estabelecimentos/CadastrarEstabelecimentoView.vue')
            },
            {
              path: 'pedidos',
              children: [
                {
                  path: ':id/pedidos',
                  name: 'pedidos',
                  component: () => import('@/views/private/HomeView.vue'),

                  // component: () =>import('@/views/private/categorias/produtos/CategoriaProdutoView.vue')
                },
                {
                  path: 'cadastrar',
                  name: 'cadastrar-pedido',
                  component: () => import('@/views/private/HomeView.vue'),

                  // component: () =>import('@/views/private/categorias/produtos/CadastrarCategoriaProdutoView.vue')
                }
              ]
            },
          ]
        },
        {
          path: '/produtos',
          name: 'produtos',
          children: [
            {
              path: '',
              name: 'produtos',
              component: () => import('@/views/private/produtos/ProdutoView.vue'),
            },
            {
              path: 'cadastrar',
              name: 'cadastrar-produto',
              component: () => import('@/views/private/produtos/CadastrarProdutoView.vue'),
            },
          ]
        }
      ]
    }
  ]
})

router.beforeEach((to, _from, next) => {
  window.scrollTo(0, 0);

  const store = useAuthStore();

  if (to.meta.requiresAuth && !store.isAuthenticated) {
      next({name: 'login'});
  } else {
      next();
  }
});

export default router
