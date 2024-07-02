<template>
  <div class="voyage-view body-custom">
    <div
      class="block p-0 body-custom w-full px-5"
      style="max-width: 1440px"
    >
      <Suspense>
        <VoyageDetailComponent :voyage_id="voyage_id" />
      </Suspense>
    </div>
  </div>
  <Menu></Menu>
  <Footer></Footer>
</template>

<script>
import Footer from "@/components/Footer.vue";
import Menu from "@/components/Menu.vue";
import VoyageDetailComponent from "@/components/voyage/VoyageDetailComponent.vue";
export default {
  name: "VoyageView",
  components: {
    Footer,
    Menu,
    VoyageDetailComponent,
  },
  data() {
    return {};
  },
  methods: {},
  props: ["id"],
  computed: {
    voyage_id() {
      return this.$route.params.id;
    },
  },
};
</script>

<style scoped>
.day-item {
  cursor: pointer;
}

.day-item .rotate {
  transition: transform 0.3s;
  transform: rotate(180deg);
}

.active {
  border-bottom: 1px solid black;
}

.details {
  transition: max-height 0.3s ease-out;
  overflow: hidden;
}

.details.open {
  max-height: 1000px;
  /* Adjust as needed */
}

.voyage-detail-container {
  max-height: 60vh;
  overflow-y: auto;
}
</style>
