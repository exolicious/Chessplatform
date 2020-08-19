<template>
    <div class="figure" @mousedown="sendMouseDown" @mouseup="sendMouseUp">
        <span>-</span>
    </div>
</template>

<script>
    export default {
        name: "EmptyComponent",

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
            }
        },

        data: () => ({
            pieceType: "",
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
