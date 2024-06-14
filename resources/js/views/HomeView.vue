<template>
  <div class="flex flex-col items-center justify-center min-h-screen">
    <div v-if="isScanning" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
      <StreamBarcodeReader v-model:decode="onDecode" @loaded="onLoaded"
                           class="w-96 h-96 rounded-lg border border-gray-300 shadow-md overflow-hidden"
                           ref="barcodeReader"/>
    </div>
    <h1 v-else class="text-3xl font-bold mb-4 text-center">Сканируйте товар для оставления отзыва</h1>
    <h2 v-if="decodedText" class="text-xl mt-4">Найденный штрих: {{ decodedText }}</h2>
    <button @click="toggleScanning" :class="buttonClass">
      <BaseIcon :path="buttonIcon" class="text-3xl"/>

      Сканировать
    </button>
  </div>
</template>

<script setup>
import {ref} from 'vue';
import {StreamBarcodeReader} from 'vue-barcode-reader';
import BaseIcon from "@/components/BaseIcon.vue";
import {mdiBarcodeOff, mdiBarcodeScan} from "@mdi/js";

const decodedText = ref('');
const isScanning = ref(false);
const barcodeReader = ref(null);

const onLoaded = () => console.log('loaded');
const onDecode = (text) => (decodedText.value = text);

const toggleScanning = () => {
  isScanning.value = !isScanning.value;
  if (isScanning.value) {
    barcodeReader.value.start();
  } else {
    barcodeReader.value.stop();
  }
};

const buttonIcon = ref(mdiBarcodeScan);
const buttonClass = ref("bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full fixed bottom-4");

</script>

<style scoped>
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f9f9f9;
  margin: 0;
}

h1 {
  color: #333;
}

.StreamBarcodeReader video {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

</style>
