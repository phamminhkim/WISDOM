<template>
    <div>
      <p>Chạy Demo Scanner Barcode</p>
      <stream-barcode-reader
        :paused="false"
        @decode="handleBarcodeScan"
        @loaded="onLoaded"
        :track="true"
      />
    </div>
  </template>
  
  <script>
  import { StreamBarcodeReader } from 'vue-barcode-reader';
  
  export default {
    components: {
      StreamBarcodeReader,
    },
    methods: {
      handleBarcodeScan(barcode) {
        console.log('Barcode detected:', barcode);
        alert(`Đã quét: ${barcode}`);
      },
      onLoaded() {
        console.log('Camera đã sẵn sàng để quét!');
      },
    },
  };
  </script>
  