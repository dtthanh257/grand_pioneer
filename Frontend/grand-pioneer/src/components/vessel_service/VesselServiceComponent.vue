<template>
  <div class="flex-c w-full items-center">
    <div class="flex-r items-start w-full mb-8">
      <div class="md:w-1/4 w-1/2">
        <Combobox
          isV3="true"
          :white="false"
          label="GRAND PIONEER"
        ></Combobox>
      </div>
    </div>
    <div class="flex-r border-bottom-blue mb-8 border-b justify-between w-full">
      <div class="flex-r gap-3">
        <div
          :class="[
            'grid-otp',
            'flex-r',
            'items-center',
            'blue',
            'gap-2',
            { selected: selectedOption == 'grid' },
          ]"
          @click="selectOption('grid')"
        >
          <font-awesome-icon :icon="['fas', 'grip-vertical']" />
          {{ $t("voyageSearch.gridOtp") }}
        </div>
        <div
          :class="[
            'list-otp hidden lg:flex lg:flex-row',
            'items-center',
            'blue',
            'gap-2',
            { selected: selectedOption == 'list' },
          ]"
          @click="selectOption('list')"
        >
          <font-awesome-icon :icon="['fas', 'bars']" />
          {{ $t("voyageSearch.listOtp") }}
        </div>
      </div>
      <div class="border-bottom-blue border-b blue text-xs">PHOTO VIEW</div>
    </div>
    <div
      class="w-full mb-8"
      v-if="selectedOption == 'grid'"
    >
      <div
        class="flex flex-row items-center justify-center text-center gap-5 mb-5 md:mb-8"
        v-if="numPages.data > 1"
      >
        <button
          class="prevBtn h-8 w-8 md:h-10 md:w-10"
          @click="prevPage"
        ></button>
        <div
          class="slide-counter blue"
          id="slideCounter"
        >
          {{ currentPageHuman }} of {{ numPages.data }}
        </div>
        <button
          class="nextBtn h-8 w-8 md:h-10 md:w-10"
          @click="nextPage"
        ></button>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <CardService
          v-for="(item, index) in arrayData.listOfService"
          :key="index"
          :imgUrl="item.service_metadata.length > 0 ? item.service_metadata[0].image_link : ''"
          :card_title="item.title"
          :card_descr="item.content"
          :service_id="item.id"
        >
        </CardService>
      </div>
    </div>
    <div
      class="w-full"
      v-if="selectedOption == 'list'"
    >
      <div
        class="flex flex-row items-center justify-center text-center gap-5 mb-5 md:mb-8"
        v-if="numPages.data > 1"
      >
        <button
          class="prevBtn h-8 w-8 md:h-10 md:w-10"
          @click="prevPage"
        ></button>
        <div
          class="slide-counter blue"
          id="slideCounter"
        >
          {{ currentPageHuman }} of {{ numPages.data }}
        </div>
        <button
          class="nextBtn h-8 w-8 md:h-10 md:w-10"
          @click="nextPage"
        ></button>
      </div>
      <div class="flex-c gap-8 mb-8">
        <VesselServiceCardListComponent
          v-for="(item, index) in arrayData.listOfService"
          :key="index"
          :imgUrl="item.service_metadata.length > 0 ? item.service_metadata[0].image_link : ''"
          :card_title="item.title"
          :card_descr="item.content"
          :service_id="item.id"
        />
      </div>
    </div>
  </div>
</template>
<script setup>
import Combobox from "@/components/Combobox.vue";
import { ref, reactive, computed } from "vue";
import VesselServiceClass from "@/services/vessel_service.service";
import VesselServiceCardListComponent from "@/components/vessel_service/VesselServiceCardListComponent.vue";
import CardService from "@/components/CardService.vue";

const selectedOption = ref("grid");

const selectOption = (option) => {
  selectedOption.value = option;
};

let itemsPaginated = [];

try {
  const service = await VesselServiceClass.getData(localStorage.vessel_id);

  itemsPaginated = service.data.data.services;
} catch (err) {
  console.log(err);
}

const perPage = ref(0);

if (window.innerWidth >= 768 && window.innerWidth <= 1280) {
  perPage.value = 2;
} else if (window.innerWidth >= 1280) {
  perPage.value = 3;
} else {
  perPage.value = 1;
}

const currentPage = ref(0);

const numPages = reactive({
  data: computed(() => Math.ceil(itemsPaginated.length / perPage.value)),
});

const currentPageHuman = computed(() => currentPage.value + 1);

const createSearchData = (data) => {
  return computed(() =>
    data.slice(perPage.value * currentPage.value, perPage.value * (currentPage.value + 1))
  );
};

const arrayData = reactive({
  listOfService: createSearchData(itemsPaginated),
});

const nextPage = () => {
  if (currentPage.value == numPages.data - 1) {
    return;
  } else {
    currentPage.value++;
  }
};

const prevPage = () => {
  if (currentPage.value == 0) {
    return;
  } else {
    currentPage.value--;
  }
};
</script>
<style></style>
