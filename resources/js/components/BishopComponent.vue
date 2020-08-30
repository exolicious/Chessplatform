<template>
    <div class="figure" @mousedown="sendMouseDown" @mouseup="sendMouseUp">
        <v-img v-if="pieceColor=='white'"contain src="//images.chesscomfiles.com/chess-themes/pieces/alpha/150/wb.png"></v-img>
        <v-img v-else-if="pieceColor=='black'" contain src="//images.chesscomfiles.com/chess-themes/pieces/alpha/150/bb.png"></v-img>
    </div>
</template>

<script>
    export default {
        name: "BishopComponent",

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

        data: () => ({
            pieceType: "b",
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
                for(let i = 1; i < 8; i++) {
                    //handle array out of bounds cases but still get all possible diagonal movements
                    if (this.currentRow - i >= 0 && this.currentColumn + i < 8) {
                        legalMoves.push({
                            row: this.currentRow - i,
                            column: this.currentColumn + i,
                            type: "bishopMove"
                        });
                    }
                    if (this.currentRow - i >= 0 && this.currentColumn - i >= 0) {
                        legalMoves.push({
                            row: this.currentRow - i,
                            column: this.currentColumn - i,
                            type: "bishopMove"
                        });
                    }
                    if (this.currentRow + i < 8 && this.currentColumn - i >= 0) {
                        legalMoves.push({
                            row: this.currentRow + i,
                            column: this.currentColumn - i,
                            type: "bishopMove"
                        });
                    }
                    if (this.currentRow + i < 8 && this.currentColumn + i < 8) {
                        legalMoves.push({
                            row: this.currentRow + i,
                            column: this.currentColumn + i,
                            type: "bishopMove"
                        });
                    }
                }
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
