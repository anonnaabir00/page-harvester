<template>
    <div class="grid grid-cols-2 gap-4">
        <div class="grid grid-cols-1 bg-white mt-12 p-12 align-baseline">
            <div class="grid grid-cols-1 gap-6">
                <h2 class="text-lg font-semibold">Add Location</h2>
            </div>
            <div class="grid grid-cols-1 w-full mt-6">
                <div class="grid grid-cols-1 mt-4">
                    <label for="">Location Name</label>
                    <vs-input v-model="location" placeholder="Location" />
                </div>
                <div class="grid grid-cols-1 mt-4">
                    <label for="">Phone Number</label>
                    <vs-input v-model="phone" placeholder="Phone" />
                </div>
                <div class="grid grid-cols-1 mt-4">
                    <label for="">Opening Hours</label>
                    <textarea class="mt-2" rows="4" cols="50" v-model="openinghours" placeholder="9:00 AM - 5 PM"></textarea>
                </div>
                <button @click="addLocationData()" class="mt-6 p-3 brand-color text-white text-base">Add Location</button>
            </div>
        </div>

        <div class="grid grid-cols-1 bg-white mt-12 p-12 align-baseline w-full">
            <div class="grid grid-cols-1 gap-6">
                <h2 class="text-lg font-semibold">Update / Delete Location</h2>
            </div>
            <div class="grid grid-cols-1 w-full mt-6">
                <div class="grid grid-cols-1 w-full">
                    <label for="state">State</label>
                    <vs-select filter placeholder="Select" v-model="value" class="mt-2 mb-2">
                    <vs-option v-for="(option, index) in options" :key="index" :label="option.location_name" :value="option.location_value">
                    {{ option.location_name }}
                    </vs-option>
                    </vs-select>
                </div>
                <div class="grid grid-cols-1 mt-4">
                    <label for="">Phone Number</label>
                    <vs-input placeholder="Phone" />
                </div>
                <div class="grid grid-cols-1 mt-4">
                    <label for="">Opening Hours</label>
                    <textarea class="mt-2" rows="4" cols="50" placeholder="9:00 AM - 5 PM"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <button @click="updatelocationData()" class="mt-6 p-3 brand-color text-white text-base">Update Location</button>
                    <button @click="updatelocationData()" class="mt-6 p-2 bg-red-500 text-white text-base">Delete Location</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
import axios from 'axios';
import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';
import Swal from 'sweetalert2';

import Locations from './states.json';

Vue.use(Vuesax, {
// options here
})

export default({
name: 'LocationData',
data() {
    return {
        options: ph_postmeta.location_data,
        value: '',
        location: null,
        phone: null,
        openinghours: null

    }
},
    mounted() {
    
    },        
methods: {
    updatelocationData(){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Update & Delete is currently disabled',
            })
        // const optionIndex = this.options.findIndex(option => option.value === selectedValue);
        // console.log(optionIndex);
        // console.log(ph_postmeta.location_data[optionIndex]);

        // if (ph_postmeta.location_data && ph_postmeta.location_data[optionIndex]) {
        //     const locationValue = JSON.parse(ph_postmeta.location_data[optionIndex].location_value);
        //     const phone = locationValue.phone;
        //     const openinghours = locationValue.opening_hours;
        //     this.phone = phone;
        //     this.openinghours = openinghours
        // }
        // else {
        //     this.phone = null;
        //     this.openinghours = null;
        // }
    },
    addLocationData(){
        if (this.location && this.phone != null) {
            const loading = this.$vs.loading({
            text: 'Adding Location Data...'
            });

            var url = '/wp-json/ph/v1/location/add-data';

            axios({
            method: 'post',
            url: url,
            data: {
                location_name: this.location,
                location_phone: this.phone,
            }
        }).then (response => {
            loading.close();
            Swal.fire({
            title: 'Good job!',
            icon: 'success',
            html: 'Location Data Added Sucessfully',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            })
        }).catch (error => {
            console.log(error);
        });
    }

    else {
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please fill all the informations',
            })
        }
        
    }
}
})


</script>