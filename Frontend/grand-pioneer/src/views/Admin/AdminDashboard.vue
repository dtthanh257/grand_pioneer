<template>
  <div class="admin-dashboard">
    <div
      class="h-screen w-40 flex-c float-left"
      style="background-color: var(--blue-color)"
    >
      <div class="w-40">
        <img
          src="./../../assets/logo4.png"
          alt="Logo"
        />
      </div>
      <div
        class="white md:text-xs lg:text-base px-5 dashboard-item"
        :class="{ active: activeComponent == 'UserPortal' }"
        @click="showComponent('UserPortal')"
      >
        User
      </div>
      <div
        class="white md:text-xs lg:text-base px-5 dashboard-item"
        :class="{ active: activeComponent == 'VesselPortal' }"
        @click="showComponent('VesselPortal')"
      >
        Vessels
      </div>
      <div
        class="white md:text-xs lg:text-base px-5 dashboard-item"
        :class="{ active: activeComponent == 'VoyagePortal' }"
        @click="showComponent('VoyagePortal')"
      >
        Voyages
      </div>
      <div
        class="white md:text-xs lg:text-base px-5 dashboard-item"
        :class="{ active: activeComponent == 'SuitePortal' }"
        @click="showComponent('SuitePortal')"
      >
        Suites
      </div>
      <div
        class="white md:text-xs lg:text-base px-5 dashboard-item"
        :class="{ active: activeComponent == 'ServicePortal' }"
        @click="showComponent('ServicePortal')"
      >
        Services
      </div>
      <div
        class="white md:text-xs lg:text-base px-5 dashboard-item"
        :class="{ active: activeComponent == 'BlogPortal' }"
        @click="showComponent('BlogPortal')"
      >
        Blogs
      </div>
      <!-- <div
        class="white md:text-xs lg:text-base px-5 dashboard-item"
        :class="{ active: activeComponent == 'AboutUsPortal' }"
        @click="showComponent('AboutUsPortal')"
      >
        About us
      </div> -->
    </div>
    <div class="dashboard-info float-right">
      <keep-alive>
        <component :is="activeComponent"></component>
      </keep-alive>
    </div>
  </div>
</template>
<script>
import UserPortal from "@/views/Admin/Tables/UserPortal.vue";
import VesselPortal from "@/views/Admin/Tables/VesselPortal.vue";
import SuitePortal from "@/views/Admin/Tables/SuitePortal.vue";
import ServicePortal from "@/views/Admin/Tables/ServicePortal.vue";
import VoyagePortal from "@/views/Admin/Tables/VoyagePortal.vue";
import ActivityPortal from "./Tables/ActivityPortal.vue";
import BlogPortal from "./Tables/BlogPortal.vue";
export default {
  name: "AdminDashboard",
  data() {
    return {
      activeComponent: "UserPortal",
    };
  },
  components: {
    UserPortal,
    VesselPortal,
    SuitePortal,
    ServicePortal,
    VoyagePortal,
    ActivityPortal,
    BlogPortal,
  },
  methods: {
    showComponent(componentName) {
      this.activeComponent = componentName;
    },
  },
};
</script>
<style scoped>
.dashboard-item {
  padding: 12px 20px;
  cursor: pointer;
}

.dashboard-item:hover {
  background-color: #ccc;
}

.active {
  font-weight: bold;
  background-color: var(--yellow-color);
}

.dashboard-info {
  width: calc(100% - 160px);
  max-height: 100vh;
  overflow-y: scroll;
}
</style>
