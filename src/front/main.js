import Vue from 'vue';
import Header from './Header.vue';
import ConcreteWeightCalculator from './ConcreteWeightCalculator.vue';


new Vue({
    el: '#ph-leadform',
    render: h => h(Header),
});

new Vue({
    el: '#ph-concrete-weight-calculator',
    render: h => h(ConcreteWeightCalculator),
});