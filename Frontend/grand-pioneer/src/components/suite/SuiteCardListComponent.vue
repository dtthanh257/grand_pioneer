<template>
  <div class="card-list flex flex-row">
    <div class="flex flex-col items-center justify-center">
      <div
        class="card-list-img bg-cover h-96"
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
          {{ bed_number }} Twin/Double beds
        </div>
        <div
          class="card-heading__1 text-xs md:text-base blue pb-3"
          style="font-weight: 400"
        >
          Suite: {{ suite_size }}m² (+ {{ sundeck_size }}m² sundeck)
        </div>
        <div
          class="card-heading__1 text-xs md:text-base blue pb-3"
          style="font-weight: 400"
        >
          Max Occupancy: {{ number_of_adult }} adults and {{ number_of_children }} childrens under 5
        </div>
        <div
          class="card-heading__1 blue pb-5 text-xs md:text-base"
          style="font-weight: 400"
        >
          FROM ${{ price }} USD PER SUITE
        </div>
      </div>
      <div class="flex flex-row gap-4 mt-10">
        <Button
          button_v="0"
          text="EXPLORE"
          @click="redirectTo(suite_id)"
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

const SuiteCardComponent = {
  props: {
    card_title: {
      type: String,
    },
    bed_number: {
      type: Number,
    },
    suite_size: {
      type: Number,
    },
    sundeck_size: {
      type: Number,
    },
    imgUrl: {
      type: String,
    },
    number_of_adult: {
      type: Number,
    },
    number_of_children: {
      type: Number,
    },
    price: {
      type: Number,
    },
    suite_id: {
      type: Number,
    },
  },
  components: {
    Button,
  },
  methods: {
    redirectTo(id) {
      this.$router.push("/suite-detail/" + id).then(() => {
        window.location.reload();
      });
    },
  },
};
export default SuiteCardComponent;
</script>
<style>
.card-list-img {
  max-height: 590px;
  width: 100%;
  aspect-ratio: 6/5;
}

.card-list {
  width: 100%;
  background-color: #f5f5f5;
}
</style>
