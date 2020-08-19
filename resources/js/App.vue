<template>
    <v-app>
        <board-component>
        </board-component>
    </v-app>
</template>

<script>
    import BoardComponent from "./components/BoardComponent";

    export default {
        name: "App",
        components: {
            BoardComponent
        }
    }
</script>

<style scoped>

</style>
