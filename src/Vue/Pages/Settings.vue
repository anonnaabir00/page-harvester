<template>
    <div>
        <div class="grid grid-cols-2 bg-white mt-12 p-12 align-baseline">
            <div class="grid grid-cols-1 w-2/6 gap-6">
                <h2 class="text-lg font-semibold">Settings</h2>
                    <div>
                    <LvToggleSwitch v-model="enableyoast" dense label="Enable Yoast SEO Support" />
                    </div>
                <LvButton @click="saveSettings" label="Save Settings" type="button" size="sm" />
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
import axios from 'axios';
import LvButton from 'lightvue/button';
import LvToggleSwitch from 'lightvue/toggle-switch';

import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';
import Swal from 'sweetalert2';

Vue.use(Vuesax, {
// options here
})

Vue.component('LvButton', LvButton);
Vue.component('LvToggleSwitch', LvToggleSwitch);

export default({
    name: 'Settings',
    data() {
        return {
            enableyoast: Number(ph_settings.enable_yoast_support) === 1 ? true : false
        }
    },
    methods: {
        saveSettings(){
            const loading = this.$vs.loading({
            text: 'Saving Settings...'
            });

            var url = '/wp-json/ph/v1/save-settings';

            axios({
            method: 'post',
            url: url,
            data: {
                enableyoast: this.enableyoast
            }
        }).then (response => {
            loading.close();
            Swal.fire({
            title: 'Good job!',
            icon: 'success',
            html: 'Settings Saved Sucessfully',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: 'OK',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            })
        }).catch (error => {
            console.log(error);
        });
        }
    },
    mounted(){
        console.log(ph_settings.enable_yoast_support);
    }
})

</script>