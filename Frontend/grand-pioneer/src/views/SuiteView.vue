<template>
  <div class="suite-view">
    <div class="w-full h-screen bg-cover mb-8" :style="{ backgroundImage: `url(${require('@/assets/home-img.jpg')})` }">
      <Blur></Blur>

      <div class="flex-c items-center h-screen" style="gap:16%">
        <PageLogo :logoType="3" style="z-index: 100 !important"></PageLogo>
        <div class="flex-c gap-8 items-center">
          <div class="flex-c items-center">
            <div class="text-4xl md:text-5xl uppercase overflow-hidden z-20">
              <div class="flex-row justify-center items-center white text-wrap text-center">
                EXPLORE OUR WORLD-CLASS SUITES
              </div>
            </div>
          </div>
          <div class="text-white w-3/4 text-center text-wrap text-xs md:text-base mt-5 mb-4 overflow-hidden z-20">
            The magnificient Essence Grand Halong Bay Cruise exudes an imposing, proudly elegant
            beauty. With a length of 110m and a main deck area extending to 2000m2, the cruise
            boasts 55 rooms, each offering a view of the heritage bay. Particularly, the Owner Suite
            spans an impressive 150m2 and comes with the exclusive privilege of a private 200m2
            sundeck. The design of each room exudes classy and sophistication, paying meticulous
            attention to every small detail, offering affluent travelers a truly special getaway.
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col p-0 items-center gap-8 mb-8 body-custom px-5" style="max-width: 1440px">
      <div class="blue text-lg md:text-xl">SUITES</div>
      <div class="blue text-4xl md:text-5xl">ROOMS & SUITES</div>
      <div class="blue text-xs lg:text-base text-center w-full">
        <p>
          Surrounded by pristine natural wonders and the crystal blue waters of the bay, every suite
          on the Grand Pioneers cruise is a perfect place for healing. The rooms feature a modern
          design, emphasising the harmony between humans and nature, and stand out with panoramic
          views of the Heritage Bay, such as in the President Suite or Oceania Suite.
        </p>
      </div>
      <Suspense>
        <AllSuiteComponent />
      </Suspense>
    </div>
    <Menu></Menu>
    <Footer></Footer>
  </div>
</template>
<script>
import Footer from "@/components/Footer.vue";
import PageLogo from "@/components/PageLogo.vue";
import Blur from "@/components/Blur.vue";
import Menu from "@/components/Menu.vue";
import AllSuiteComponent from "@/components/suite/AllSuiteComponent.vue";

export default {
  name: "SuiteView",
  components: {
    Blur,
    // CardVer2,
    Footer,
    // Combobox,
    // CardList,
    PageLogo,
    Menu,
    // CardService,
    AllSuiteComponent,
  },
  data() {
    return {
      selectedOption: "grid",
      detail: [
        "Twin/Double bed",
        "Suite: 150m² (+ 200m² sundeck)",
        "Front View",
        "3rd floor",
        "Max Occupancy: 04 adults and 02 children under 5",
      ],
    };
  },
  methods: {},
};
</script>
