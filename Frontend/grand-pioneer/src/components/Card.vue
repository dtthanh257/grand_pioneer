<template>
  <div
    class="card flex-c"
    :style="{ width: width + '%', height: height + '%', gap: gap + '%', aspectRatio: ap }"
  >
    <div class="flex-c">
      <div
        class="card-img bg-cover"
        :style="{ 'background-image': 'url(' + imgUrl + ')' }"
      ></div>
    </div>

    <div class="card-title blue">
      {{ card_title }}
    </div>
    <div
      class="card-heading__1 blue"
      v-if="card_v2 && !card_mobie"
    >
      {{ card_heading_1 }}
    </div>
    <div
      class="card-descr blue"
      v-if="!card_mobie"
    >
      {{ card_descr }}
    </div>
    <div
      class="flex-c"
      v-if="card_mobie && !card_mobie_v2"
      style="margin: 3vw 0; gap: 4vw"
    >
      <div class="card-heading__1 blue">
        {{ day }}
      </div>
      <div class="card-heading__1 blue">
        {{ fare }}
      </div>
      <div class="card-heading__1 blue">
        {{ time }}
      </div>
    </div>
    <div
      class="card-descr blue"
      v-if="card_mobie && card_mobie_v2"
    >
      {{ card_descr }}
    </div>
    <div class="flex flex-row gap-4 card-button">
      <Button
        button_v="0"
        text="EXPLORE"
      ></Button>
      <Button
        button_v="1"
        text="INQUIRE NOW"
      ></Button>
    </div>
    <div
      class="flex-r jc-sb card-button"
      v-if="!card_v2 && !card_mobie"
    >
      <Button
        button_v="1"
        text="EXPLORE MORE"
      ></Button>
    </div>
  </div>
</template>
<script>
import Button from "@/components/Button.vue";
const Card = {
  props: {
    width: {
      type: Number,
      default: 30,
    },
    height: {
      type: Number,
      default: 100,
    },
    gap: {
      type: Number,
      default: 100,
    },
    ap: {
      type: Number,
      default: 100,
    },
    imgUrl: {
      type: String,
    },
    card_title: {
      type: String,
    },
    card_heading_1: {
      type: String,
    },
    card_descr: {
      type: String,
    },
    card_v2: {
      type: Boolean,
      default: true,
    },
    card_mobie: {
      type: Boolean,
      default: false,
    },
    day: {
      type: String,
    },
    fare: {
      type: String,
    },
    time: {
      type: String,
    },
    card_mobie_v2: {
      type: String,
      default: false,
    },
  },
  components: {
    Button,
  },
};
export default Card;
</script>
<style></style>
