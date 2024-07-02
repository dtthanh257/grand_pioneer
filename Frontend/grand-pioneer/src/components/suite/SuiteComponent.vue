<template>
  <div
    class="grid grid-cols-1 xl:grid-cols-2 gap-4 h-full xl:h-screen"
    v-for="(item, index) in arrayData.listOfSuite"
    :key="index"
  >
    <div
      class="bg-cover h-full w-full hidden xl:block"
      :style="
        item.suite_metadata.length > 0
          ? { 'background-image': 'url(' + item.suite_metadata[0].image_link + ')' }
          : ''
      "
    ></div>
    <div class="suites-slide-content">
      <div class="flex flex-col justify-around h-full">
        <div class="flex flex-row overflow-hidden slide-title">
          <div class="blue uppercase text-center text-lg md:text-xl">
            <p>
              {{ $t("suite.titleNor") + $t("suite.titleItalic") }}
            </p>
          </div>
        </div>
        <div class="blue overflow-hidden text-4xl py-7 md:text-5xl text-center">
          {{ item.title }}
        </div>
        <div class="flex flex-row items-center justify-center blue overflow-hidden">
          <div
            class="slide-content flex text-center text-xs h-full md:text-base font-normal my-4 pb-5"
          >
            {{ item.content }}
          </div>
        </div>
        <div
          class="bg-cover w-full h-96 block xl:hidden mb-5"
          :style="
            item.suite_metadata.length > 0
              ? { 'background-image': 'url(' + item.suite_metadata[0].image_link + ')' }
              : ''
          "
        ></div>
        <div class="flex flex-row py-5 overflow-hidden justify-center">
          <Button
            button_v="0"
            text="EXPLORE"
            @click="redirectTo(item.id)"
          ></Button>
        </div>
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
        <div class="flex flex-row justify-center items-center overflow-hidden py-1">
          <Button
            text="EXPLORE ALL SUITES"
            @click="router.push('/suite-view')"
          ></Button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Button from "@/components/Button.vue";
import { computed, reactive, ref } from "vue";
import router from "@/router";
import SuiteService from "@/services/suite.service";

let itemsPaginated = [];
try {
  const suite = await SuiteService.getData(localStorage.vessel_id);

  itemsPaginated = suite.data.data.suites;
} catch (err) {
  console.log(err);
}

const perPage = ref(1);

// if (window.innerWidth >= 768 && window.innerWidth <= 1280) {
//   perPage.value = 2;
// } else if (window.innerWidth >= 1280) {
//   perPage.value = 3;
// } else {
//   perPage.value = 1;
// }

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
  listOfSuite: createSearchData(itemsPaginated),
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

const redirectTo = (id) => {
  router.push("/suite-detail/" + id).then(() => {
    window.location.reload();
  });
};
</script>
<style></style>
