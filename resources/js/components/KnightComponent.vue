<template>
    <div class="figure">
        <span>Knight</span>
        <span v-if="playersPiece">mine</span>
    </div>
</template>

<script>
    export default {
        name: "KnightComponent",

        props: {
            playersPiece: {
                required: true,
                type: Boolean,
            }
        }
    }
</script>

<style scoped>

</style>
