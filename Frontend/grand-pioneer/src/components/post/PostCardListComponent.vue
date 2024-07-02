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
        class="card-title blue pb-4 mb-4"
        style="font-size: 20px"
      >
        {{ card_title }}
      </div>

      <div class="flex flex-col">
        <div
          class="card-heading__1 blue pb-5 text-xs md:text-base"
          style="font-weight: 400"
        >
          {{ card_descr }}
        </div>
      </div>
      <div class="flex flex-row gap-4 mt-10">
        <Button
          button_v="1"
          text="EXPLORE"
          @click="redirectTo(post_id)"
        ></Button>
      </div>
    </div>
  </div>
</template>
<script>
import Button from "@/components/Button.vue";

const PostCardListComponent = {
  props: {
    card_title: {
      type: String,
    },
    imgUrl: {
      type: String,
    },
    card_descr: {
      type: String,
    },
    post_id: {
      type: Number,
    },
  },
  components: {
    Button,
  },
  methods: {
    redirectTo(id) {
      this.$router.push("/blog-detail/" + id).then(() => {
        window.location.reload();
      });
    },
  },
};
export default PostCardListComponent;
</script>
<style></style>
