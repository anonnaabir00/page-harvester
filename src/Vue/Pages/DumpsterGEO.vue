<template>
    <div>

        <div class="mt-12 p-8 bg-white">
            <h2 class="text-black text-xl pt-2 pb-4">Dumpster GEO Page</h2>
            <div class="grid grid-cols-1 gap-4 w-2/6">
                <label for="city">City State</label>
                <input v-model="city" name="city" placeholder="Desoto TX" type="text" />

                <label for="zip">ZIP Code</label>
                <input v-model="zip" name="zip" placeholder="60001" type="text">

                <div class="w-full">
                <label for="state">State</label>
                <vs-select filter placeholder="Select" v-model="value" class="mt-2 mb-2">
                <vs-option v-for="(option, index) in options" :key="index" :label="option.label" :value="option.value">
                {{ option.text }}
                </vs-option>
                </vs-select>
                </div>

                <label for="placeholder">Phone Number Placeholder</label>
                <input v-model="placeholder" name="placeholder" placeholder="(469) 281-6668" type="text">

                <label for="phone">Phone Number</label>
                <input v-model="phone" name="phone" placeholder="4692816668" type="text">

                <label for="information">City Information</label>
                <textarea v-model="information" name="information" rows="6" cols="50"></textarea>

                <label for="schema">Schema Data</label>
                <textarea v-model="schema" name="schema" rows="6" cols="50"></textarea>

                <button @click="this.addDumpsterGeo" class="p-6 brand-color text-white text-base">Generate Dumpster GEO Page</button>
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

import optionsData from './states.json';

Vue.use(Vuesax, {
// options here
})

export default({
name: 'DumpsterGEO',
data() {
    return {
        city: null,
        zip: null,
        placeholder: null,
        phone: null,
        information: null,
        schema: null,
        value: '',
        options: optionsData,
    }
},
methods: {
    addDumpsterGeo(){
        if (this.city && this.zip && this.information && this.value != null) {
            const loading = this.$vs.loading({
            text: 'Creating Dumpster GEO Page...'
            });

            var url = '/wp-json/ph/v1/dumpster/geo';
            var content = '<!-- wp:shortcode -->[elementor-template id="7627"]<!-- /wp:shortcode -->';

            axios({
            method: 'post',
            url: url,
            data: {
                post_title: 'Dumpster Rental ' +  this.city + ' ' + this.zip,
                post_content: content,
                location: this.city + ' ' + this.zip,
                state: this.value,
                placeholder: this.placeholder,
                phone: this.phone,
                information: this.information,
                schema: this.schema,
            }
        }).then (response => {
            loading.close();
            Swal.fire({
            title: 'Good job!',
            icon: 'success',
            html: 'You have successfully created the Dumpster Geo Page, ' + '<a href="'+ response.data + '">links</a> ',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:
                '<a target="_blank" href="'+response.data+'">Vist Page</a>',
            confirmButtonAriaLabel: 'Thumbs up, great!',
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