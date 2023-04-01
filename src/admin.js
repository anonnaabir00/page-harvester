import Vue from 'vue';
import VueRouter from 'vue-router';


import App from './Vue/App.vue';
import Dumpster from './Vue/Pages/Dumpster.vue';
import PortaPotty from './Vue/Pages/PortaPotty.vue';
import DumpsterGEO from './Vue/Pages/DumpsterGEO.vue';
import PortaPottyGEO from './Vue/Pages/PortaPottyGEO.vue';
import Export from './Vue/Pages/Export.vue';

Vue.use(VueRouter)

const routes = [
    { path: '/', component: Dumpster },
    { path: '/porta-potty', component: PortaPotty },
    { path: '/dumpster-geo', component: DumpsterGEO },
    { path: '/porta-potty-geo', component: PortaPottyGEO },
    { path: '/export', component: Export },
]

const router = new VueRouter({
    routes: routes
});


new Vue({
    el: '#ph-admin',
    render: h => h(App),
    router: router,
    // components: { App }
});