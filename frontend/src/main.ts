import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { vuetify } from './plugins/vuetify';
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import '@/assets/css/global.css';

import App from './App.vue';
import router from './router';
import baseValidation from './common/validation/baseValidation';

baseValidation();

const app = createApp(App);

app.use(createPinia());
app.use(router);
app.use(vuetify);
app.use(ToastPlugin);

app.mount('#app');
