<template>
  <div class="suite-detail">
    <div
      class="block p-0 body-custom w-full px-5"
      style="max-width: 1440px"
    >
      <Suspense>
        <SuiteDetailComponent :suite_id="suite_id" />
      </Suspense>
    </div>
    <Menu></Menu>
    <Footer></Footer>
  </div>
</template>
<script>
import Footer from "@/components/Footer.vue";
import Menu from "@/components/Menu.vue";
import SuiteDetailComponent from "@/components/suite/SuiteDetailComponent.vue";

export default {
  name: "SuiteDetail",
  components: {
    Footer,
    Menu,
    SuiteDetailComponent,
  },
  data() {
    return {};
  },
  methods: {
    selectOption(option) {
      this.selectedOption = option;
    },
  },
  props: ["id"],
  computed: {
    suite_id() {
      return this.$route.params.id;
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
