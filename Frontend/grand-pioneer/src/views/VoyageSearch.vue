<template>
  <div class="voyage-search">
    <div
      class="search-contain body-custom px-5 p-0 mb-10"
      style="max-width: 1440px"
    >
      <Suspense>
        <VoyageSearchComponent />
      </Suspense>
    </div>
    <Menu></Menu>
    <Footer></Footer>
  </div>
</template>

<script>
import Footer from "@/components/Footer.vue";
// import Card from "@/components/Card.vue";
import Menu from "@/components/Menu.vue";
import VoyageSearchComponent from "@/components/voyage/VoyageSearchComponent.vue";

export default {
  name: "VoyageSearch",
  components: {
    Footer,
    Menu,
    VoyageSearchComponent,
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style scoped>
.selected {
  font-weight: bold;
  border-bottom: 2px solid var(--blue-color);
}
</style>
