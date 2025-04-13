require('./bootstrap');
import Vue from 'vue';
import ExampleComponent from './components/ExampleComponent.vue'; // Đảm bảo đường dẫn chính xác

new Vue({
    el: '#app',
    components: {
        ExampleComponent
    }
});