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
            },

            getLegalMoves() {
                let legalMoves = [];
                legalMoves.push({
                    row: this.currentRow - 1,
                    column: this.currentColumn,
                    type: "pawnMove"
                });
                if(!this.movedAtLeastOnce) {
                    legalMoves.push({
                        row: this.currentRow - 2,
                        column: this.currentColumn,
                        type: "pawnMove"
                    });
                }
                legalMoves.push({
                    row: this.currentRow - 1,
                    column: this.currentColumn - 1,
                    type: "pawnCapture"
                });
                legalMoves.push({
                    row: this.currentRow - 1,
                    column: this.currentColumn + 1,
                    type: "pawnCapture"
                });
                return legalMoves;
            },

            moveCanOccur(_boardState, _move) {
                if(_move.type == "pawnMove") {
                    //check Obstruction
                    for(let i = _move.row; i < this.currentRow; i++) {
                        if(_boardState[i][this.currentColumn] != "") {
                            return false;
                        }
                    }
                }
                else if(_move.type == "pawnCapture") {
                    if(_boardState[_move.row][_move.column] == "") {
                        return false;
                    }
                }
            return true;
            }
        }
    }
</script>

<style scoped>
</style>
