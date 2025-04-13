<template>
    <div>
        <h3>📦 Scan sản phẩm</h3>
        <div id="scanner-container" style="width: 100%; max-width: 400px; border: 2px solid #ccc;"></div>
        <p v-if="barcode">🔍 Đã quét: <strong>{{ barcode }}</strong></p>
        <p v-else>Không tìm thấy mã</p>
    </div>
</template>

<script>
import Quagga from 'quagga'; // Nhớ đã `npm install quagga`

export default {
    data() {
        return {
            barcode: ''
        };
    },
    mounted() {
        this.startScanner();
    },
    beforeDestroy() {
        Quagga.stop();
        Quagga.offDetected(this.onDetected); // cleanup
    },
    methods: {
        startScanner() {
            console.log('[Quagga] Khởi tạo scanner...');

            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#scanner-container'),
                    constraints: {
                        facingMode: "environment" // Dùng camera sau
                    }
                },
                decoder: {
                    readers: [
                        "code_128_reader",
                        "ean_reader",
                        "ean_8_reader",
                        "upc_reader",
                        "upc_e_reader"
                    ]
                },
                locate: true
            }, (err) => {
                if (err) {
                    console.error('[Quagga] Lỗi khởi tạo:', err);
                    return;
                }

                Quagga.start();
                console.log('[Quagga] Scanner đã bắt đầu');
            });

            // Gán listener cho sự kiện quét
            Quagga.onDetected((result) => {
                this.onDetected(result);
            });
        },

        onDetected(result) {
            console.log('chạy hàm onDetected');
            if (
                result &&
                result.codeResult &&
                result.codeResult.code
            ) {
                const code = result.codeResult.code;
                console.log('[Quagga] Quét được mã:', code);

                if (this.barcode !== code) {
                    this.barcode = code;

                    // Nếu bạn có API thì gọi ở đây
                    /*
                    fetch(`/api/product/barcode?barcode=${code}`)
                      .then(res => res.json())
                      .then(data => {
                        if (data.status === 'success') {
                          alert(`Tên sản phẩm: ${data.product.name}`);
                        } else {
                          alert('Không tìm thấy sản phẩm!');
                        }
                      });
                    */

                    // Dừng quét và gỡ bỏ listener
                    Quagga.stop();
                    Quagga.offDetected(this.onDetected); // tránh gọi lại nhiều lần
                }
            }
        }
    }
};
</script>

<style scoped>
#scanner-container video {
    width: 100%;
    height: auto;
}
</style>
