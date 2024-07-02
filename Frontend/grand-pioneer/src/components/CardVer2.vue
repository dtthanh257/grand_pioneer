<template>
  <div
    class="card-ver-2 flex-c gap-4 pb-4"
    :style="{ width: width + '%', height: height + '%', gap: gap + '%' }"
  >
    <div
      class="card-img bg-cover"
      :style="{ 'background-image': 'url(' + imgUrl + ')' }"
    ></div>
    <div class="card-title text-xl blue mx-4">
      {{ card_title }}
    </div>
    <div class="card-date blue text-xs md:text-base mx-4">
      {{ card_date }}
    </div>
    <div class="mx-4 text-xs md:text-base blue">
      {{ card_date_availeble }}
    </div>
    <div class="mx-4 blue text-xs md:text-base">
      {{ card_descr }}
    </div>
    <div class="mx-4 blue text-xs md:text-base">
      {{ card_fare }}
    </div>
    <div class="mx-4 flex-r gap-4">
      <Button
        button_v="0"
        text="EXPLORE"
        width="43"
      ></Button>
      <Button
        button_v="1"
        text="INQUIRE NOW"
        width="43"
      ></Button>
    </div>
  </div>
</template>
<script>
import Button from "./Button.vue";
export default {
  name: "CardVer2",
  components: {
    Button,
  },
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
    width: {
      type: Number,
      default: 50,
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
    date: {
      type: Boolean,
      default: true,
    },
    type: {
      Boolean,
      default: true,
    },
  },
};
</script>
<style>
.card-ver-2 {
  background-color: #f5f5f5;
}
</style>
