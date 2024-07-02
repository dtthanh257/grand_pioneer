<template>
    <input type="text" :placeholder="placeholder">
</template>
<script>
const Input = {
    name: "Input",
    props: {
        placeholder: String
    }
}
export default Input
</script>
<style scoped>
input {
    padding: 4px;
    border-bottom: 1.5px solid var(--blue-color);
    outline: none;
    color: var(--blue-color);
    width: 100%;
}

::placeholder {
    color: var(--blue-color);
    letter-spacing: 3px;
}
</style>