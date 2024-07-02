<template>
  <div class="flex-c items-center gap-8 mb-8">
    <PageLogo></PageLogo>
    <div class="blue text-lg md:text-xl text-center">SERVICES</div>
    <div class="blue text-4xl md:text-5xl text-center">{{ serviceData.title }}</div>
    <div class="blue w-full text-xs lg:text-base text-center">
      <li class="list-none">Location: {{ serviceData.location }}</li>
      <li class="list-none">Opening Hour: {{ serviceData.opening_hour }}</li>
    </div>
    <div class="blue text-xs lg:text-base text-center w-full">
      {{ serviceData.content }}
    </div>
    <div
      v-for="(item, index) in serviceData.service_metadata"
      :key="index"
      class="h-screen w-full bg-cover"
      :style="{ backgroundImage: `url(${item.image_link})` }"
    ></div>
    <div class="blue text-lg md:text-xl text-center">OTHER SERVICES</div>
    <VesselServiceComponent />
  </div>
</template>
<script setup>
import PageLogo from "@/components/PageLogo.vue";
import VesselServiceClass from "@/services/vessel_service.service";
import VesselServiceComponent from "@/components/vessel_service/VesselServiceComponent.vue";
import { defineProps } from "vue";

const props = defineProps({
  service_id: {
    type: Number,
  },
});

let serviceData = { service_metadata: [] };

try {
  const service = await VesselServiceClass.getDataById(localStorage.vessel_id, props.service_id);
  serviceData = service.data.data.service;
} catch (err) {
  console.log(err);
}
</script>
<style></style>
