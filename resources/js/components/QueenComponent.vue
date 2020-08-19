<template>
    <div class="figure" @mousedown="sendMouseDown" @mouseup="sendMouseUp">
        <v-img v-if="pieceColor=='white'"contain src="//images.chesscomfiles.com/chess-themes/pieces/alpha/150/wq.png"></v-img>
        <v-img v-else-if="pieceColor=='black'" contain src="//images.chesscomfiles.com/chess-themes/pieces/alpha/150/bq.png"></v-img>
    </div>
</template>

<script>
    export default {
        name: "QueenComponent",

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
        },

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
