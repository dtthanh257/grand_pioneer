<template>
  <div class="about-us">
    <Suspense>
      <PostDetailComponent :post_id="post_id" />
    </Suspense>
    <Menu></Menu>
    <Footer></Footer>
  </div>
</template>
<script>
import Footer from "@/components/Footer.vue";
import Menu from "@/components/Menu.vue";
import PostDetailComponent from "@/components/post/PostDetailComponent.vue";

export default {
  name: "BlogDetail",
  components: {
    Footer,
    Menu,
    PostDetailComponent,
  },
  props: ["id"],
  computed: {
    post_id() {
      return this.$route.params.id;
    },
  },
};
</script>
