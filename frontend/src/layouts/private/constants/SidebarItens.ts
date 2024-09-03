import type { SidebarItem } from '../types/SidebarItem';

const SidebarItens: SidebarItem[] = [
  {
    title: 'Meus Pedidos',
    icon: 'mdi-truck-fast',
    route: { name: 'meus-pedidos' },
  },
  {
    title: 'Categorias',
    icon: 'mdi-shape-plus-outline',
    children: [
      {
        title: 'Produtos',
        icon: 'mdi-package-variant',
        route: { name: 'categoria-produtos' },
      },
      {
        title: 'Estabelecimentos',
        icon: 'mdi-store-outline',
        route: { name: 'categoria-estabelecimentos' },
      },
    ],
  },
  {
    title: 'Estabelecimentos',
    icon: 'mdi-store-outline',
    route: { name: 'estabelecimentos' },
  },
  {
    title: 'Produtos',
    icon: 'mdi-package-variant',
    route: { name: 'produtos' },
  },
];

export default SidebarItens;
