// store.js
import { createStore } from 'vuex';

export default createStore({
  state: {
    language: localStorage.getItem('language') || 'en',
  },
  mutations: {
    setLanguage(state, language) {
      state.language = language;
      localStorage.setItem('language', language);
    },
  },
  actions: {
    changeLanguage({ commit }, language) {
      commit('setLanguage', language);
    },
  },
});
