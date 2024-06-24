<template>

  <Toast/>

  <div class="flex flex-col items-center justify-center min-h-screen">
    <div v-if="isScanning" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
      <StreamBarcodeReader
          @decode="onDecode"
          @loaded="onLoaded"
          class="w-96 h-auto rounded-lg border border-gray-300 shadow-md overflow-hidden"
          ref="barcodeReader"
      ></StreamBarcodeReader>
      <h2 v-if="decodedText" class="text-xl mt-4">Найденный штрих: {{ decodedText }}</h2>
    </div>
    <h1 v-else class="text-3xl font-bold mb-4 text-center">Сканируйте товар для оставления отзыва</h1>
    <button @click="toggleScanning" :class="buttonClass">
      <BaseIcon :path="buttonIcon" class="text-3xl"/>
      <span v-if="!isScanning">Сканировать</span>
    </button>

  </div>
</template>

<script setup>
import {ref} from 'vue';
import {StreamBarcodeReader} from 'vue-barcode-reader';
import BaseIcon from "@/components/BaseIcon.vue";
import {mdiBarcodeScan, mdiClose} from "@mdi/js";

import {useToast} from "primevue/usetoast";


const emit = defineEmits(['scan'])

const decodedText = ref('');
const isScanning = ref(false);
const barcodeReader = ref(null);
const buttonClass = ref("bg-blue-500 hover:bg-blue-700 text-white font-bold py-6 px-12 rounded-full fixed bottom-4");
const buttonIcon = ref(mdiBarcodeScan);
const onLoaded = () => console.log('loaded');

const toast = useToast();

async function onDecode(data) {
  emit('scan', data)
}

const toggleScanning = () => {
  isScanning.value = !isScanning.value;

  toast.add({severity: 'info', summary: 'Info', detail: 'Message Content', life: 3000});


  if (isScanning.value) {
    buttonClass.value = 'bg-red-500 text-white ont-bold py-6 px-12 rounded-full fixed bottom-4'
    buttonIcon.value = mdiClose
  } else {
    buttonIcon.value = mdiBarcodeScan
    buttonClass.value = "bg-blue-500 hover:bg-blue-700 text-white font-bold py-6 px-12 rounded-full fixed bottom-4"
  }
};


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
