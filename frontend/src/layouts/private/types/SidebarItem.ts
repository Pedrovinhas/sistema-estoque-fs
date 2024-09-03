export type SidebarItem = {
  title: string;
  icon: string;
  route?: {
    name: string;
  };
  children?: Omit<SidebarItem, 'children'>[];
};
