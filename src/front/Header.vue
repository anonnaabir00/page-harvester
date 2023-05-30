<template>
    <div>
            <div v-if="showHeader" class="w-full sm:hidden md:flex justify-center bg-black p-6 text-white z-50 fixed top-0">
                <input type="text" name="name" id="name" placeholder="Name" class="m-2 p-2">
                <input type="email" name="name" id="name" placeholder="Email" class="m-2 p-2">
                <input type="text" name="phone" id="phone" placeholder="Phone" class="m-2 p-2">
                <input type="text" name="zip" id="zip" placeholder="ZIP" class="m-2 p-2">
                <select name="project-type" id="project-type" placeholder="PROJECT TYPE" class="m-2 p-2">
                    <option value="">Dumpster</option>
                    <option value="">Porta Potty</option>
                    <option value="">Fencing</option>
                    <option value="">Multiple</option>
                </select>

                <button class="m-2 p-2" type="submit">Get Estimate</button>
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
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
        handleScroll() {
            this.showHeader = window.pageYOffset > 100;
        }
    }
})

</script>