<template>
  <div class="card flex flex-col h-fit">
    <div class="flex flex-col">
      <div
        class="card-img bg-cover"
        :style="{ 'background-image': 'url(' + imgUrl + ')' }"
      ></div>
    </div>
    <div class="p-9 flex flex-col justify-between">
      <div class="card-title blue text-xl">
        {{ card_title }}
      </div>

      <div class="card-descr blue text-wrap mt-8 mb-4 text-xs md:text-base">
        {{ card_description }}
      </div>

      <div class="flex flex-row mt-10">
        <Button
          button_v="1"
          style="font-size: 12px"
          text="Explore more"
        ></Button>
      </div>
    </div>
  </div>
</template>

<script>
import Button from "@/components/Button.vue";

const CardNews = {
  props: {
    card_title: {
      type: String,
    },
    card_description: {
      type: String,
    },
    imgUrl: {
      type: String,
    },
  },
  components: {
    Button,
  },
};

export default CardNews;
</script>

<style></style>
