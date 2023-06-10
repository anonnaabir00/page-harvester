<template>
    <div>
            <div class="w-full sm:hidden md:flex justify-center">
                <input v-model="name" type="text" name="name" id="name" placeholder="Name" class="phlf-field m-2 p-1 px-2 py-2 text-sm placeholder:text-black placeholder:uppercase">
                <input v-model="email" type="email" name="email" id="email" placeholder="Email" class="phlf-field m-2 p-1 px-2 py-2 text-sm placeholder:text-black placeholder:uppercase">
                <input v-model="phone" type="text" name="phone" id="phone" placeholder="Phone" class="phlf-field m-2 p-1 px-2 py-2 text-sm placeholder:text-black placeholder:uppercase">
                <input v-model="zip" type="text" name="zip" id="zip" placeholder="ZIP" class="phlf-field w-30 m-2 p-1 px-2 py-2 text-sm placeholder:text-black placeholder:uppercase">
                <select v-model="projecttype" name="project-type" id="project-type" placeholder="PROJECT TYPE" class="phlf-field w-48 m-2 p-1 px-2 py-2 text-sm placeholder:text-black placeholder:uppercase">
                    <option disabled selected>Project Type</option>
                    <option value="Dumpster">Dumpster</option>
                    <option value="Porta Potty">Porta Potty</option>
                    <option value="Fencing">Fencing</option>
                    <option value="Multiple">Multiple</option>
                </select>

                <button @click="sendEmail()" class="phlf-button m-2 pt-3 pb-3 pl-6 pr-6 bg-green-500 text-white text-sm" type="submit">Get Estimate</button>
            </div>
    </div>
</template>


<script>
import Vue from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';


export default({
    name: 'Header',
    data() {
        return {
            name: null,
            email: null,
            phone: null,
            zip: null,
            projecttype: 'Project Type'
        }
    },
    mounted() {        
    },
    methods: {
        sendEmail() {
            if (this.name === null || this.email === null || this.phone === null || this.zip === null || this.projecttype === null) {
            Swal.fire({
                title: 'Error!',
                text: 'Please fill out all fields',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
            }
            axios({
              method: 'post',
              url: '/wp-json/ph/v1/email',
              data: {
                name: this.name,
                email: this.email,
                phone: this.phone,
                zip: this.zip,
                projecttype: this.projecttype
              }
          }).then( (response) => {
                // console.log(response);
                Swal.fire({
                    title: 'Success!',
                    text: 'Your request has been sent. We will contact you shortly',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
          }).catch(function (error) {
              console.log(error);
          });
        }
    }
})

</script>