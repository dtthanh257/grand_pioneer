import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import VoyageSearch from "@/views/VoyageSearch.vue";
import VoyageView from "@/views/VoyageView.vue";
import SuiteDetail from "@/views/SuiteDetail.vue";
import SuiteView from "@/views/SuiteView.vue";
import ServiceView from "@/views/ServiceView.vue";
import ServiceDetail from "@/views/ServiceDetail.vue";
import BlogView from "@/views/BlogView.vue";
import CareerView from "@/views/CareerView.vue";
import AboutUs from "@/views/AboutUs.vue";
import InnovationView from "@/views/InnovationView.vue";
import AdminLogin from "@/views/Admin/AdminLogin.vue";
import AdminDashboard from "@/views/Admin/AdminDashboard.vue";
import BlogDetail from "@/views/BlogDetail.vue";
import { getI18n } from "@/main";

const routes = [
  {
    path: "/",
    redirect: { name: "home" },
    meta: { titleKey: "tab.home", requiresAuth: false },
  },
  {
    path: "/home",
    name: "home",
    component: HomeView,
    meta: { titleKey: "tab.home", requiresAuth: false },
  },
  {
    path: "/voyage-search",
    name: "voyage-search",
    component: VoyageSearch,
    meta: { titleKey: "tab.voyagesearch", requiresAuth: false },
  },
  {
    path: "/voyage-view/:id",
    name: "voyage-view",
    component: VoyageView,
    props: true,
    meta: { titleKey: "tab.voyageview", requiresAuth: false },
  },
  {
    path: "/suite-detail/:id",
    name: "suite-detail",
    component: SuiteDetail,
    props: true,
    meta: { titleKey: "tab.suitedetail", requiresAuth: false },
  },
  {
    path: "/suite-view",
    name: "suite-view",
    component: SuiteView,
    meta: { titleKey: "tab.suiteview", requiresAuth: false },
  },
  {
    path: "/service-view",
    name: "service-view",
    component: ServiceView,
    meta: { titleKey: "tab.serviceview", requiresAuth: false },
  },
  {
    path: "/service-detail/:id",
    name: "service-detail",
    component: ServiceDetail,
    props: true,
    meta: { titleKey: "tab.servicedetail", requiresAuth: false },
  },
  {
    path: "/blog-view",
    name: "blog-view",
    component: BlogView,
    meta: { titleKey: "tab.blogview", requiresAuth: false },
  },
  {
    path: "/career-view",
    name: "career-view",
    component: CareerView,
    meta: { titleKey: "tab.careerview", requiresAuth: false },
  },
  {
    path: "/about-us",
    name: "about-us",
    component: AboutUs,
    meta: { titleKey: "tab.aboutus", requiresAuth: false },
  },
  {
    path: "/innovation-view",
    name: "innovation-view",
    component: InnovationView,
    meta: { titleKey: "tab.aboutus", requiresAuth: false },
  },
  {
    path: "/blog-detail/:id",
    name: "blog-detail",
    component: BlogDetail,
    props: true,
    meta: { titleKey: "tab.blogdetail", requiresAuth: false },
  },
  {
    path: "/admin1970",
    redirect: { name: "adminlogin" },
    meta: { titleKey: "Admin | Login", requiresAuth: false },
  },
  {
    path: "/admin1970/login",
    name: "adminlogin",
    component: AdminLogin,
    meta: { titleKey: "Admin | Login", requiresAuth: false },
  },
  {
    path: "/admin1970/dashboard",
    name: "admindashboard",
    component: AdminDashboard,
    meta: { titleKey: "Admin | Dashboard", requiresAuth: true },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const isLoggedIn = !!localStorage.jwt_token;
  const role = localStorage.role;
  const i18n = getI18n(); // Lấy instance i18n từ hàm getI18n

  // Đặt tiêu đề trang dựa trên khóa dịch
  const titleKey = to.meta.titleKey;
  if (titleKey) {
    document.title = i18n.global.t(titleKey);
  }

  if (to.meta.requiresAuth) {
    if (isLoggedIn) {
      if (role == 1) {
        next();
      } else {
        next("/home");
      }
    } else {
      next("/admin1970/login");
    }
  } else {
    if (to.path.includes("admin")) {
      if (isLoggedIn) {
        if (role == 1) {
          next("/admin1970/dashboard");
        } else {
          next();
        }
      } else {
        next();
      }
    } else {
      next();
    }
  }
});

export default router;
