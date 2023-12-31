<template>
    <div class="ph-cwcalc bg-gray-300">
        <div class="ph-cwcalc-header flex justify-center bg-black text-white text-2xl text-center p-6">
            <div class="mt-1 mr-1 text-4xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z" />
            </svg>
            </div>
            Concrete Weight Calculator
        </div>
        <div class="ph-cwcalc-body grid grid-cols-1 gap-6 p-6 text-black">
            <label for="">How many square feet of debris need to be disposed of?</label>
            <input v-model="cft" type="number">
            <label for="">What is the approximate thickness? (inches)</label>
            <input v-model="thickness" type="number">
            <div class="flex justify-center">
            <button @click="calculateWeight()" class="ph-cwcalc-button brand-color-2 p-4 text-black">Estimate My Weight</button>
        </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2';

export default({
    name: 'ConcreteWeightCalculator',
    data() {
        return {
            cft: null,
            thickness: null,
        }
    },
    mounted() {        
    },
    methods: {
        calculateWeight(){
            if (this.cft === null || this.thickness === null){
                Swal.fire({
                    title: 'Error!',
                    text: 'Please fill out all fields',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

                const volume = Math.round(this.cft*this.thickness/12);
                const lbs_weight = Math.round(volume*75);
                const ton_weight = Math.round(lbs_weight * 0.0004535923 * 10) / 10;

                Swal.fire({
                title: "Good job!",
                text: `Estimated weight: ${lbs_weight} lbs or ${ton_weight} ton(s)`,
                icon: "success"
                });
        }
    }
})

</script>