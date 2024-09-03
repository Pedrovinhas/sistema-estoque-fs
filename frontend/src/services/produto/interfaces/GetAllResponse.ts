import type { Paginated } from '@/common/types/Paginated';

export type GetAllResponse = Paginated<{
  id: number;
  name: string;
}>;
