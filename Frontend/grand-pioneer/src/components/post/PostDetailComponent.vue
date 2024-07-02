<template>
  <div
    class="h-40 md:h-96 lg:h-screen w-full bg-cover mb-8"
    :style="{ backgroundImage: `url(${postData.thumbnail})` }"
  >
    <Blur class="hidden lg:block"></Blur>
    <div class="page-contain flex-c hidden lg:flex">
      <PageLogo :logo-type="3"></PageLogo>
      <div class="page-heading__title uppercase">
        <div class="text-white text-4xl md:text-5xl text-center">ABOUT US</div>
        <div
          class="text-white items-center justify-center w-full flex text-xs md:text-base mt-5 mb-4"
        >
          <div class="w-3/4 text-center">
            Essence Grand Cruise - the greenest, safest and the most modern cruise in Halong Bay -
            the masterpiece created by Vietnamese strength and intelligence.
          </div>
        </div>
      </div>
    </div>
  </div>
  <div
    class="grid grid-cols-1 px-5 p-0 gap-10 body-custom mb-10"
    style="max-width: 1440px"
  >
    <div class="flex flex-col">
      <div class="blue text-4xl md:text-5xl text-center md:text-start mb-8">
        {{ postData.title }}
      </div>
      <div class="blue">
        {{ postData.description }}
      </div>
      <div
        class="blue flex flex-col my-6"
        v-for="(item, index) in postData.post_sections"
        :key="index"
      >
        <div class="section flex flex-col">
          <div
            class="blue font-medium mb-3"
            v-html="item.section_name"
          ></div>
          <div
            class="blue mb-3"
            v-html="item.content"
          ></div>
          <div class="flex flex-col justify-center items-center">
            <div
              class="h-40 md:h-96 lg:h-screen w-full bg-cover mb-3"
              :style="{ backgroundImage: `url(${item.image_link})` }"
            ></div>
            <div
              class="blue mb-3"
              v-html="item.image_name"
            ></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import PageLogo from "@/components/PageLogo.vue";
import Blur from "@/components/Blur.vue";
import PostService from "@/services/post.service";
import { defineProps } from "vue";

const props = defineProps({
  post_id: {
    type: Number,
  },
});

let postData = { post_sections: [] };
try {
  const post = await PostService.getDataById(props.post_id);
  postData = post.data.data.post;
} catch (err) {
  console.log(err);
}
</script>
<style></style>
