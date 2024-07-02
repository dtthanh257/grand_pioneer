<template>
  <div class="card flex flex-col">
    <div class="flex flex-col">
      <div
        class="card-img bg-cover"
        :style="{ 'background-image': 'url(' + imgUrl + ')' }"
      ></div>
    </div>
    <div class="p-9 flex flex-col justify-between h-full">
      <div
        class="card-title blue"
        style="font-size: 20px"
      >
        {{ card_title }}
      </div>

      <div class="flex flex-col">
        <div
          class="card-heading__1 text-xs md:text-base blue pt-12 pb-3"
          style="font-weight: 400"
        >
          {{ day }}
        </div>
        <div
          class="card-heading__1 text-xs md:text-base blue pb-3"
          style="font-weight: 400"
        >
          {{ fare }}
        </div>
        <div
          class="card-heading__1 blue pb-5 text-xs md:text-base"
          style="font-weight: 400"
        >
          {{ time }}
        </div>
      </div>
      <div class="flex flex-row gap-4 mt-10">
        <Button
          button_v="0"
          text="EXPLORE"
          @click="redirectTo(voyage_id)"
        ></Button>
        <Button
          button_v="1"
          text="INQUIRE NOW"
        ></Button>
      </div>
    </div>
  </div>
</template>

<script>
import Button from "@/components/Button.vue";

const CardVoyage = {
  props: {
    card_title: {
      type: String,
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
    imgUrl: {
      type: String,
    },
    voyage_id: {
      type: Number,
    },
  },
  components: {
    Button,
  },

  methods: {
    redirectTo(id) {
      this.$router.push("/voyage-view/" + id).then(() => {
        window.location.reload();
      });
    },
  },
};

export default CardVoyage;
</script>
