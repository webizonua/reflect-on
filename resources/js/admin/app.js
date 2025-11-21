import '../../css/admin.css';
import '../bootstrap.js';

import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {createApp, h} from 'vue';
import {ZiggyVue} from '../../../vendor/tightenco/ziggy';
import {createPinia} from "pinia";
import naive, {NNotificationProvider, NDialogProvider} from "naive-ui";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob('./pages/**/*.vue'),
        ),
    setup({el, App, props, plugin}) {
        return createApp({
            render: () =>
                h(NDialogProvider, null, {
                    default: () =>
                        h(NNotificationProvider, {placement: 'top-right'}, {
                            default: () => h(App, props)
                        })
                })
        })
            .use(naive)
            .use(createPinia())
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
