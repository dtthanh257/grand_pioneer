<template>
  <div class="custom-select">
    <div class="selected-option" @click="toggleDropdown">
      <span>{{ selectedLabel }}</span>
    </div>
    <ul v-if="dropdownOpen" class="options-list">
      <li v-for="option in options" :key="option.value" @click="selectOption(option.value)"
        :class="{ 'selected': option.value === selected }">
        <img v-if="option.icon" :src="option.icon" alt="" />
        <span>{{ option.label }}</span>
      </li>
    </ul>
  </div>
</template>

<script>
import { mapState, mapMutations } from 'vuex';

const Navbar = {
  name: "Navbar",
  props: {
    options: {
      type: Array,
      required: true,
    },
  },
  computed: {
    ...mapState(['language']),
    selected: {
      get() {
        return this.language;
      },
      set(value) {
        this.updateLanguage(value);
      },
    },
    selectedLabel() {
      const selectedOption = this.options.find(
        (option) => option.value === this.selected
      );
      return selectedOption ? selectedOption.label : 'Select';
    },
  },
  data() {
    return {
      dropdownOpen: false,
    };
  },
  methods: {
    ...mapMutations(['setLanguage']),
    toggleDropdown() {
      this.dropdownOpen = !this.dropdownOpen;
    },
    selectOption(value) {
      this.setLanguage(value);
      this.dropdownOpen = false;
      this.$emit('input', value);
    },
    updateLanguage(value) {
      this.setLanguage(value);
    },
  },
};
export default Navbar
</script>

<style scoped>
.custom-select {
  position: relative;
  display: inline-block;
  cursor: pointer;
}

span {
  color: white;
}

img {
  height: 24px;
  width: 24px;
  object-fit: contain;
}

.selected-option {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.5rem;
  background-color: transparent;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: fit-content;
  min-width: 160px
}

.options-list {
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  max-height: 200px;
  overflow-y: auto;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 4px;
  z-index: 1000;
  list-style: none;
  margin: 0;
  padding: 0;
}

.options-list li {
  display: flex;
  align-items: center;
  white-space: nowrap;
  padding: 0 4px;
}

.options-list li span {
  padding: 0.5rem;
  display: flex;
  align-items: center;
  color: black;
}

.options-list li.selected {
  background-color: #eee;
}

.options-list li:hover {
  background-color: #ddd;
}

.options-list img {
  margin-right: 0.5rem;
}
</style>
