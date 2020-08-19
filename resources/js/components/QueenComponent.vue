<template>
    <div class="figure">
        <span>Queen</span>
        <span v-if="playersPiece">mine</span>
    </div>
</template>

<script>
    export default {
        name: "QueenComponent",

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
