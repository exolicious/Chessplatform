<template>
    <v-container>
        <v-row v-for="row in 8" style="margin: auto; width: 600px; height: 75px;
         background-color: #a1cbef">
            <div v-for="column in 8" :class="darkSquared(row,column)" style="width: 12.5%; height: 100%;">
                <span style="padding-top: 5px; padding-left: 5px; z-index: 200">{{getYCoordinate(row,column)}}</span>
                <component
                    :is="getComponent(row,column)"
                    :playersPiece="setPlayerPiece(row)"
                    :currentRow="row"
                    :currentColumn="column"
                    @clicked="handleClick"
                    @stopclick="handleMouseUp"
                >
                </component>
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
            boardState: [
                ["r", "n", "b", "q", "k", "b", "n", "r"],
                ["p", "p", "p", "p", "p", "p", "p", "p"],
                ["",  "",  "",  "",  "",  "",  "",  "" ],
                ["",  "",  "",  "",  "",  "",  "",  "" ],
                ["",  "",  "",  "",  "",  "",  "",  "" ],
                ["",  "",  "",  "",  "",  "",  "",  "" ],
                ["p", "p", "p", "p", "p", "p", "p", "p"],
                ["r", "n", "b", "q", "k", "b", "n", "r"]
            ],
            boardCoordinates: [
                ["a8", "b8", "c8", "d8", "e8", "f8", "g8", "h8"],
                ["a7", "b7", "c7", "d7", "e7", "f7", "g7", "h7"],
                ["a6", "b6", "c6", "d6", "e6", "f6", "g6", "h6"],
                ["a5", "b5", "c5", "d5", "e5", "f5", "g5", "h5"],
                ["a4", "b4", "c4", "d4", "e4", "f4", "g4", "h4"],
                ["a3", "b3", "c3", "d3", "e3", "f3", "g3", "h3"],
                ["a2", "b2", "c2", "d2", "e2", "f2", "g2", "h2"],
                ["a1", "b1", "c1", "d1", "e1", "f1", "g1", "h1"],
            ],
            activePieceLegalMoves: [],
            activePiece: null,
        }),

        mounted() {
            document.addEventListener('mouseleave', () => {
                this.activePiece = "";
            })
        },

        methods: {
            getYCoordinate(_row, _column) {
                if(this.playerColor == "black") {
                    if(_column == 1) {
                        let ret = _row%8;
                        return ret != 0? ret : 8;
                    }
                }
                else if(this.playerColor == "white") {
                    if(_column == 1) {
                        return _row;
                    }
                }
            },

            setPlayerPiece(_row) {
                if(_row >= 7) {
                    return true;
                }
                return false;
            },

            darkSquared(_row, _column){
                return {
                        'dark-square': (_column+_row)%2 == 1,
                    }
            },

            getComponent(_row, _column) {
                let pieceCode = this.boardState[_row-1][_column-1];
                if(pieceCode == "p") {
                    return PawnComponent;
                }
                else if(pieceCode == "r") {
                    return RookComponent;
                }
                else if(pieceCode == "n") {
                    return KnightComponent;
                }
                else if(pieceCode == "b") {
                    return BishopComponent;
                }
                else if(pieceCode == "q") {
                    return QueenComponent;
                }
                else if(pieceCode == "k") {
                    return KingComponent;
                }
                else {
                    return EmptyComponent;
                }
            },

            placePawns(_row) {

            },

            placeRooks(_row, _column) {

            },

            placeKnights(_row, _column) {

            },

            placeBishops(_row, _column) {

            },

            placeKings(_row, _column) {

            },

            placeQueens(_row, _column) {
                if(_row == 1 && _column == 4 || _row == 8 && _column == 4) {
                    return true;
                }
            },

            //MOVE RELATED METHODS

            handleClick(_pieceInstance) {
                if(_pieceInstance.playersPiece) {
                    this.activePiece = _pieceInstance;
                    if(_pieceInstance.pieceType == "pawn") {
                        this.activePieceLegalMoves.push({row: _pieceInstance.currentRow-1, column: _pieceInstance.currentColumn})
                    }
                }
            },

            handleMouseUp(_pieceInstance) {
                if(!_pieceInstance.$attrs.playersPiece) {
                    let pos = {row: _pieceInstance.$attrs.currentRow, column: _pieceInstance.$attrs.currentColumn}
                        _pieceInstance = this.activePiece;
                }
                this.activePiece = null;
                this.activePieceLegalMoves = [];
            }
        }
    }

</script>

<style scoped>
    .figure {
        display: flex;
        cursor: pointer;
        justify-content: space-evenly;
        align-items: center;
        width: 100%;
    }
    .dark-square {
        background-color: #1d3a4e;
    }
</style>
