<template>
    <div class="bg-white p-16 m-16">
        <div class="brand-color p-8">
            <h1 class="text-2xl text-white">Prime Dumpster</h1>
            <p class="text-base text-white mt-4">Geo Page Harvester 3.0</p>

            <router-view></router-view>
        </div>

        
    </div>
</template>

<script>
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';
import Swal from 'sweetalert2';

Vue.use(VueRouter);

Vue.use(Vuesax, {
    // options here
  })

export default({
    name: 'App',
    data() {
        return {
            
        }
    },
    methods: {

    }
})


</script>