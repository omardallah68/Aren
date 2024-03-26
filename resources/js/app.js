import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Pagination from 'v-pagination-3';
import VueAwesomePaginate from "vue-awesome-paginate";
import "vue-awesome-paginate/dist/style.css";
import timeago from 'vue-timeago3'
import 'animate.css';
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import 'element-plus/theme-chalk/dark/css-vars.css'



import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faUserSecret, faUser, faPeopleGroup, faGears, faHouse, faStickyNote, faShop, faUsers, faUsersGear, faKey, faCalendarDays, faComments, faPenToSquare, faCircleInfo, faHandPeace, faCartShopping, faTerminal, faListCheck, faEllipsisVertical, faBars} from '@fortawesome/free-solid-svg-icons'
library.add(faUserSecret, faUser, faPeopleGroup, faGears, faHouse, faStickyNote, faShop, faUsers, faUsersGear, faKey, faCalendarDays, faComments, faPenToSquare, faCircleInfo, faHandPeace, faCartShopping, faTerminal, faListCheck, faEllipsisVertical, faBars)


import AppLayout from './Layouts/AppLayout.vue'



createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => {
        resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || AppLayout
        return page
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(ZiggyVue)
            .use(plugin)
            .use(timeago)
            .use(ElementPlus)
            .component('pagination', Pagination)
            .component('font-awesome-icon', FontAwesomeIcon)
            .use(VueAwesomePaginate)
            .mount(el);
    },
    progress: {
        color: '#ffff00',
    },
});
