
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Toast, { POSITION } from 'vue-toastification';
import 'vue-toastification/dist/index.css';  // Ensure CSS is imported
import 'boxicons/css/boxicons.min.css';


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // Make sure toast is used before mounting the app
        app.use(Toast, {
            position: POSITION.TOP_RIGHT,
            timeout: 5000,
            closeOnClick: true,
            pauseOnHover: true,
        });

        app.use(plugin);
        app.use(ZiggyVue);

        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
