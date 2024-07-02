<script setup>
import PageLogo from "@/components/PageLogo.vue";
import Combobox from "@/components/Combobox.vue";
import VoyageComponent from "@/components/voyage/VoyageComponent.vue";
import Button from "@/components/Button.vue";
import VoyageService from "@/services/voyage.service";
import { defineProps, reactive, ref } from "vue";
import { diffDate } from "@/helpers/diff.date.function";

const props = defineProps({
  voyage_id: {
    type: Number,
  },
});

let voyageData = {
  voyage_date_available: [],
  voyage_timeline: [],
  voyage_experience: [],
  voyage_location: [],
  voyage_metadata: [],
};

let voyage_timeline = reactive({ data: [] });

try {
  const voyage = await VoyageService.getDataById(localStorage.vessel_id, props.voyage_id);
  voyageData = voyage.data.data.voyage;
  voyage_timeline = reactive({ data: voyageData.voyage_timeline });
} catch (err) {
  console.log(err);
}

const activeDays = reactive({ data: [] });
const toggleDay = (index) => {
  if (activeDays.data.includes(index)) {
    activeDays.data = activeDays.data.filter((day) => day !== index);
  } else {
    activeDays.data.push(index);
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
  <div class="flex-c gap-8 mb-8">
    <div class="blue flex-r justify-center">
      <div class="blue w-full text-4xl md:text-5xl text-center">
        {{ voyageData.title }}
      </div>
    </div>
    <div class="flex-r justify-center">
      <div class="blue text-center text-xs md:text-base w-full">
        {{ voyageData.content }}
      </div>
    </div>
    <div class="flex-r justify-center gap-8">
      <Button
        button_v="0"
        text="EXPLORE"
      ></Button>
      <Button
        button_v="1"
        text="INQUIRE NOW"
      ></Button>
    </div>
  </div>
  <div class="container mx-auto p-4 mb-8">
    <div class="grid grid-cols-3 md:grid-cols-6 gap-8">
      <div class="flex-c gap-3 items-center">
        <div class="voyage-date bg-contain"></div>
        <div class="blue text-xs md:text-base">VOYAGE DATE</div>
        <div class="blue text-xs md:text-base"></div>
      </div>
      <div class="flex-c gap-3 items-center">
        <div class="voyage-night bg-contain"></div>
        <div class="blue text-xs md:text-base">NIGHTS</div>
        <div class="blue text-xs md:text-base">
          {{
            voyageData.voyage_date_available.length > 0
              ? diffDate(
                  voyageData.voyage_date_available.end_date,
                  voyageData.voyage_date_available.start_date
                )
              : 0
          }}
        </div>
      </div>
      <div class="flex-c gap-3 items-center">
        <div class="voyage-vessel bg-contain"></div>
        <div class="blue text-xs md:text-base">VESSEL</div>
        <div class="blue text-xs text-center md:text-base uppercase text-nowrap">
          {{ voyageData.vessel }}
        </div>
      </div>
      <div class="flex-c gap-3 items-center">
        <div class="voyage-embark bg-contain"></div>
        <div class="blue text-xs md:text-base">EMBARK</div>
        <div class="blue text-xs md:text-base uppercase">{{ voyageData.embark }}</div>
      </div>
      <div class="flex-c gap-3 items-center">
        <div class="voyage-debark bg-contain"></div>
        <div class="blue text-xs md:text-base">DEBARK</div>
        <div class="blue text-xs md:text-base uppercase">{{ voyageData.debark }}</div>
      </div>
      <div class="flex-c gap-3 items-center">
        <div class="voyage-fare bg-contain"></div>
        <div class="blue text-xs md:text-base">FARES</div>
        <div class="blue text-xs text-center md:text-base uppercase">{{ voyageData.fares }}</div>
      </div>
    </div>
  </div>
  <div class="h-full w-full bg-contain mb-8">
    <img
      :src="voyageData.voyage_metadata.length > 0 ? voyageData.voyage_metadata[0].image_link : ''"
      class="object-contain"
    />
  </div>
  <div class="flex-c items-center mb-20">
    <div class="blue mb-8 text-lg md:text-xl">ITINERARY</div>
    <div class="blue text-4xl md:text-5xl mb-8">JOURNEY WITH US</div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
      <div class="flex-1">
        <div class="yellow">
          {{ voyageData.voyage_location.length > 0 ? voyageData.voyage_location[0].title : "" }}
        </div>
        <div class="blue text-2xl w-full mb-8">
          {{ voyageData.voyage_location.length > 0 ? voyageData.voyage_location[0].sub_title : "" }}
        </div>
        <div class="blue text-xs">
          {{
            voyageData.voyage_location.length > 0 ? voyageData.voyage_location[0].description : ""
          }}
        </div>
      </div>
      <div class="flex-1">
        <div class="flex-c gap-4">
          <div class="flex-r items-center">
            <div
              class="flex-c border-r border-solid pr-2"
              style="border-right: 1px solid var(--blue-color)"
            >
              <div class="blue text-base">ITINERARY DETAILS</div>
              <div class="blue text-xs">DAY | DESTINATION</div>
            </div>
            <div class="blue text-xs pl-2">{{ voyage_timeline.data.length }} DAYS</div>
          </div>
          <div class="flex-c voyage-detail-container">
            <div
              v-for="(value, index) in voyage_timeline.data"
              :key="index"
              class="flex-c day-item"
              @click="toggleDay(index)"
            >
              <div
                class="flex-r jc-sb pb-2 mb-2 cursor-pointer"
                :class="{ active: activeDays.data.includes(index) }"
              >
                <div :class="{ 'yellow text-xs': true }">
                  {{ value.daytime }}
                </div>
                <font-awesome-icon
                  :icon="['fas', 'chevron-down']"
                  :class="[{ rotate: activeDays.data.includes(index) }, 'yellow']"
                />
              </div>
              <div
                v-if="activeDays.data.includes(index)"
                class="details open flex-c gap-2 mb-2"
              >
                <div
                  class="voyage-detail blue text-xs"
                  v-html="value.detail"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="flex-c items-center mb-8">
    <div class="blue mb-8 text-lg md:text-xl">ACCOMMODATIONS</div>
    <div class="blue text-4xl md:text-5xl mb-8">SUITE & FARES</div>
    <div class="flex-r items-start w-full mb-8">
      <div class="w-1/2 md:w-1/4">
        <Combobox
          isV3="true"
          :white="false"
          label="SIGNATURE SUITES"
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
      </div>
      <div class="border-bottom-blue border-b blue text-xs">PHOTO VIEW</div>
    </div>
    <div
      class="mb-20 w-full"
      v-if="selectedOption == 'grid'"
    >
      <VoyageComponent />
    </div>

    <div class="flex-c items-center mb-8 w-full">
      <div class="blue mb-8 text-lg md:text-xl">CONNECTIVITY</div>
      <div class="blue mb-8 text-center text-4xl md:text-5xl">CONNECTING SUITES</div>
    </div>
    <!-- Service Section -->
    <!-- <div class="xl:h-screen xl:w-full mt-20 mb-10">
      <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 h-full">
        <div class="service-slide-content">
          <div class="flex flex-col justify-around h-full">
            <div class="flex flex-row overflow-hidden slide-title">
              <div class="flex flex-col justify-around h-full overflow-hidden">
                <div class="blue uppercase text-center text-lg md:text-xl overflow-hidden">
                  <p>{{ $t("service.titleNor") + $t("service.titleItalic") }}</p>
                </div>
              </div>
            </div>
            <div class="blue overflow-hidden uppercase text-4xl py-7 md:text-5xl text-center">
              Oceania Pool & Bar
            </div>
            <div class="flex flex-row items-center justify-center blue overflow-hidden">
              <div
                class="slide-content flex flex-col text-center text-xs h-full md:text-base font-normal my-4 pb-5"
              >
                <p class="pb-3 xl:pb-5">Location: 2nd floor</p>
                <p class="pb-3 xl:pb-5">Opening Hours: 6:30 - 22:00</p>

                <p>
                  Enjoy relaxation and immerse yourself in the cool crystal waters of the largest
                  four-season saltwater pool, listening to the call of nature in the heart of the
                  World Wonder.
                </p>
              </div>
            </div>
            <div
              class="flex flex-row items-center justify-center text-center overflow-hidden gap-5 pt-5 pb-5"
            >
              <button class="prevBtn h-8 w-8 md:h-10 md:w-10"></button>
              <div
                class="slide-counter blue"
                id="slideCounter"
              >
                1 of 3
              </div>
              <button class="nextBtn h-8 w-8 md:h-10 md:w-10"></button>
            </div>
            <div class=" bg-cover w-full h-96 block xl:hidden"></div>
            <div class="flex flex-row items-center justify-center overflow-hidden pt-12 pb-1">
              <Button text="EXPLORE MORE"></Button>
            </div>
          </div>
        </div>
        <div class=" bg-cover h-full w-full hidden xl:block"></div>
      </div>
    </div> -->
    <div class="flex-c items-center w-full">
      <div class="blue mb-8 text-lg md:text-xl">EXPERIENCES</div>
      <div class="blue mb-8 text-center text-4xl md:text-5xl">EXPERIENCES ON JOURNEY</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div
          class="mb-8"
          v-for="(item, index) in voyageData.voyage_experience"
          :key="index"
        >
          <div class="blue">
            <div class="cuisine-img bg-contain"></div>
          </div>
          <div class="flex-c">
            <div
              class="blue text-xs"
              v-html="item.review"
            ></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style></style>
