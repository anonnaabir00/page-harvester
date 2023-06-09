<template>
    <div>
            <div class="w-full sm:hidden md:flex justify-center">
                <input type="text" name="name" id="name" placeholder="Name" class="m-2 p-1 px-5 py-2 text-sm placeholder:text-black placeholder:uppercase">
                <input type="email" name="name" id="name" placeholder="Email" class="m-2 p-1 px-5 py-2 text-sm placeholder:text-black placeholder:uppercase">
                <input type="text" name="phone" id="phone" placeholder="Phone" class="m-2 p-1 px-5 py-2 text-sm placeholder:text-black placeholder:uppercase">
                <input type="text" name="zip" id="zip" placeholder="ZIP" class="w-24 m-2 p-1 px-5 py-2 text-sm placeholder:text-black placeholder:uppercase">
                <select name="project-type" id="project-type" placeholder="PROJECT TYPE" class="w-48 m-2 p-1 px-5 py-2 text-sm placeholder:text-black placeholder:uppercase">
                    <option value="">Dumpster</option>
                    <option value="">Porta Potty</option>
                    <option value="">Fencing</option>
                    <option value="">Multiple</option>
                </select>

                <button class="m-2 pt-3 pb-3 pl-6 pr-6 bg-green-500 text-white text-sm" type="submit">Get Estimate</button>
            </div>
    </div>
</template>


<script>
import Vue from 'vue';

export default({
    name: 'Header',
    data() {
        return {
            showHeader: false
        }
    },
    mounted() {
        
    },
    methods: {

    }
})

</script>