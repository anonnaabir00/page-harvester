<template>
    <div class="bg-white p-16 m-16">
        <div class="brand-color p-8">
            <h1 class="text-2xl text-white">Prime Dumpster</h1>
            <p class="text-base text-white mt-4">Geo Page Harvester 2.0</p>

            <div class="mt-12 p-8 bg-white">
                <div class="grid grid-cols-1 gap-4 w-2/6">
                    <label for="location_name">Location Name</label>
                    <input v-model="location" name="location_name" type="text" />

                    <label for="location_zip">Location Zip Code</label>
                    <input v-model="zip" name="location_zip" type="text">

                    <button @click="this.addDumpsterPost" class="p-6 brand-color text-white text-base">Generate GEO Page</button>
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

Vue.use(Vuesax, {
    // options here
  })

export default({
    name: 'App',
    data() {
        return {
            location: null,
            zip: null
        }
    },
    methods: {
        addDumpsterPost(){
            if (this.location && this.zip != null) {
                const loading = this.$vs.loading({
                text: 'Creating Geo Page...'
                });

                var url = '/wp-json/ph/v1/geo/dumpster';
                var content = '<!-- wp:shortcode -->[elementor-template id="7627"]<!-- /wp:shortcode -->';

                axios({
            method: 'post',
            url: url,
            data: {
                post_title: 'Dumpster Rentel ' +  this.location + ' ' + this.zip,
                post_content: content,
                location: this.location + ' ' + this.zip
            }
            }).then (response => {
                loading.close();
                Swal.fire({
                title: 'Good job!',
                icon: 'success',
                html: 'You have successfully created the Geo Page, ' + '<a href="'+ response.data + '">links</a> ',
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