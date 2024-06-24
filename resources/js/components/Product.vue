<script setup>

import CameraScanner from "@/components/CameraScanner.vue";
import {search} from "@/services/api/v1/productApi.js";
import {useToast} from "primevue/usetoast";


const toast = useToast()


async function scan(data) {
  console.log(data);

  const response = await search(data);


  console.log(response)
}

</script>

<template>
  <CameraScanner @scan="scan"></CameraScanner>
</template>

<style scoped>

</style>