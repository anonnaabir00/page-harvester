<template>
        <div>

            <div class="mt-12 p-8 bg-white">
                <h2 class="text-black text-xl pt-2 pb-4">Dumpster Ads Page</h2>
                <div class="grid grid-cols-1 gap-4 w-2/6">
                    <label for="city">City State</label>
                    <input v-model="city" name="city" type="text" />

                    <label for="placeholder">Phone Number Placeholder</label>
                    <input v-model="placeholder" name="placeholder" type="text">

                    <label for="phone">Phone Number</label>
                    <input v-model="phone" name="phone" type="text">

                    <label for="phoneads">Adword Code (Phone Number)</label>
                    <textarea v-model="phoneads" name="phoneads" rows="4" cols="50"></textarea>

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
            placeholder: null,
            phone: null,
            phoneads: null,
        }
    },
    methods: {
        addDumpsterPost(){
            if (this.city && this.placeholder && this.phone && this.phoneads != null) {
                const loading = this.$vs.loading({
                text: 'Creating Dumpster Ads Page...'
                });

                var url = '/wp-json/ph/v1/dumpster/ads';
                var content = '<!-- wp:shortcode -->[elementor-template id="5364"]<!-- /wp:shortcode -->';

                axios({
                method: 'post',
                url: url,
                data: {
                    post_title: 'Dumpster Rental in ' +  this.city,
                    post_content: content,
                    city: this.city,
                    placeholder: this.placeholder,
                    phone: this.phone,
                    phoneads: this.phoneads,
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