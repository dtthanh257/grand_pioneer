<template>
  <div class="service-detail body-custom">
    <div
      class="block p-0 body-custom w-full px-5"
      style="max-width: 1440px"
    >
      <Suspense>
        <VesselServiceDetailComponent :service_id="service_id" />
      </Suspense>
    </div>
  </div>
  <Menu></Menu>
  <Footer></Footer>
</template>
<script>
import Footer from "@/components/Footer.vue";
// import PageLogo from "@/components/PageLogo.vue";
// import CardService from "@/components/CardService.vue";
import Menu from "@/components/Menu.vue";
import VesselServiceDetailComponent from "@/components/vessel_service/VesselServiceDetailComponent.vue";

export default {
  name: "ServiceDetail",
  components: {
    Footer,
    // PageLogo,
    // CardService,
    Menu,
    VesselServiceDetailComponent,
  },
  props: ["id"],
  computed: {
    service_id() {
      return this.$route.params.id;
    },
  },
};
</script>
