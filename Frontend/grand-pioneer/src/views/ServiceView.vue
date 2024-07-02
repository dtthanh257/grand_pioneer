<template>
  <div class="service-view body-custom">
    <div
      class="block p-0 body-custom w-full px-5"
      style="max-width: 1440px"
    >
      <div class="flex flex-col items-center gap-8">
        <PageLogo></PageLogo>
        <div class="blue text-lg md:text-xl">SERVICES</div>
        <div class="blue text-4xl md:text-5xl text-center">DISCOVER EXCLUSIVE SERVICES</div>
        <div class="blue w-full text-xs lg:text-base text-center">
          Embark on the unique exclusive journey on the Essence Grand Cruise with its unique
          outlets, where you can savour delectable cuisine from around the world at the Dining by
          the Bay restaurant, indulge in exclusive treats of The Essence Spa, and enjoy handcrafted
          cocktails in stylish Stellar Sky Bar, all while surrounded by breathtaking ocean views.
        </div>
        <div class="flex flex-row justify-center gap-8 w-full mb-8">
          <Button
            button_v="0"
            text="EXPLORE"
          ></Button>
          <Button
            button_v="1"
            text="INQUIRE NOW"
          ></Button>
        </div>
      </div>
      <Suspense>
        <VesselServiceComponent />
      </Suspense>
    </div>
  </div>
  <Menu></Menu>
  <Footer></Footer>
</template>
<script>
import Footer from "@/components/Footer.vue";
import PageLogo from "@/components/PageLogo.vue";
import Button from "@/components/Button.vue";
import Menu from "@/components/Menu.vue";
import VesselServiceComponent from "@/components/vessel_service/VesselServiceComponent.vue";

export default {
  name: "ServiceView",
  components: {
    Footer,
    PageLogo,
    Button,
    VesselServiceComponent,
    Menu,
  },
  data() {
    return {
      selectedOption: "grid",
    };
  },
  methods: {
    selectOption(option) {
      this.selectedOption = option;
    },
  },
};
</script>
<style scoped>
.selected {
  font-weight: bold;
  border-bottom: 2px solid var(--blue-color);
}
</style>
