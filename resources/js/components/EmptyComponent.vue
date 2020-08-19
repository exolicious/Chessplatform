<template>
    <div class="figure"  @mousedown="sendMouseDown" @mouseup="sendMouseUp">
        <span>-</span>
    </div>
</template>

<script>
    export default {
        name: "EmptyComponent",




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
