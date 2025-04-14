require('./bootstrap');
import Vue from 'vue';
import { StreamBarcodeReader } from 'vue-barcode-reader';

import ExampleComponent from './components/ExampleComponent.vue'; // Đảm bảo đường dẫn chính xác
import VueBarcode from './components/VueBarcode.vue'; // Đảm bảo đường dẫn chính xác


new Vue({
    el: '#app',
    components: {
        ExampleComponent,
        VueBarcode,
        StreamBarcodeReader
    },
    // render: h => h(App)

});