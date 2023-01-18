import Vue from 'vue';
import VueRouter from 'vue-router';


import App from './Vue/App.vue';

// Vue.use(VueRouter)

// const routes = [
//     { path: '/', component: Wizard },
//     { path: '/preloader', component: PreloaderSettings },
//     { path: '/whitelabel', component: WhiteLabel },
// ]

// const router = new VueRouter({routes})


new Vue({
    el: '#ph-admin',
    render: h => h(App),
    // components: { App }
});