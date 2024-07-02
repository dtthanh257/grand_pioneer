<template>
  <div class="card-list flex-r">
    <div
      class="card-list-img bg-cover"
      :style="{
        'background-image': 'url(' + imgUrl + ')',
        width: width + '%',
      }"
    ></div>
    <div class="flex-c justify-around gap-3 py-3 w-full">
      <div class="ml-4 text-xs blue card-title w-full">
        {{ card_title }}
      </div>
      <div
        class="px-4 text-xs blue w-full"
        v-if="date"
      >
        {{ card_date }}
      </div>
      <div
        class="px-4 text-xs blue w-full"
        v-if="date_avai"
      >
        {{ card_date_availeble }}
      </div>
      <div class="px-4 text-xs blue w-full">
        {{ card_descr }}
      </div>
      <div
        class="m-4 text-xs blue w-full"
        v-if="detail"
      >
        <li
          v-for="index in card_detail"
          :key="index"
        >
          {{ index }}
        </li>
      </div>
      <div
        class="px-4 text-xs blue w-full"
        v-if="fare"
      >
        {{ card_fare }}
      </div>
      <div
        class="mx-4 flex-r gap-4"
        v-if="multitask"
      >
        <Button
          button_v="0"
          text="EXPLORE"
          width="30"
        ></Button>
        <Button
          button_v="1"
          text="INQUIRE NOW"
          width="30"
        ></Button>
      </div>
      <div
        class="flex flex-row gap-4 px-4"
        v-if="!multitask"
      >
        <Button
          button_v="1"
          text="EXPLORE"
        ></Button>
      </div>
    </div>
  </div>
</template>
<script>
import Button from "./Button.vue";
export default {
  name: "CardList",
  props: {
    imgUrl: {
      type: String,
    },
    card_title: {
      type: String,
    },
    card_date: {
      type: String,
    },
    card_date_availeble: {
      type: String,
    },
    card_descr: {
      type: String,
    },
    card_fare: {
      type: String,
    },
    card_detail: [],
    date: {
      type: Boolean,
      default: true,
    },
    date_avai: {
      type: Boolean,
      default: true,
    },
    fare: {
      type: Boolean,
      default: true,
    },
    detail: {
      type: Boolean,
      default: false,
    },
    multitask: {
      type: Boolean,
      default: true,
    },
    width: {
      type: Number,
      default: 80,
    },
  },
  components: {
    Button,
  },
};
</script>
<style>
.card-list-img {
  max-height: 590px;
  width: 80%;
  aspect-ratio: 6/5;
}

.card-list {
  width: 100%;
  background-color: #f5f5f5;
}
</style>
