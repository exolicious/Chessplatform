<template>
    <div class="figure">
        <span>King</span>
        <span v-if="playersPiece">mine</span>
    </div>
</template>

<script>
    export default {
        name: "KingComponent",

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
