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
        class="card-title blue pb-4 border-bottom-blue mb-4"
        style="font-size: 20px"
      >
        {{ card_title }}
      </div>

      <div class="flex flex-col">
        <div
          class="card-heading__1 blue mb-5 text-xs lg:text-base line-clime-4"
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

const CardPost = {
  props: {
    card_title: {
      type: String,
    },
    card_descr: {
      type: String,
    },
    imgUrl: {
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

export default CardPost;
</script>
<style>
.line-clime-4 {
  display: -webkit-box;
  -webkit-line-clamp: 4;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
