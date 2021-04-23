<template>
    <div class="" id="gamegame" ref="gamegame">
        <div class="container">
            <div class="row">
            <!-- {{-- left --}} -->
                <game-difficulty
                    class="col-sm"
                    :disabled="this.difficultyDisabled"
                    v-on:event_change_difficulty="eventChangeDifficulty($event)"
                ></game-difficulty>
                <div
                    id='test'
                    class="col-sm"
                >
                <p>asd<br>
                asdf<br>
                asdf</p>
                <!-- margin-block-start: 1em;
    margin-block-end: 1em;
 -->
  
                
                </div>
            <!-- {{-- right --}} -->
            <!-- <div> -->
                <!-- {{-- top score  or reset --}} -->
            <!-- </div> -->

            </div>


        <game-board
            :disabled="this.boardDisabled"
            :gameGrid="this.gameGrid"
            v-on:event_game_started="eventGameStarted($event)"
            v-on:event_game_finished="eventGameFinished($event)"
            v-on:event_another_guess="eventAnotherGuess($event)"
        
        ></game-board>

        <!-- <button @click="doit()">click</button> -->


        </div>
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

                // TODO refactor difficulty to use this object
                difficulty: {
                    'easy': [3,4],
                    'medium': [4,5],
                    'hard': [5,6],
                }
            }
        },
        mounted() {
            this.logWelcome();
                let mm1style = 'border-top-left-radius: 5px; border-top-right-radius: 5px; background: #ffd166; color: black';
                let mm2style = 'background: #ffd166; color: black';
                let mm3style = 'border-bottom-left-radius: 5px; border-bottom-right-radius: 30px; background: #ffd166; color: black';

                let mm1 = " ┌┬┐┌─┐┌┬┐┌─┐┬─┐┬ ┬ \n";
                let mm2 = " │││├┤ ││││ │├┬┘└┬┘ \n"
                let mm3 = " ┴ ┴└─┘┴ ┴└─┘┴└─ ┴  ";
                console.log("Welcome to your\n" + '%c' + mm1 + '%c' + mm2 +'%c'+ mm3 , mm1style, mm2style, mm3style);


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
                this.difficultyDisabled = true;
                this.gameStarted = true;

                console.log(gameStarted, 'gamestarted event?');

            },
            eventGameFinished: function(gameFinished) {
                this.difficultyDisabled = false;
                this.gameFinished = true;

                console.log(gameFinished, 'gamefinished event');
                // console.log(gameFinished.target.value);
                // this.gameFinished = gameFinished.target.value;

                // this.difficultyDisabled = false; // create a restart button?
                // this.boardDisabled = true // un-disable with a restart button

            // TODO:
            // reset css for game difficulty select 
            //




            },


            eventAnotherGuess: function (guesses) {
                console.log(guesses, 'guesses');
            },
            doit: function() {

                console.log(this.gameDifficulty);
            },
            logWelcome: function () {
                let mm1style = 'border-top-left-radius: 5px; border-top-right-radius: 5px; background: #ffd166; color: black';
                let mm2style = 'background: #ffd166; color: black';
                let mm3style = 'border-bottom-left-radius: 5px; border-bottom-right-radius: 30px; background: #ffd166; color: black';

                let mm1 = " ┌┬┐┌─┐┌┬┐┌─┐┬─┐┬ ┬ \n";
                let mm2 = " │││├┤ ││││ │├┬┘└┬┘ \n"
                let mm3 = " ┴ ┴└─┘┴ ┴└─┘┴└─ ┴  ";
                console.log("Welcome to your\n" + '%c' + mm1 + '%c' + mm2 +'%c'+ mm3 , mm1style, mm2style, mm3style);
            }
        },



    }
</script>
