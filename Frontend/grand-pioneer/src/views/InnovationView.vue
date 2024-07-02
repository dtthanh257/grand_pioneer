<template>
    <div class="innovation">
        <Menu></Menu>
        <Combobox></Combobox>

    </div>
</template>
<script>
import Menu from "@/components/Menu.vue"
import Combobox from "../components/Combobox.vue";
export default {
    name: "InnovationView",
    components: {
        Menu,
        Combobox
    }
}
</script>
<style>
/* .innovation {
    height: 100vh;
    background-color: wheat
} */
</style>