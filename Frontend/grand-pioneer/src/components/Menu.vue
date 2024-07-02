<template>
  <!-- Menu PC -->
  <div :class="['menu-contain hidden md:flex lg:flex', { 'menu-open': menuOpen }]">
    <div class="menu" @click="toggleMenu">
      <font-awesome-icon :icon="['fas', 'bars']" style="color: #ffffff" />
      <span>{{ menuOpen ? "CLOSE" : "MENU" }}</span>
    </div>
  </div>
  <div v-if="menuOpen" class="menu-pc shadow-lg lg:max-h-screen sm:max-h-[1024px] overflow-auto z-100">
    <div class="flex flex-col h-full justify-between">
      <div class="sign-in flex-r lg:gap-3 lg:items-center jc-sb uppercase">
        <div class="menu-signin flex-r gap-3 items-center">
          <div class="sign-in-img bg-contain"></div>
          {{ $t("signIn.title") }}
        </div>
        <!-- <div class="voyage-finder" @click="redirectToVoyageSearch">
          {{ $t("menu.voyageFinder") }}
        </div> -->
        <Navbar v-model="language" :options="languageOptions" @input="changeLanguage"></Navbar>
      </div>
      <ul class="uppercase">
        <li @click="redirectToHome">
          <div class="flex-r gap-2 items-center">
            <div class="bg-white rounded-full w-1 h-1 dot" v-if="isActive('home')"></div>
            {{ $t("menu.home") }}
          </div>
        </li>
        <li @click="redirectToSuites">
          <div class="flex-r gap-2 items-center">
            <div class="bg-white rounded-full w-1 h-1 dot" v-if="isActive('suite-view')"></div>
            {{ $t("menu.suites") }}
          </div>
        </li>

        <li @click="redirectToVoyageSearch">
          <div class="flex-r gap-2 items-center">
            <div class="bg-white rounded-full w-1 h-1 dot" v-if="isActive('voyage-search')"></div>
            {{ $t("menu.voyageFinder") }}
          </div>
        </li>

        <li @click="redirectToServices">
          <div class="flex-r gap-2 items-center">
            <div class="bg-white rounded-full w-1 h-1 dot" v-if="isActive('service-view')"></div>
            {{ $t("menu.service") }}
          </div>
        </li>
        <!-- <li @click="redirectToInnovation">
            <div class="flex-r gap-2 items-center">
              <div
                class="bg-white rounded-full w-1 h-1 dot"
                v-if="isActive('innovation-view')"
              ></div>
              {{ $t("menu.innovation") }}
            </div>
          </li> -->
        <li @click="redirectToBlog">
          <div class="flex-r gap-2 items-center">
            <div class="bg-white rounded-full w-1 h-1 dot" v-if="isActive('blog-view')"></div>
            {{ $t("menu.stories") }}
          </div>
        </li>
        <li @click="redirectToAbout">
          <div class="flex-r gap-2 items-center">
            <div class="bg-white rounded-full w-1 h-1 dot" v-if="isActive('about-us')"></div>
            {{ $t("menu.about") }}
          </div>
        </li>
      </ul>
    </div>
  </div>
  <!-- Moblie menu -->
  <div :class="[
    'menu-contain flex lg:hidden md:hidden',
    isOpenMobile ? 'h-full w-full top-0 right-0 bottom-0 rounded-none' : '',
  ]" style="background: rgba(0, 0, 0, 50%); backdrop-filter: blur(20px)">
    <div :class="['menu', { hidden: isOpenMobile }]" @click="toggleOpenMobile">
      <font-awesome-icon :icon="['fas', 'bars']" style="color: #ffffff" />
      {{ "MENU" }}
    </div>

    <div class="relative h-full w-full px-7 pt-16 pb-7" v-if="isOpenMobile">
      <div class="">
        <div class="mb-14 flex-r justify-between">
          <div class="menu-signin flex-r gap-3 text-white items-center h-full">
            <img src="../assets/user-icon.webp" class="h-11" />
            <span class="ml-5 uppercase">{{ $t("signIn.title") }}</span>
          </div>
          <Navbar v-model="language" :options="languageOptions" @input="changeLanguage"></Navbar>

        </div>
        <div class="flex flex-row">
          <div class="w-64">
            <div class="flex flex-row justify-start items-center pb-7" @click="redirectToHome">
              <div class="bg-white rounded-full w-1 h-1 dot" v-if="isActive('home')"></div>
              <div class="text-white" @click="toggleOpenMobile">
                <a class="uppercase ml-2">{{ $t("menu.home") }}</a>
              </div>
            </div>
            <div class="flex flex-row justify-start items-center pb-7" @click="redirectToSuites">
              <div class="bg-white rounded-full w-1 h-1" v-if="isActive('suite-view')"></div>
              <div class="text-white" @click="toggleOpenMobile">
                <a class="uppercase ml-3"> {{ $t("menu.suites") }} </a>
              </div>
            </div>
            <div class="flex flex-row justify-start items-center pb-7" @click="redirectToVoyageSearch">
              <div class="bg-white rounded-full w-1 h-1" v-if="isActive('voyage-search')"></div>
              <div class="text-white" @click="toggleOpenMobile">
                <a class="uppercase ml-3"> {{ $t("menu.voyageFinder") }} </a>
              </div>
            </div>
            <div class="flex flex-row justify-start items-center pb-7" @click="redirectToServices">
              <div class="bg-white rounded-full w-1 h-1" v-if="isActive('service-view')"></div>
              <div class="text-white" @click="toggleOpenMobile">
                <a class="uppercase ml-3"> {{ $t("menu.service") }}</a>
              </div>
            </div>

            <div class="flex flex-row justify-start items-center pb-7" @click="redirectToBlog">
              <div class="bg-white rounded-full w-1 h-1" v-if="isActive('blog-view')"></div>
              <div class="text-white" @click="toggleOpenMobile">
                <a class="uppercase ml-3"> {{ $t("menu.stories") }}</a>
              </div>
            </div>
            <div class="flex flex-row justify-start items-center pb-7" @click="redirectToAbout">
              <div class="bg-white rounded-full w-1 h-1" v-if="isActive('about-us')"></div>
              <div class="text-white" @click="toggleOpenMobile">
                <a class="uppercase ml-3">{{ $t("menu.about") }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="absolute w-full left-0 flex flex-col justify-center items-center bottom-4">
        <button @click="toggleOpenMobile">
          <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd"
              d="M12.0303 12.7374L20.1768 20.8839L20.8839 20.1768L12.7374 12.0303L20.8839 3.88386L20.1768 3.17676L12.0303 11.3232L3.88386 3.17676L3.17676 3.88386L11.3232 12.0303L3.17676 20.1768L3.88386 20.8839L12.0303 12.7374Z"
              fill="white" fill-rule="evenodd"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import { useRoute, useRouter } from "vue-router";
import Navbar from "./Navbar.vue";
import { mapState, mapActions } from 'vuex';

const Menu = {
  components: {
    Navbar
  },
  data() {
    return {
      menuOpen: false,
      isOpenMobile: false,
      languageOptions: [
        { value: 'en', label: 'English', icon: require('@/assets/english.png') },
        { value: 'vi', label: 'Tiếng Việt', icon: require('@/assets/vietnamese.png') }
      ],
    };
  },
  setup() {
    const route = useRoute();
    const router = useRouter();

    const isActive = (name) => {
      return route.name == name;
    };

    const navigateTo = (path) => {
      router.push(path);
    };

    return {
      isActive,
      navigateTo,
    };
  },
  computed: {
    ...mapState(['language']),
  },
  methods: {
    ...mapActions(['changeLanguage']),

    toggleMenu() {
      if (this.menuOpen == false) {
        this.menuOpen = true;
      } else {
        this.menuOpen = false;
      }
    },

    toggleOpenMobile() {
      if (this.isOpenMobile == true) {
        this.isOpenMobile = false;
      } else {
        this.isOpenMobile = true;
      }
    },
    redirectToHome() {
      this.$router.push("/");
    },
    redirectToVoyageSearch() {
      this.$router.push("/voyage-search");
    },
    redirectToSuites() {
      this.$router.push("/suite-view");
    },
    redirectToServices() {
      this.$router.push("/service-view");
    },
    redirectToInnovation() {
      this.$router.push("/innovation-view");
    },
    redirectToBlog() {
      this.$router.push("/blog-view");
    },
    redirectToAbout() {
      this.$router.push("/about-us");
    },
  },
  watch: {
    language(newLang) {
      this.$i18n.locale = newLang; // Cập nhật ngôn ngữ của i18n khi trạng thái ngôn ngữ thay đổi
    },
  },
  created() {
    this.$i18n.locale = this.language; // Thiết lập ngôn ngữ khi component được tạo
  },
};
export default Menu;
</script>
<style scoped>
option {
  background: transparent;
  color: black;
}

select {
  background: transparent;
  color: white;
}
</style>