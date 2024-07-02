<template>
  <div
    class="grid grid-cols-1 xl:grid-cols-2 gap-4 h-full xl:h-screen"
    v-for="(item, index) in arrayData.listOfActivity"
    :key="index"
  >
    <div
      class="bg-cover h-full w-full hidden xl:block"
      :style="
        item.activity_metadata.length > 0
          ? { 'background-image': 'url(' + item.activity_metadata[0].image_link + ')' }
          : ''
      "
    ></div>
    <div class="service-slide-content">
      <div class="flex flex-col justify-around h-full">
        <div class="flex flex-row overflow-hidden slide-title">
          <div class="flex flex-col justify-around h-full overflow-hidden">
            <div class="blue uppercase text-center text-lg md:text-xl overflow-hidden">
              <p>{{ $t("activity.titleNor") + $t("activity.titleItalic") }}</p>
            </div>
          </div>
        </div>
        <div class="blue overflow-hidden text-4xl py-7 md:text-5xl text-center">
          {{ item.title }}
        </div>
        <div class="flex flex-row items-center justify-center flex-wrap blue overflow-hidden">
          <div
            class="slide-content flex flex-col text-center text-xs h-full md:text-base font-normal text-wrap my-4 pb-5"
          >
            {{ item.content }}
          </div>
        </div>
        <div
          class="bg-cover w-full h-96 block xl:hidden mb-5"
          :style="
            item.activity_metadata.length > 0
              ? { 'background-image': 'url(' + item.activity_metadata[0].image_link + ')' }
              : ''
          "
        ></div>

        <div
          class="flex flex-row items-center justify-center text-center overflow-hidden gap-5 pt-5 pb-10"
        >
          <button
            class="prevBtn h-8 w-8 md:h-10 md:w-10"
            @click="prevPage"
          ></button>
          <div class="slide-counter blue">{{ currentPageHuman }} of {{ numPages.data }}</div>
          <button
            class="nextBtn h-8 w-8 md:h-10 md:w-10"
            @click="nextPage"
          ></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, reactive, ref } from "vue";
import ActivityService from "@/services/activity.service";
let itemsPaginated = [];
try {
  const activities = await ActivityService.getData(localStorage.vessel_id);
  itemsPaginated = activities.data.data.activities;
} catch (err) {
  console.log(err);
}

const perPage = ref(1);

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
  listOfActivity: createSearchData(itemsPaginated),
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
