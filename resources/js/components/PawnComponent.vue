<template>
    <div class="figure" @mousedown="sendMouseDown" @mouseup="sendMouseUp">
        <span>Pawn</span>
        <span v-if="playersPiece">mine</span>
    </div>
</template>

<script>
    export default {
        name: "PawnComponent",

        props: {
            playersPiece: {
                required: true,
                type: Boolean,
            },
            currentRow: {
                required: true,
                type: Number,
            },
            currentColumn: {
                required: true,
                type: Number,
            }
        },

        data: () => ({
            pieceType: "pawn",
        }),


        methods: {
            sendMouseDown() {
                this.$emit("clicked", this);
            },
            sendMouseUp() {
                this.$emit("stopclick", this);
            }
        }
    }
</script>

<style scoped>
</style>
