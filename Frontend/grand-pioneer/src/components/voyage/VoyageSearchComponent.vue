<script setup>
import VoyageService from "@/services/voyage.service";
import CardVoyage from "@/components/CardVoyage.vue";
// import Button from "@/components/Button.vue";
import { computed, reactive, ref } from "vue";
import PageLogo from "@/components/PageLogo.vue";
import Combobox from "@/components/Combobox.vue";
import CardList from "@/components/CardList.vue";

let itemsPaginated = [];
try {
  const voyage = await VoyageService.getData(localStorage.vessel_id);

  itemsPaginated = voyage.data.data.voyages;
} catch (err) {
  console.log(err);
}

const perPage = ref(3);

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
  listOfVoyage: createSearchData(itemsPaginated),
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

const selectedOption = ref("grid");

const selectOption = (option) => {
  selectedOption.value = option;
};
</script>

<template>
  <div class="flex-r justify-center">
    <PageLogo></PageLogo>
  </div>
  <div class="flex flex-row text-lg md:text-xl justify-center blue pb-8">
    {{ $t("voyageSearch.title") }}
  </div>
  <div class="flex-c md:flex-r pb-8 gap-5">
    <Combobox
      isV3="true"
      :white="false"
      fetchValue="DESTINATION"
    ></Combobox>
    <Combobox
      isV3="true"
      :white="false"
      fetchValue="CHECK IN - CHECK OUT"
    ></Combobox>
    <Combobox
      isV3="true"
      :white="false"
      fetchValue="MONTH & YEAR"
    ></Combobox>
  </div>
  <div class="flex-r border-bottom-blue mb-8 border-b justify-between">
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
          'list-otp hidden md:block',
          'flex-r',
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
  <div
    class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 md:gap-6"
    v-if="selectedOption == 'grid'"
  >
    <CardVoyage
      v-for="(item, key) in arrayData.listOfVoyage"
      :key="key"
      :card_title="item.summary_location"
      day="3 DAYS / 2 NIGHTS"
      :fare="item.fares"
      :time="item.voyage_date_available.length + ' DATE AVAILABLE'"
      :imgUrl="item.voyage_metadata.length > 0 ? item.voyage_metadata[0].image_link : ''"
      :voyage_id="item.id"
    >
    </CardVoyage>
  </div>
  <div
    class="mx-auto hidden md:block"
    v-if="selectedOption == 'list'"
  >
    <div class="flex-c gap-8 mb-8">
      <CardList
        v-for="(item, key) in arrayData.listOfVoyage"
        :key="key"
        :imgUrl="item.voyage_metadata.length > 0 ? item.voyage_metadata[0].image_link : ''"
        :card_title="item.summary_location"
        :card_date_availeble="item.voyage_date_available.length + 'DATE AVAILABLE'"
        :card_fare="item.fares"
      ></CardList>
    </div>
  </div>
</template>

<style></style>
