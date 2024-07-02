import { createApp } from "vue";
import App from "./App.vue";
import "./registerServiceWorker";
import router from "./router";
import store from "./store";
import { createI18n } from "vue-i18n";
import "./css/style.css";
import "./css/tailwind.css";
import Resource from "./helpers/resource";
import { faChevronDown } from "@fortawesome/free-solid-svg-icons";
import { faBars, faGripVertical } from "@fortawesome/free-solid-svg-icons";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

const i18n = createI18n({
  locale: "en",
  fallbackLocale: "en",
  messages: {
    en: Resource.Eng,
    vi: Resource.Vi,
  },
});

export function getI18n() {
  return i18n;
}

localStorage.setItem("vessel_id", 1);

library.add(faChevronDown);
library.add(faBars);
library.add(faGripVertical);

const app = createApp(App);
app.use(store).use(router).use(i18n).component("font-awesome-icon", FontAwesomeIcon);
app.mount("#app");
