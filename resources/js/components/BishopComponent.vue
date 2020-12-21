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
                if(_move.row < this.currentRow && _move.column < this.currentColumn) {
                    let i = _move.row + 1;
                    let k = _move.column + 1; // substract 1 cause the actual destination can either be an empty piece or an enemy one (it cant be one´s own piece since that aleady gets handled earlier see BoardComponent handleMouseUp function)
                    while(i < this.currentRow && k < this.currentColumn) {
                        if (_boardState[i][k] != "") {
                            return false;
                        }
                        i++;
                        k++;
                    }
                }
                else if(_move.row < this.currentRow && _move.column > this.currentColumn) {
                    let i = _move.row + 1;
                    let k = _move.column - 1;
                    while (i < this.currentRow && k > this.currentColumn) {
                        if (_boardState[i][k] != "") {
                            return false;
                        }
                        i++;
                        k--;
                    }
                }
                else if(_move.row > this.currentRow && _move.column < this.currentColumn) {
                    let i = _move.row - 1;
                    let k = _move.column - 1;
                    while (i > this.currentRow && k < this.currentColumn) {
                        if (_boardState[i][k] != "") {
                            return false;
                        }
                        i--;
                        k++;
                    }
                }
                else if(_move.row > this.currentRow && _move.column > this.currentColumn) {
                    let i = _move.row - 1;
                    let k = _move.column - 1;
                    while (i > this.currentRow && k > this.currentColumn) {
                        if (_boardState[i][k] != "") {
                            return false;
                        }
                        i--;
                        k--;
                    }
                }
                return true;
            }
        }
    }
</script>

<style scoped>

</style>
