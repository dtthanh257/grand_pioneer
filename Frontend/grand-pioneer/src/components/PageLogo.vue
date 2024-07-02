<template>
  <div :style="backgroundImageStyle" class="page-logo cursor-pointer" @click="this.$router.push('/')"></div>
</template>

<script>
export default {
  name: "PageLogo",
  props: {
    logoType: {
      type: Number,
      default: 0,
    },
  },
  computed: {
    backgroundImageStyle() {
      let imageUrl = "";
      switch (this.logoType) {
        case 1:
          imageUrl = require("@/assets/logo1.png");
          break;
        case 2:
          imageUrl = require("@/assets/logo2.png");
          break;
        case 3:
          imageUrl = require("@/assets/logo3.png");
          break;
        default:
          imageUrl = require("@/assets/logo1.png");
      }
      return {
        backgroundImage: `url(${imageUrl})`,
      };
    },
  },
};
</script>

<style>
.page-logo {
  width: 12%;
  aspect-ratio: 1 !important;
  margin-top: 20px;
  background-size: cover !important;
  background-repeat: no-repeat;
}
</style>
