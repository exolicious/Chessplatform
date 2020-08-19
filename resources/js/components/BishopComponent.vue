<template>
    <div class="figure">
        <span>Bishop</span>
        <span v-if="playersPiece">mine</span>
    </div>
</template>

<script>
    export default {
        name: "BishopComponent",

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
