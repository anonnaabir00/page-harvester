<template>
    <div class="mb-4">
            <div class="flex justify-start w-full">
                <button @click="updatePost" class="bg-green-700 text-white mb-4 pl-6 pr-6 p-3 w-full">Update Post</button>
            </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2';
import axios from 'axios';

export default({
    name: 'UpdatePanel',
    data() {
        return {
            
        }
    },
    mounted() {        
    },
    methods: {
        updatePost(){
            const postID = document.getElementById('post_ID').value;

            const locationValue = document.getElementById('ph_location').value;
            const stateValue = document.getElementById('ph_state').value;
            const phoneValue = document.getElementById('ph_phone').value;
            const cityinfoValue = document.getElementById('ph_cityinfo').value;
            const adwordsCode = document.getElementById('ph_adwords_code').value;
            const adwordsPhone = document.getElementById('ph_adwords_phone_code').value;
            const schemaCode = document.getElementById('ph_schema_code').value;

            const locationData = document.getElementById('ph_location_data').value;

            var url = `/wp-json/ph/v1/update-meta/${postID}`;

            // console.log(locationData)

            axios({
                method: 'post',
                url: url,
                data: {
                    location: locationValue,
                    state: stateValue,
                    cityinfo: cityinfoValue,
                    phone: phoneValue,
                    locationdata: locationData,
                    adwords: adwordsCode,
                    adwordsphone: adwordsPhone,
                    schema: schemaCode,
                }
            }).then (response => {
                // console.log(response.data);
                Swal.fire({
                title: "Good job!",
                text: `Post Updated Sucessfully`,
                icon: "success"
                });
            }).catch (error => {
                console.log(error);
            });
        }
    }
})

</script>