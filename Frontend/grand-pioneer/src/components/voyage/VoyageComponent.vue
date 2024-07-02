<script setup>
import VoyageService from "@/services/voyage.service";
import CardVoyage from "@/components/CardVoyage.vue";
import Button from "@/components/Button.vue";
import { computed, reactive, ref } from "vue";
import router from "@/router";

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
</script>

<template>
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
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 md:gap-6">
    <CardVoyage
      v-for="(item, key) in arrayData.listOfVoyage"
      :key="key"
      :voyage_id="item.id"
      :card_title="item.summary_location"
      day="2 DAYS / 1 NIGHTS"
      :fare="item.fares"
      :time="item.voyage_date_available.length + ' DATE AVAILABLE'"
      :imgUrl="item.voyage_metadata.length > 0 ? item.voyage_metadata[0].image_link : ''"
    >
    </CardVoyage>
  </div>

  <!-- </div> -->
  <div class="flex flex-row items-center justify-center py-2 mt-10">
    <Button
      text="EXPLORE ALL OUR VOYAGES"
      @click="router.push('/voyage-search')"
    ></Button>
  </div>
</template>
