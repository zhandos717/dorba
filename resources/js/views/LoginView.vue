<script setup>
import LayoutAuthenticated from '@/layouts/LayoutAuthenticated.vue'
import {StreamBarcodeReader} from "vue-barcode-reader";

function onDecode(text) {
  console.log(`Decode text from QR code is ${text}`)
}

function onLoaded() {
  console.log(`Ready to start scanning barcodes`)
}
</script>
<template>
  <LayoutAuthenticated>

  </LayoutAuthenticated>

  <StreamBarcodeReader @decode="onDecode" @loaded="onLoaded"></StreamBarcodeReader>

  <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-center">
    <button
        class="bg-blue-500 text-white font-bold py-4 px-6 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
      Сканировать
    </button>
  </div>
</template>
