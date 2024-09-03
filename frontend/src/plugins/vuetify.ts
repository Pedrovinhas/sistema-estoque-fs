import 'vuetify/styles';
import '@mdi/font/css/materialdesignicons.css'
import { type ThemeDefinition, createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

const globalTheme: ThemeDefinition = {
  dark: false,
  colors: {
    background: '#F5F5F5',
    primary: '#086632 ',
    'primary-ligth': 'rgb(2, 6, 204)',
  },
};

export const vuetify = createVuetify({
  theme: {
    defaultTheme: 'globalTheme',
    themes: {
      globalTheme,
    },
  },
  components,
  directives,
});
