<template>
  <div :class="buttonClass"
    class="flex cursor-pointer uppercase p-1 flex-row h-12 text-center items-center justify-center whitespace-nowrap overflow-hidden w-full md:max-w-80 min-w-fit text-xs xl:text-sm">
    {{ text }}
  </div>
</template>

<script>
const Button = {
  props: {
    text: {
      type: String,
      required: true,
    },
    button_v: {
      type: Number,
      required: true,
    },
    font_size: {
      type: Number,
    },
  },
  computed: {
    buttonClass() {
      return this.button_v == 0 ? "button-style-0" : "button-style-1";
    },
  },
};
export default Button;
</script>

<style></style>
