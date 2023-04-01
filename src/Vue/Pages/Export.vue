<template>
    <div>
        <div class="grid grid-cols-2 bg-white mt-12 p-12 align-baseline">
            <div class="grid grid-cols-1 gap-6">
                <h2 class="text-lg font-semibold">Export Dumpster GEO Pages</h2>
                <h2 class="text-lg font-semibold">Export Porta Potty GEO Pages</h2>
            </div>
            <div class="grid grid-cols-1 w-2/6 gap-6">
                <button @click="dumpsterGeo()" class="brand-color-2 text-white pl-4 pr-4 pt-3 pb-3">Export Pages</button>
                <button @click="portapottyGeo()" class="brand-color-2 text-white pl-4 pr-4 pt-3 pb-3">Export Pages</button>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
import axios from 'axios';

export default({
    name: 'Export',
    data() {
        return {
            
        }
    },
    methods: {
        dumpsterGeo(){
            var url = '/wp-json/ph/v1/dumpster/geo/export';
            axios.get(url).then(response => {
                var jsonData = response.data;
                var textData = jsonData.map(obj => JSON.stringify(obj)).join('\n');

                var blob = new Blob([textData], {type: "text/plain"});
                var url  = URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.download    = "dumpster-geo.csv";
                a.href        = url;
                a.textContent = "Download file";
                a.click();
        })
        },

        portapottyGeo(){
            var url = '/wp-json/ph/v1/porta-potty/geo/export';
            axios.get(url).then(response => {
                var jsonData = response.data;
                var textData = jsonData.map(obj => JSON.stringify(obj)).join('\n');

                var blob = new Blob([textData], {type: "text/plain"});
                var url  = URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.download    = "portapotty-geo.csv";
                a.href        = url;
                a.textContent = "Download file";
                a.click();
        })
        }
    }
})

</script>