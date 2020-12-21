<template>
    <v-container @mousemove="handleMove" class="no-select">
        <v-row v-for="(row,indexRow) in boardState" style="margin: auto; width: 600px; height: 75px;
         background-color: #a1cbef">
            <div v-for="(column,indexColumn) in row" :class="darkSquared(indexRow,indexColumn)" style="width: 12.5%; height: 100%;">
                <!--<span style="padding-top: 5px; padding-left: 5px; z-index: 200">{{getYCoordinate(row,column)}}</span>-->
                <pawn-component
                    v-if="column == 'p'"
                    :pieceColor="setPieceColor(indexRow, indexColumn)"
                    :currentRow="indexRow"
                    :currentColumn="indexColumn"
                    :movedAtLeastOnce="setMovedAtLeastOnce(indexRow)"
                    @clicked="handleClick"
                    @stopclick="handleMouseUp"
                >
                </pawn-component>
                <rook-component
                    v-if="column == 'r'"
                    :pieceColor="setPieceColor(indexRow, indexColumn)"
                    :currentRow="indexRow"
                    :currentColumn="indexColumn"
                    @clicked="handleClick"
                    @stopclick="handleMouseUp"
                >
                </rook-component>
                <knight-component
                    v-if="column == 'n'"
                    :pieceColor="setPieceColor(indexRow, indexColumn)"
                    :currentRow="indexRow"
                    :currentColumn="indexColumn"
                    @clicked="handleClick"
                    @stopclick="handleMouseUp"
                >
                </knight-component>
                <bishop-component
                    v-if="column == 'b'"
                    :pieceColor="setPieceColor(indexRow, indexColumn)"
                    :currentRow="indexRow"
                    :currentColumn="indexColumn"
                    @clicked="handleClick"
                    @stopclick="handleMouseUp"
                >
                </bishop-component>
                <queen-component
                    v-if="column == 'q'"
                    :pieceColor="setPieceColor(indexRow, indexColumn)"
                    :currentRow="indexRow"
                    :currentColumn="indexColumn"
                    @clicked="handleClick"
                    @stopclick="handleMouseUp"
                >
                </queen-component>
                <king-component
                    v-if="column == 'k'"
                    :pieceColor="setPieceColor(indexRow, indexColumn)"
                    :currentRow="indexRow"
                    :currentColumn="indexColumn"
                    :movedAtLeastOnce="setMovedAtLeastOnce(indexRow)"
                    @clicked="handleClick"
                    @stopclick="handleMouseUp"
                >
                </king-component>
                <empty-component
                    v-if="column == ''"
                    :pieceColor="''"
                    :currentRow="indexRow"
                    :currentColumn="indexColumn"
                    @clicked="handleClick"
                    @stopclick="handleMouseUp"
                >
                </empty-component>
            </div>
        </v-row>
    </v-container>
</template>

<script>
    import PawnComponent from "./PawnComponent";
    import RookComponent from "./RookComponent";
    import KnightComponent from "./KnightComponent";
    import BishopComponent from "./BishopComponent";
    import KingComponent from "./KingComponent";
    import QueenComponent from "./QueenComponent";
    import EmptyComponent from "./EmptyComponent";

    export default {
        name: "BoardComponent",
        components: {
            PawnComponent,
            RookComponent,
            KnightComponent,
            BishopComponent,
            KingComponent,
            QueenComponent,
            EmptyComponent
        },

        data: () => ({
            playerColor: "white",
            boardState: [],
            boardSquares: [],
            playerPiecesCoordinates: [],
            //activePieceLegalSquares: [],
            //pawnDiagonalMoves: [],
            //activePieceType: "",
            currentMove: {},
            dragging: false,
            dragElement: null,
            atLeastOnePieceMoved: false,
            lastMovedPiecePos: null, //needed to set the playerPiece attribute after a player moved a piece and a render of component occurs with a row value other than 7 or 8
            // originPosition: null
        }),

        mounted() {
            this.setColorSpecificState();
            document.addEventListener('mouseleave', () => {
                this.dragging = false;
            });
        },

        methods: {
            setColorSpecificState() {
                if (this.playerColor == "white") {
                    this.boardState =
                        [
                            ["r", "n", "b", "q", "k", "b", "n", "r"],
                            ["p", "p", "p", "p", "p", "p", "p", "p"],
                            ["", "", "", "", "", "", "", ""],
                            ["", "", "", "", "", "", "", ""],
                            ["", "", "", "", "", "", "", ""],
                            ["", "", "", "", "", "", "", ""],
                            ["p", "p", "p", "p", "p", "p", "p", "p"],
                            ["r", "n", "b", "q", "k", "b", "n", "r"]
                        ];
                    this.boardSquares =
                        [
                            ["a8", "b8", "c8", "d8", "e8", "f8", "g8", "h8"],
                            ["a7", "b7", "c7", "d7", "e7", "f7", "g7", "h7"],
                            ["a6", "b6", "c6", "d6", "e6", "f6", "g6", "h6"],
                            ["a5", "b5", "c5", "d5", "e5", "f5", "g5", "h5"],
                            ["a4", "b4", "c4", "d4", "e4", "f4", "g4", "h4"],
                            ["a3", "b3", "c3", "d3", "e3", "f3", "g3", "h3"],
                            ["a2", "b2", "c2", "d2", "e2", "f2", "g2", "h2"],
                            ["a1", "b1", "c1", "d1", "e1", "f1", "g1", "h1"]
                        ];
                } else if (this.playerColor == "black") {
                    this.boardState =
                        [
                            ["r", "n", "b", "k", "q", "b", "n", "r"],
                            ["p", "p", "p", "p", "p", "p", "p", "p"],
                            ["", "", "", "", "", "", "", ""],
                            ["", "", "", "", "", "", "", ""],
                            ["", "", "", "", "", "", "", ""],
                            ["", "", "", "", "", "", "", ""],
                            ["p", "p", "p", "p", "p", "p", "p", "p"],
                            ["r", "n", "b", "k", "q", "b", "n", "r"]
                        ];
                    this.boardSquares =
                        [
                            ["h1", "g1", "f1", "e1", "d1", "c1", "b1", "a1"],
                            ["h2", "g2", "f2", "e2", "d2", "c2", "b2", "a2"],
                            ["h3", "g3", "f3", "e3", "d3", "c3", "b3", "a3"],
                            ["h4", "g4", "f4", "e4", "d4", "c4", "b4", "a4"],
                            ["h5", "g5", "f5", "e5", "d5", "c5", "b5", "a5"],
                            ["h6", "g6", "f6", "e6", "d6", "c6", "b6", "a6"],
                            ["h7", "g7", "f7", "e7", "d7", "c7", "b7", "a7"],
                            ["h8", "g8", "f8", "e8", "d8", "c8", "b8", "a8"]
                        ];
                }
                for (let i = 5; i < 8; i++) {
                    for (let j = 0; j < 8; j++) {
                        this.playerPiecesCoordinates.push(this.boardSquares[i][j]);
                    }
                }
            },

            darkSquared(_row, _column) {
                return {
                    'dark-square': (_column + _row) % 2 == 1,
                }
            },

            getYCoordinate(_row, _column) {
                if (this.playerColor == "black") {
                    if (_column == 1) {
                        let ret = _row % 8;
                        return ret != 0 ? ret : 8;
                    }
                } else if (this.playerColor == "white") {
                    if (_column == 1) {
                        return _row;
                    }
                }
            },

            setPlayerPiece(_row, _column) {
                if (!this.lastMovedPiecePos) {
                    if (_row >= 6) {
                        return false;
                    }
                    return true;
                } else if (this.lastMovedPiecePos.currentRow == _row && this.lastMovedPiecePos.currentColumn == _column) {
                    return true;
                }
            },

            setPieceColor(_row, _column) {
                if (this.playerColor == "white") {
                    if (this.playerPiecesCoordinates.includes(this.boardSquares[_row][_column])) {
                        return this.playerColor;
                    } else {
                        return "black";
                    }
                } else if (this.playerColor == "black") {
                    if (this.playerPiecesCoordinates.includes(this.boardSquares[_row][_column])) {
                        return this.playerColor;
                    } else {
                        return "white";
                    }
                }
            },

            setMovedAtLeastOnce(_row) {
                if (_row < 6) {
                    return true;
                }
                return false;
            },

            //MOVE RELATED METHODS

            handleClick(_originInstance) {
                if (_originInstance.pieceColor == this.playerColor) {
                    this.dragElement = document.createElement("img");
                    let self = this;
                    this.dragElement.addEventListener( 'load', function () {
                        self.dragElement.style.position = "absolute";
                        self.dragElement.style.width = "75px";
                        self.dragElement.style.height = "75px";
                        self.dragElement.style.pointerEvents = "none";
                        document.body.appendChild(self.dragElement);
                    });
                    let imgSrc = _originInstance.$el.firstChild.children[1].style.backgroundImage;
                    this.dragElement.src = imgSrc.substring(5, imgSrc.length - 2);

                    this.dragging = true;
                    this.currentMove.activePieceType = _originInstance.pieceType;
                    this.currentMove.originInstance = _originInstance;
                    this.currentMove.activePieceLegalMoves = _originInstance.getLegalMoves();
                }
            },

            handleMove(_event) {
                if(this.dragging) {
                    this.dragElement.style.left = _event.x - this.dragElement.offsetWidth/2 + "px";
                    this.dragElement.style.top = _event.y - this.dragElement.offsetHeight/2 + "px";
                }
            },

            handleMouseUp(_targetInstance) {
                this.dragging = false;
                if(this.dragElement) {
                    this.dragElement.remove();
                    this.dragElement = null;
                }
                if (_targetInstance.pieceColor != this.playerColor) { //this needs to change for rochade (later)
                    let targetSquare = this.boardSquares[_targetInstance.currentRow][_targetInstance.currentColumn];
                    this.checkMove(_targetInstance, targetSquare);
                }
                this.currentMove.activePieceType = "";
                this.currentMove.activePieceLegalMoves = [];
            },

            checkMove(_targetInstance, _targetSquare) {
                let legalMove = null;
                for(let move of this.currentMove.activePieceLegalMoves) {
                    if(this.boardSquares[move.row][move.column] == _targetSquare) {
                        legalMove = move;
                        break;
                    }
                }
                if(legalMove) {
                    if(this.currentMove.originInstance.moveCanOccur(this.boardState, legalMove)) {
                        this.updateState(_targetInstance);
                    }
                }
            },

            updateState(_targetInstance) {
                Vue.set(this.boardState[_targetInstance.currentRow], _targetInstance.currentColumn, this.currentMove.activePieceType);
                this.playerPiecesCoordinates.push(this.boardSquares[_targetInstance.currentRow][_targetInstance.currentColumn])
                Vue.set(this.boardState[this.currentMove.originInstance.currentRow], this.currentMove.originInstance.currentColumn, "");
                let indexOfSpliceTarget = this.playerPiecesCoordinates.indexOf(this.boardSquares[this.currentMove.originInstance.currentRow][this.currentMove.originInstance.currentColumn]);
                this.playerPiecesCoordinates.splice(indexOfSpliceTarget, 1);
            }
        },
    }

</script>

<style scoped>
    .no-select {
        user-select: none;
    }
    .figure {
        display: flex;
        cursor: pointer;
        justify-content: space-evenly;
        align-items: center;
        width: 100%;
        height: 100%;
    }
    .dark-square {
        background-color: #1d3a4e;
    }
</style>
