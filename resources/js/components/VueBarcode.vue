<template>
  <div>
    <!-- Hiển thị trạng thái quét -->
    <div v-if="isLoading" class="loading-indicator">
      Đang quét...
    </div>
    <div v-else>
      <stream-barcode-reader :key="readerKey" :paused="isPaused" @decode="handleBarcodeScan" @loaded="onLoaded"
        :track="true" />
    </div>

  </div>
</template>

<script>
import { StreamBarcodeReader } from 'vue-barcode-reader';

export default {
  components: {
    StreamBarcodeReader,
  },
  data() {
    return {
      isPaused: false,   // Dùng để tạm dừng quét
      lastBarcode: '',   // Mã vạch đã quét gần nhất
      readerKey: 0,      // Key để reset lại component camera
      showScanner: true,  // Hiển thị camera
      isLoading: false,   // Trạng thái đang quét
    };
  },
  methods: {
    handleBarcodeScan(barcode) {
      // Đặt trạng thái đang quét
      this.isLoading = true;

      // Tạm dừng quét ngay lập tức
      this.isPaused = true;

      // Sau khi quét, hiển thị alert
      setTimeout(() => {
        // Sau khi nhấn OK trong alert, reset camera
        this.isPaused = false;
        this.readerKey += 1; // Tăng key để reset lại camera

        // Đặt trạng thái quét xong
        this.isLoading = false;
        alert(`${barcode}`);

      }, 500);  // Tạm dừng 500ms để đảm bảo việc quét được tạm dừng trước khi hiển thị alert
    },
    onLoaded() {
      console.log('Camera đã sẵn sàng để quét!');
    },
  },
};
</script>

<style scoped>
.loading-indicator {
  background-color: rgba(0, 0, 0, 0.7);
  color: white;
  padding: 10px;
  border-radius: 5px;
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
