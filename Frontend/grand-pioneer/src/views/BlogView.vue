<template>
  <div class="blog-view block p-0 w-full px-5 body-custom mb-10 mt-2" style="max-width: 1440px">
    <div class="flex-c items-center gap-8 px-5 mb-8">
      <PageLogo></PageLogo>
      <div class="blue text-lg md:text-xl text-center">TRAVEL GUIDE</div>
      <div class="blue text-4xl md:text-5xl text-center">NEWS & TRAVEL BLOGS</div>
    </div>
    <Suspense>
      <PostAllCardComponent />
    </Suspense>
  </div>
  <Menu></Menu>
  <Footer></Footer>
</template>
<script>
import Footer from "@/components/Footer.vue";
import PageLogo from "@/components/PageLogo.vue";
import Menu from "@/components/Menu.vue";
import PostAllCardComponent from "@/components/post/PostAllCardComponent.vue";

export default {
  name: "BlogView",
  components: {
    Footer,
    PageLogo,
    Menu,
    PostAllCardComponent,
  },
};
</script>
