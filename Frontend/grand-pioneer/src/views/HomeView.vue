<template>
  <div class="home">
    <!-- <Navbar></Navbar> -->
    <div class="h-screen w-full bg-cover" :style="{ backgroundImage: `url(${require('@/assets/home-img.jpg')})` }">
      <Blur></Blur>
      <div class="page-contain flex flex-col items-center" style="gap:16%">
        <PageLogo :logo-type="3"></PageLogo>
        <div class="text-4xl md:text-5xl uppercase overflow-hidden flex-c gap-10 items-center">
          <div class="flex-row justify-center items-center white text-wrap text-center">
            {{ $t("homeTitle") }}
          </div>
          <div class="text-white w-3/4 text-center text-wrap text-xs md:text-base mt-5 mb-4 overflow-hidden">
            <p>{{ $t("homeDescr") }}</p>
          </div>
        </div>

        <!-- <div class="flex-r gap-4 jc-sb pb-8 px-5 md:flex hidden">
          <ComboboxV2
            isV3="true"
            fetchValue="DESTINATION"
            :items="options"
          ></ComboboxV2>
          <ComboboxV2
            isV3="true"
            fetchValue="CHECK IN - CHECK OUT"
          ></ComboboxV2>
          <ComboboxV2
            isV3="true"
            fetchValue="GUEST & ROOM"
          ></ComboboxV2>
          <ComboboxV2
            isV3="true"
            fetchValue="CHECK RATE"
          ></ComboboxV2>
        </div> -->
      </div>
    </div>
    <!-- <div class="flex flex-col gap-4 justify-between px-5 md:hidden mt-4">
      <Combobox
        :white="false"
        isV3="true"
        fetchValue="DESTINATION"
      ></Combobox>
      <Combobox
        :white="false"
        isV3="true"
        fetchValue="CHECK IN - CHECK OUT"
      ></Combobox>
      <Combobox
        :white="false"
        isV3="true"
        fetchValue="GUEST & ROOM"
      ></Combobox>
      <Combobox
        :white="false"
        isV3="true"
        fetchValue="CHECK RATE"
      ></Combobox>
    </div> -->
    <div class="block p-0 body-custom w-full px-5" style="max-width: 1440px">
      <div class="flex flex-col mt-20 mb-10">
        <div class="blue py-7 text-center text-2xl md:text-3xl md:text-start xl:mb-6">
          {{ $t("voyages.title") }}
        </div>
        <!-- Voyage Section -->
        <Suspense>
          <VoyageComponent />
        </Suspense>
      </div>
      <!-- Suites Section -->
      <Suspense>
        <SuiteComponent />
      </Suspense>
      <!-- Service Section -->
      <div class="xl:h-screen xl:w-full mt-20 mb-10">
        <Suspense>
          <VesselServiceHomeComponent />
        </Suspense>
      </div>
      <!-- Activities Section -->
      <div class="xl:h-screen xl:w-full mt-20 mb-10">
        <Suspense>
          <ActivityHomeComponent />
        </Suspense>
      </div>
      <!-- Innovation Section -->
      <div class="xl:h-screen xl:w-full innovation-bg bg-cover mt-20 mb-10">
        <div class="flex-c innovation-contain items-center xl:items-start xl:p-9">
          <div class="flex-r">
            <div class="yellow saol-light text-4xl mt-3 md:text-5xl text-center xl:text-start">
              <p class="overflow-hidden text-wrap">
                {{ $t("innovation.titleNor") + $t("innovation.titleItalic") }}
              </p>
            </div>
          </div>
          <div class="innovation-desc yellow mt-4 text-xs md:text-base text-center xl:text-start w-full xl:w-1/2">
            <p>{{ $t("innovation.descr") }}</p>
          </div>
          <div class="innovation mt-12">
            <Button text="LEARN MORE" button_v="0">
            </Button>
          </div>
        </div>
      </div>
      <!-- Travel Section -->
      <div class="mt-20 mb-10">
        <div class="flex flex-col">
          <div class="blue text-center text-lg md:text-xl md:text-start">TRAVEL GUIDE</div>
          <div class="flex flex-col md:flex-row items-center">
            <div class="flex flex-row flex-1">
              <div class="flex flex-col">
                <div class="flex flex-row">
                  <div class="blue text-4xl mt-3 md:mt-0 md:text-5xl text-center md:text-start">
                    <p class="overflow-hidden text-wrap">
                      {{ $t("blog.titleNor") + $t("blog.titleItalic") }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex-1 blue text-center md:text-start text-xs md:text-base font-normal my-4">
              {{ $t("blog.descr") }}
            </div>
          </div>
          <Suspense>
            <PostCardComponent />
          </Suspense>
        </div>
      </div>

      <!-- Guest's Review Section -->
      <div class="xl:h-fit xl:w-full mt-20 mb-10">
        <div class="blue text-center text-lg md:text-xl md:text-start xl:mb-10">GUEST’S REVIEW</div>
        <div class="flex" style="justify-content: center">
          <div class="flex-c page-name">
            <div class="blue text-4xl mt-3 md:mt-0 md:text-5xl text-center overflow-hidden">
              {{ $t("review.title") }}
            </div>
          </div>
        </div>
        <div class="flex flex-row items-center justify-center text-center gap-5 mt-10">
          <button class="prevBtn h-8 w-8 md:h-10 md:w-10"></button>
          <div class="slide-counter blue" id="slideCounter">
            1 of 3
          </div>
          <button class="nextBtn h-8 w-8 md:h-10 md:w-10"></button>
        </div>
        <div class="flex flex-row items-center justify-between my-6">
          <div class="flex flex-col items-center">
            <div class="blue text-center md:text-start text-xs md:text-base font-normal mb-4 w-full xl:w-1/2">
              “This trip gave us an unforgettable memory of a beautiful sunset on the cruise.
              Especially Mr. Nyi, who is the best friend who served us very well. We enjoyed it a
              lot. I wish to come back with my father and mother again next year. ”
            </div>
            <div class="font-bold blue">Kim B - Tripadvisor</div>
          </div>
        </div>
      </div>
    </div>

    <Footer></Footer>
    <Menu class="top-0"></Menu>
  </div>
</template>

<script>
// import Navbar from "@/components/Navbar.vue";
import Blur from "@/components/Blur.vue";
import PageLogo from "@/components/PageLogo.vue";
// import Combobox from "@/components/Combobox.vue";
import Button from "@/components/Button.vue";
import Footer from "@/components/Footer.vue";
import Menu from "@/components/Menu.vue";
// import CardNews from "@/components/CardNews.vue";
// import ComboboxV2 from "../components/ComboboxV2.vue";
import VoyageComponent from "@/components/voyage/VoyageComponent.vue";
import SuiteComponent from "@/components/suite/SuiteComponent.vue";
import VesselServiceHomeComponent from "@/components/vessel_service/VesselServiceHomeComponent.vue";
import ActivityHomeComponent from "@/components/activity/ActivityHomeComponent.vue";
import PostCardComponent from "@/components/post/PostCardComponent.vue";

export default {
  name: "HomeView",
  data() {
    return {
      options: ["Hạ Long", "Sung Sot Cave", "Hà Nội"],
    };
  },
  components: {
    Blur,
    PageLogo,
    // Combobox,
    Button,
    Footer,
    // Navbar,
    Menu,
    VoyageComponent,
    // CardNews,
    // ComboboxV2,
    SuiteComponent,
    VesselServiceHomeComponent,
    ActivityHomeComponent,
    PostCardComponent,
  },
};
</script>
