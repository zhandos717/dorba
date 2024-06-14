<script setup>
import {ref} from "vue";
import {StreamBarcodeReader} from "vue-barcode-reader";

const decodedText = ref("");

const onLoaded = () => {
  console.log("loaded");
};

const onDecode = (text) => {
  decodedText.value = text;
};
</script>

<template>
  <StreamBarcodeReader @decode="onDecode" @loaded="onLoaded"></StreamBarcodeReader>
  <h2>{{ decodedText }}</h2>

</template>

<style scoped>

</style>