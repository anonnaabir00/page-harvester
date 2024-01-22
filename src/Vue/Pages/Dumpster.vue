<template>
        <div>

            <div class="mt-12 p-8 bg-white">
                <h2 class="text-black text-xl pt-2 pb-4">Dumpster Ads Page</h2>
                <div class="grid grid-cols-1 gap-4 w-2/6">
                    <label for="city">City State</label>
                    <input v-model="city" name="city" placeholder="Desoto TX" type="text" />

                    <div class="w-full">
                    <label for="state">Location (For Phone Number Group)</label>
                    <vs-select filter placeholder="Select" v-model="phonegroup" class="mt-2">
                        <vs-option v-for="(option, index) in locations" :key="option.id" :label="option.location_name" :value="option.phone">
                        {{ option.location_name }}
                        </vs-option>
                    </vs-select>
                    </div>

                    <label for="phone">Phone Number (Static)</label>
                    <input v-model="phone" name="phone" placeholder="(469) 281-6668" type="text">

                    <label for="phoneads">Adword Code (Phone Number)</label>
                    <textarea v-model="adwordsphone" name="adwordsphone" rows="4" cols="50"></textarea>

                    <button @click="this.addDumpsterPost" class="p-6 brand-color text-white text-base">Generate Dumpster Ads Page</button>
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

Vue.use(Vuesax, {
    // options here
  })

export default({
    name: 'Dumpster',
    data() {
        return {
            city: null,
            phone: null,
            adwordsphone: null,
            locations: ph_postmeta.location_data,
            phonegroup: ''
        }
    },
    methods: {
        addDumpsterPost(){
            if (this.city && this.adwordsphone != null) {
                const loading = this.$vs.loading({
                text: 'Creating Dumpster Ads Page...'
                });

                var url = '/wp-json/ph/v1/dumpster/ads';
                var content = '[elementor-template id="5364"]';

                axios({
                method: 'post',
                url: url,
                data: {
                    post_title: 'Dumpster Rental in ' +  this.city,
                    post_content: content,
                    location: this.city,
                    phone: this.phone,
                    adwordsphone: this.adwordsphone,
                    phonegroup: this.phonegroup,
                }
            }).then (response => {
                loading.close();
                Swal.fire({
                title: 'Good job!',
                icon: 'success',
                html: 'You have successfully created the Dumpster Ads Page, ' + '<a href="'+ response.data + '">links</a> ',
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