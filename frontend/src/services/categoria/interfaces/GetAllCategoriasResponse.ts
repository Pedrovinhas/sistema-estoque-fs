import type { Paginated } from '@/common/types/Paginated';

export type GetAllCategoriasResponse = Paginated<{
  id: number;
  name: string;
}>;
