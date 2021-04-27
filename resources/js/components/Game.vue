<template>
    <div class="" id="gamegame" ref="gamegame">
        <div class="container">
            <div class="row">
            <!-- {{-- left --}} -->
                <game-difficulty
                    class="col-sm"
                    :difficultyConfig="this.difficultyConfig"
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
 
  
                
                </div>
            <!-- {{-- right --}} -->
            <!-- <div> -->
                <!-- {{-- top score  or reset --}} -->
            <!-- </div> -->

            </div>


        <game-board
            :disabled="this.boardDisabled"
            :gameGrid="this.gameGrid"
            :newGameStartedFlag="this.newGameStartedFlag"
            v-on:event_game_started="eventGameStarted($event)"
            v-on:event_game_finished="eventGameFinished($event)"
            v-on:event_another_guess="eventAnotherGuess($event)"
            v-on:event_game_reset="eventGameReset($event)"

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
                gameDifficulty: '',
                difficultyDisabled: false,
                boardDisabled: false,
                gameStarted: false,
                gameFinished: false,
                newGameStartedFlag: false,
                scoresObject: {},

                // Configuration Array for game grids / difficulty
                difficultyConfig: [
                    ['easy',[3,4]],
                    ['medium', [4,5]],
                    ['hard', [5,6]],
                    // ['Really hard', [5, 8]],
                ]
            }
        },
        mounted() {
            this.logWelcome();


        },
        watch: {
            gameDifficulty: function (newDifficulty, oldDifficulty ) {
                // console.log(newDifficulty, oldDifficulty);
            },
            newGameStartedFlag: function(n,o) {
                // console.log(n,o,'flag');
            }
        },
        computed: {
            gameGrid: function() {
                for(let i = 0; i < this.difficultyConfig.length; i++) {
                    if (this.gameDifficulty == this.difficultyConfig[i][0]) {
                        return this.difficultyConfig[i][1];
                    }
                }
                // fallback
                let x = Math.ceil(this.difficultyConfig.length / 2 ) - 1;
                return this.difficultyConfig[x][1];
            },
        },
        methods: {
            eventChangeDifficulty: function(changeDifficulty) {
                if (this.gameDifficulty === changeDifficulty) {

                } else {
                    this.gameDifficulty = changeDifficulty;
                }

                this.newGameStartedFlag = true;

            },
            eventGameStarted: function(gameStarted) {
                this.difficultyDisabled = true;
                this.gameStarted = true;
                this.gameFinished = false;
                console.log(gameStarted, 'gamestarted event?');

            },
            eventGameFinished: function(gameFinished) {
                this.difficultyDisabled = false;
                this.gameStarted = false;
                this.gameFinished = true;

                console.log(gameFinished, 'gamefinished event');

                // get name and send result to backend
                this.saveScore();
            this.$nextTick(function () {
                this.getScore();
            })
                // console.log(gameFinished.target.value);
                // this.gameFinished = gameFinished.target.value;

                // this.difficultyDisabled = false; // create a restart button?
                // this.boardDisabled = true // un-disable with a restart button

            // TODO: finish game
            // reset css for game difficulty select 
            //


            },


            eventGameReset: function (x) {
                // this.$nextTick(function () {
                    this.newGameStartedFlag = false;
                // })
            },
            eventAnotherGuess: function (guesses) {
                console.log(guesses, 'guesses');
            },

            getScore: function () {
                console.log('getting score');

                // this.scoresObject

                axios.get('get-scores')
                .then(function (response) {
                    console.log(response );
                })
                .catch(function (error) {
                    console.log(error);
                });;
// console.log(data);


            },
            saveScore: function () {
                console.log('saving score');
                this.scoresObject = {'a': ['name', '10 clicks', 'easy']};

                axios.post('save-scores', {
                    data: this.scoresObject,
                })
                .then(function (response) {
                    console.log(response );
                })
                .catch(function (error) {
                    console.log(error);
                });



            },





            doit: function() {
// TODO remove this later
                // console.log(this.gameDifficulty);
            },
            logWelcome: function () {
                let mm1style = 'border-top-left-radius: 5px; border-top-right-radius: 5px; background: #ffd166; color: black';
                let mm2style = 'background: #ffd166; color: black';
                let mm3style = 'border-bottom-left-radius: 5px; border-bottom-right-radius: 30px; background: #ffd166; color: black';

                let mm1 = " ┌┬┐┌─┐┌┬┐┌─┐┬─┐┬ ┬ \n";
                let mm2 = " │││├┤ ││││ │├┬┘└┬┘ \n"
                let mm3 = " ┴ ┴└─┘┴ ┴└─┘┴└─ ┴  ";
                console.log("Welcome to your\n" + '%c' + mm1 + '%c' + mm2 +'%c'+ mm3 , mm1style, mm2style, mm3style);
            },

        },


    }
</script>
