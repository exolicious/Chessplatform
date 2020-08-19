<template>
    <div class="figure">
        <span>Rook</span>
        <span v-if="playersPiece">mine</span>
    </div>
</template>

<script>
    export default {
        name: "RookComponent",

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
