<template>
    <div class="bg-green-700 text-white border border-green-700 p-4">

        <div class="grid grid-cols-4 gap-6 mt-4">
            <div class="grid grid-cols-1">
                <label for="">Location</label>
                <input v-model="location" class="mt-2" type="text" id="ph_location" />
            </div>

            <div class="grid grid-cols-1">
                <label for="">State</label>
                <input v-model="state" class="mt-2" type="text" id="ph_state" />
            </div>

            <div class="grid grid-cols-1">
                <label for="">Phone Number</label>
                <input v-model="phone" class="mt-2" type="text" id="ph_phone" />
            </div>

            <div class="grid grid-cols-1">
                <label for="">Phone Number Group</label>
                <vs-select filter placeholder="Select" v-model="value" class="mt-2">
                    <vs-option v-for="(option, index) in options" :key="option.id" :label="option.location_name" :value="option.phone">
                    {{ option.location_name }}
                    </vs-option>
                </vs-select>
                <input id="ph_location_data" type="hidden" v-model="value">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-6">
            <div class="grid grid-cols-1">
                <label for="">City Information</label>
                <textarea v-model="cityinfo" class="mt-2 text-black" rows="10" cols="50" id="ph_cityinfo"></textarea>
            </div>

            <div class="grid grid-cols-1">
                <label for="">Adwords Code (Main Area)</label>
                <textarea v-model="adwords" class="mt-2 text-black" rows="10" cols="50" id="ph_adwords_code"></textarea>
            </div>

            <div class="grid grid-cols-1">
                <label for="">Adwords Code (Phone Number)</label>
                <textarea v-model="adwordsphone" class="mt-2 text-black" rows="10" cols="50" id="ph_adwords_phone_code"></textarea>
            </div>

            <div class="grid grid-cols-1">
                <label for="">Schema Code</label>
                <textarea v-model="schema" class="mt-2 text-black" rows="10" cols="50" id="ph_schema_code"></textarea>
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
            options: ph_postmeta.location_data ?? '',
            value: ph_postmeta.data.location_data ?? '',
            location: ph_postmeta.data.location ?? '',
            state: ph_postmeta.data.state ?? '',
            phone: ph_postmeta.data.phone ?? '',
            cityinfo: ph_postmeta.data.city_information ?? '',
            adwords: ph_postmeta.data.adwords_code ?? '',
            adwordsphone: ph_postmeta.data.adwords_phone_code ?? '',
            schema: ph_postmeta.data.schema_code ?? '',
            locationdata: [],
        }
    },
    mounted() {
        
    },
    methods: {
        getVal(event){
            const selectedIndex = event.target.selectedIndex;
            const selectedOption = this.options[selectedIndex];
            const selectedKey = selectedOption.id;
            const selectedLocationName = selectedOption.location_name;
            const selectedLocationValue= selectedOption.location_value;

            this.locationdata.push({
            id: selectedKey,
            locationName: selectedLocationName,
            locationValue: selectedLocationValue,
            });
        }
    }
})

</script>