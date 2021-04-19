<template>
    <div class="container">


    <div>
        <!-- {{-- left --}} -->
        <div>
            <game-difficulty
                :disabled="this.difficultyDisabled"
                v-on:event_change_difficulty="eventChangeDifficulty($event)"
        
            
            ></game-difficulty>
            <!-- {{-- difficulty radio select --}} -->
        </div>
        <!-- {{-- right --}} -->
        <div>
            <!-- {{-- top score --}} -->
        </div>


    </div>

        <game-board
            :disabled="this.boardDisabled"
            :gameDifficulty="gameDifficulty"
            v-on:event_games_started="eventGameStarted($event)"
        
        ></game-board>

        <button @click="doit()">click</button>




    </div>
</template>

<script>
    export default {
        name: "Game",
        data: function () {
            return {
                gameDifficulty: 'medium',
                easyDifficultyArray: [3,4],   // 6 pairs
                mediumDifficultyArray: [4,5], // 10 pairs
                hardDifficultyArray: [5,6],   // 15 pairs
                difficultyDisabled: false,
                boardDisabled: false,
                gameStarted: false,
                gameFinished: false,
            }
        },
        mounted() {
            console.log('Game Component mounted.')

                let fs = " ┌┬┐┌─┐┌┬┐┌─┐┬─┐┬ ┬ \n" +
                         " │││├┤ ││││ │├┬┘└┬┘ \n" +
                         " ┴ ┴└─┘┴ ┴└─┘┴└─ ┴  ";
                console.log("Welcome to your\n"+'%c'+fs, 'background: #ffd166; color: black');


        },
        watch: {
            gameDifficulty: function (newDifficulty, oldDifficulty ) {
                // console.log('new difficulty = ', newDifficulty, 'old difficulty=', oldDifficulty);
                // console.log(this.gameGrid);
            },
        },
        computed: {
            gameGrid: function() {
                switch (this.gameDifficulty) {
                    case 'easy':
                        return this.easyDifficultyArray;
                    case 'medium':
                        return this.mediumDifficultyArray;
                    case 'hard':
                        return this.hardDifficultyArray;                
                    default:
                        return this.mediumDifficultyArray;
                }


            }

        },
        methods: {
            eventChangeDifficulty: function(changeDifficulty) {
                this.gameDifficulty = changeDifficulty;
            },
            eventGameStarted: function(gameStarted) {
                // this.$emit('event_change_difficulty', changeDifficulty)
                console.log(gameStarted, 'gamestarted event?');
                console.log(gameStarted.target.value);
                this.gameStarted = gameStarted.target.value;
                this.difficultyDisabled = true;
            },
            eventGameFinished: function(gameFinished) {
                // this.$emit('event_change_difficulty', changeDifficulty)
                console.log(gameFinished, 'gamestarted event?');
                console.log(gameFinished.target.value);
                this.gameFinished = gameFinished.target.value;

                // this.difficultyDisabled = false; // create a restart button?
                // this.boardDisabled = true // un-disable with a restart button
            },
            doit: function() {
                console.log(this.gameDifficulty);
            },
        },



    }
</script>
