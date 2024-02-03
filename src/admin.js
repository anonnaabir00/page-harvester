import Vue from 'vue';
import VueRouter from 'vue-router';


import App from './Vue/App.vue';
import Dumpster from './Vue/Pages/Dumpster.vue';
import PortaPotty from './Vue/Pages/PortaPotty.vue';
import DumpsterGEO from './Vue/Pages/DumpsterGEO.vue';
import PortaPottyGEO from './Vue/Pages/PortaPottyGEO.vue';
import LocationData from './Vue/Pages/LocationData.vue';
import Settings from './Vue/Pages/Settings.vue';
import Export from './Vue/Pages/Export.vue';

import Metabox from './Vue/Metabox.vue';
import Update from './Vue/Update.vue';

Vue.use(VueRouter)

const routes = [
    { path: '/', component: Dumpster },
    { path: '/porta-potty', component: PortaPotty },
    { path: '/dumpster-geo', component: DumpsterGEO },
    { path: '/porta-potty-geo', component: PortaPottyGEO },
    { path: '/location-data', component: LocationData },
    { path: '/settings', component: Settings },
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

new Vue({
    el: '#ph-additional-info',
    render: h => h(Metabox),
    // components: { App }
});

new Vue({
    el: '#submitdiv',
    render: h => h(Update),
    // components: { App }
});