<script setup>
import PageLogo from "@/components/PageLogo.vue";
import Button from "@/components/Button.vue";
import SuiteService from "@/services/suite.service";
import { defineProps, ref } from "vue";

const props = defineProps({
  suite_id: {
    type: Number,
  },
});

let suiteData = { suite_metadata: [] };
try {
  const suite = await SuiteService.getDataById(localStorage.vessel_id, props.suite_id);
  suiteData = suite.data.data.suite;
} catch (err) {
  console.log(err);
}

// const activeDays = reactive({ data: [] });
// // const toggleDay = (index) => {
// //   if (activeDays.data.includes(index)) {
// //     activeDays.data = activeDays.data.filter((day) => day !== index);
// //   } else {
// //     activeDays.data.push(index);
// //   }
// // };

const selectedOption = ref("features");

const selectOption = (option) => {
  selectedOption.value = option;
};
</script>

<template>
  <div class="flex-c items-center gap-8">
    <PageLogo></PageLogo>
    <div class="blue text-lg md:text-xl">SUITES</div>
    <div class="blue text-4xl md:text-5xl">{{ suiteData.title }}</div>
    <div class="blue text-center w-full text-xs lg:text-base">
      {{ suiteData.content }}
    </div>
    <div class="flex-r justify-center gap-8 w-full mb-8">
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
  <div class="flex-c gap-8 mb-8">
    <div
      class="h-screen w-full bg-cover"
      v-for="(value, key) in suiteData.suite_metadata"
      :key="key"
      :style="
        suiteData.suite_metadata.length > 0 ? { backgroundImage: `url(${value.image_link})` } : ''
      "
    ></div>
  </div>
  <div class="flex-c items-center mb-8">
    <div class="blue text-lg md:text-xl">DETAILS</div>
  </div>
  <div class="flex-r border-bottom-blue mb-8 border-b justify-between hidden md:flex">
    <div class="flex-r gap-3">
      <div
        :class="[
          'grid-otp',
          'flex-r',
          'items-center',
          'blue',
          'gap-2',
          { selected: selectedOption == 'features' },
        ]"
        @click="selectOption('features')"
      >
        FEATURES
      </div>
      <div
        :class="[
          'list-otp',
          'flex-r',
          'items-center',
          'blue',
          'gap-2',
          { selected: selectedOption == 'facilities' },
        ]"
        @click="selectOption('facilities')"
      >
        FACILITIES
      </div>
    </div>
  </div>
  <div
    class="hidden md:grid grid-cols-2 md:grid-cols-2 gap-4 w-full mb-8"
    v-if="selectedOption == 'features'"
  >
    <div class="flex flex-col md:flex-row items-center">
      <div class="flex items-center justify-center w-20 aspect-video">
        <img
          src="@/assets/suite-bed.png"
          style="width: 80px; width: 40px; object-fit: contain"
          alt=""
        />
      </div>
      <div class="flex-c gap-2">
        <div class="blue font-medium text-center md:text-start">BedS</div>
        <div class="blue text-center md:text-start">{{ suiteData.bed_number }} twin/double bed</div>
      </div>
    </div>

    <div class="flex flex-col md:flex-row items-center">
      <div class="flex items-center justify-center w-20 aspect-video">
        <img
          src="@/assets/suite-occupie.png"
          style="width: 80px; width: 40px; object-fit: contain"
          alt=""
        />
      </div>
      <div class="flex-c gap-2">
        <div class="blue text-center font-medium md:text-start">Max Occupancy</div>
        <div class="blue text-center md:text-start">
          <p>{{ suiteData.number_of_adult }} adults</p>
          <p>{{ suiteData.number_of_children }} children under 5</p>
        </div>
      </div>
    </div>
    <div class="flex flex-col md:flex-row items-center">
      <div class="flex items-center justify-center w-20 aspect-video">
        <img
          src="@/assets/suite-size.png"
          style="width: 80px; width: 40px; object-fit: contain"
          alt=""
        />
      </div>
      <div class="flex-c gap-2">
        <div class="blue text-center font-medium md:text-start">Size</div>
        <div class="blue text-center md:text-start">
          <p>Suite: {{ suiteData.suite_size }}</p>
          <p>Sundeck: {{ suiteData.sundeck_size }}</p>
          <p>Total: {{ suiteData.suite_size + suiteData.sundeck_size }}</p>
        </div>
      </div>
    </div>
    <div class="flex flex-col md:flex-row items-center">
      <div class="flex items-center justify-center w-20 aspect-video">
        <img
          src="@/assets/suite-bathroom.png"
          style="width: 80px; width: 40px; object-fit: contain"
          alt=""
        />
      </div>
      <div class="flex-c gap-2">
        <div class="blue text-center font-medium md:text-start">Bathroom</div>
        <div class="blue text-center md:text-start">
          {{ suiteData.number_of_bathroom }} bathroom
        </div>
      </div>
    </div>
  </div>
  <div
    class="hidden md:grid grid-cols-2 gap-4 w-full mb-8"
    v-if="selectedOption == 'facilities'"
  >
    <li
      v-for="facility in faciilities"
      :key="facility"
    >
      {{ facility }}
    </li>
  </div>
  <div class="flex-c mb-8 md:hidden">
    <div
      :class="['grid-otp', 'flex-r', 'items-center', 'blue', 'gap-2', 'border-bottom-blue', 'mb-8']"
      @click="selectOption('features')"
    >
      FEATURES
    </div>
    <div class="grid md:hidden grid-cols-2 md:grid-cols-2 gap-4 w-full">
      <div class="flex flex-col md:flex-row items-center">
        <div class="flex items-center justify-center w-20 aspect-video">
          <img
            src="@/assets/suite-bed.png"
            style="width: 80px; width: 40px; object-fit: contain"
            alt=""
          />
        </div>
        <div class="flex-c gap-2">
          <div class="blue font-medium text-center md:text-start">BedS</div>
          <div class="blue text-center md:text-start">
            {{ suiteData.bed_number }} twin/double bed
          </div>
        </div>
      </div>

      <div class="flex flex-col md:flex-row items-center">
        <div class="flex items-center justify-center w-20 aspect-video">
          <img
            src="@/assets/suite-occupie.png"
            style="width: 80px; width: 40px; object-fit: contain"
            alt=""
          />
        </div>
        <div class="flex-c gap-2">
          <div class="blue text-center font-medium md:text-start">Max Occupancy</div>
          <div class="blue text-center md:text-start">
            <p>{{ suiteData.number_of_adult }} adults</p>
            <p>{{ suiteData.number_of_children }} children under 5</p>
          </div>
        </div>
      </div>
      <div class="flex flex-col md:flex-row items-center">
        <div class="flex items-center justify-center w-20 aspect-video">
          <img
            src="@/assets/suite-size.png"
            style="width: 80px; width: 40px; object-fit: contain"
            alt=""
          />
        </div>
        <div class="flex-c gap-2">
          <div class="blue text-center font-medium md:text-start">Size</div>
          <div class="blue text-center md:text-start">
            <p>Suite: {{ suiteData.suite_size }}</p>
            <p>Sundeck: {{ suiteData.sundeck_size }}</p>
            <p>Total: {{ suiteData.suite_size + suiteData.sundeck_size }}</p>
          </div>
        </div>
      </div>
      <div class="flex flex-col md:flex-row items-center">
        <div class="flex items-center justify-center w-20 aspect-video">
          <img
            src="@/assets/suite-bathroom.png"
            style="width: 80px; width: 40px; object-fit: contain"
            alt=""
          />
        </div>
        <div class="flex-c gap-2">
          <div class="blue text-center font-medium md:text-start">Bathroom</div>
          <div class="blue text-center md:text-start">
            {{ suiteData.number_of_bathroom }} bathroom
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="flex-c mb-8 md:hidden">
    <div
      :class="[
        'grid-otp text-xs',
        'flex-r',
        'items-center',
        'blue',
        'gap-2',
        'border-bottom-blue',
        'mb-8',
      ]"
      @click="selectOption('features')"
    >
      FACILITIES
    </div>
    <li
      v-for="facility in faciilities"
      :key="facility"
    >
      {{ facility }}
    </li>
  </div>
</template>

<style lang=""></style>
