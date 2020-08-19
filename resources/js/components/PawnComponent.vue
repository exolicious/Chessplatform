<template>
    <div class="figure" @mousedown="sendMouseDown" @mouseup="sendMouseUp">
        <v-img v-if="pieceColor=='white'"contain src="https://images.chesscomfiles.com/chess-themes/pieces/alpha/150/wp.png"></v-img>
        <v-img v-else-if="pieceColor=='black'" contain src="https://images.chesscomfiles.com/chess-themes/pieces/alpha/150/bp.png"></v-img>
    </div>
</template>

<script>
    export default {
        name: "PawnComponent",

        props: {
            pieceColor: {
                required: true,
                type: String,
            },
            currentRow: {
                required: true,
                type: Number,
            },
            currentColumn: {
                required: true,
                type: Number,
            },
            movedAtLeastOnce: {
                required: true,
                type: Boolean,
            }
        },

        data: () => ({
            pieceType: "p",
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
