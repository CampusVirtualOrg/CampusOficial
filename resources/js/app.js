// resources/assets/js/app.js

import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import VueTheMask from 'vue-the-mask';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
  title: (title) => `${title}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .use(VueTheMask)
      .mount(el);

    // Configuração do Laravel Echo após a criação do aplicativo Inertia
    Echo.private('chat-campusvirtual')
      .listen('MessageSent', (e) => {
        app.config.globalProperties.$data.messages.push({
          message: e.message.message,
          user: e.user
        });
      });

    return app;
  }
});
