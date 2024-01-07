<template>
    <div class="bg-green-700 text-white border border-green-700 p-4">

        <div class="grid grid-cols-4 gap-6 mt-4">
            <div class="grid grid-cols-1">
                <label for="">Location</label>
                <input v-model="this.location" class="mt-2" type="text" id="ph_location" />
            </div>

            <div class="grid grid-cols-1">
                <label for="">State</label>
                <input v-model="this.state" class="mt-2" type="text" id="ph_state" />
            </div>

            <div class="grid grid-cols-1">
                <label for="">Phone Number</label>
                <input class="mt-2" type="text" id="ph_phone" />
            </div>

            <div class="grid grid-cols-1">
                <label for="">Phone Number Group</label>
                <vs-select filter placeholder="Select" v-model="value" class="mt-2">
                    <vs-option v-for="(option, index) in options" :key="option.id" :label="option.location_name" :value="option.location_value">
                    {{ option.location_name }}
                    </vs-option>
                </vs-select>
                <input id="ph_location_data" type="hidden" v-model="value">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-6">
            <div class="grid grid-cols-1">
                <label for="">City Information</label>
                <textarea v-model="this.cityinfo" class="mt-2 text-black" rows="10" cols="50" id="ph_cityinfo"></textarea>
            </div>

            <div class="grid grid-cols-1">
                <label for="">Map Code</label>
                <textarea class="mt-2 text-black" rows="10" cols="50" id="ph_mapcode"></textarea>
            </div>
        </div>

</div>
</template>

<script>
import Vue from 'vue';
import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';

Vue.use(Vuesax, {
// options here
})

export default({
    name: 'MetaBox',
    data() {
        return {
            options: ph_postmeta.location_data,
            value: '',
            location: ph_postmeta.data.location,
            state: ph_postmeta.data.state,
            cityinfo: ph_postmeta.data.cityinfo,
        }
    },
    mounted() {
        
    },
    methods: {
        getVal(){
            
        }
    }
})

</script>