<template>
    <div class="" id="gamegame" ref="gamegame">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-6 row pr-0">

                    <game-difficulty
                        class="col-auto mr-auto"
                        :difficultyConfig="this.difficultyConfig"
                        :disabled="this.difficultyDisabled"
                        v-on:event_change_difficulty="eventChangeDifficulty($event)"
                    ></game-difficulty>
                    <game-timer
                        :timeGameStarted="this.gameStartedTime"
                        :timeGameFinished="this.timeGameFinished"
                        :gameTime="this.gameSeconds"
                    ></game-timer>

                </div>

                <top-scores
                    class="col-sm-12 col-md-6 px-2"
                    :topScores="this.topScores"
                ></top-scores>
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

        </div>
    </div>
</template>

<script>
import GameBoard from './GameBoard.vue';
import GameTimer from './GameTimer.vue';
import GameTopScores from './GameTopScores.vue';
    export default {
        components: { GameBoard, GameTopScores, GameTimer },
        name: "Game",
        data: function () {
            return {
                gameDifficulty: '',
                difficultyDisabled: false,
                boardDisabled: false,
                gameStarted: false,
                gameStartedTime: 0,
                gameFinished: false,
                timeGameFinished: 0,
                gameSeconds: 0,
                newGameStartedFlag: false,
                // scoresObject: {},

                // Configuration Array for game grids / difficulty
                difficultyConfig: [
                    ['easy',[3,4]],
                    ['medium', [4,5]],
                    ['hard', [5,6]],
                    // ['Really hard', [5, 8]],
                ],
                difficultyConfig2: [ // TODO reconfigure to use the object someday.
                    {   difficulty: 'easy',
                        grid: [3,4], },
                    {   difficulty: 'medium',
                        grid: [4,5], },
                    {   difficulty: 'hard',
                        grid: [5,6], },
                    // {   difficulty: 'Really hard', 
                    //     grid: [5, 8] },
                ],
                topScores: [],
            }
        },
        props: [
            'savedScore',
        ],
        mounted() {
            this.logWelcome();

            if (this.savedScore !== '') {
                this.topScores = JSON.parse(this.savedScore);
            } else {
                this.topScores = (this.difficultyConfig.map(el => ({difficulty: el[0], clicks: 999, seconds: 999, date: '1 Jan 2021'})));
                // this.topScores = (this.difficultyConfig2.map(el => ({difficulty: el.difficulty, clicks: 999, seconds: 999, date: '1 Jan 2021'})));

            }

        },
        watch: {
            gameDifficulty: function (newDifficulty, oldDifficulty ) {
                // console.log(newDifficulty, oldDifficulty);
            },
            newGameStartedFlag: function(n,o) {
                // console.log(n,o,'flag');
            },
        },
        computed: {
            gameGrid: function() {
                let difficultyIndex = this.difficultyConfig.findIndex( (el) => el[0] === this.gameDifficulty )
                // let difficultyIndex = this.difficultyConfig2.findIndex( (el) => el.difficulty === this.gameDifficulty )
                if (difficultyIndex != -1 ) {
                    return this.difficultyConfig[difficultyIndex][1];
                    return this.difficultyConfig2[difficultyIndex].grid;

                } 

                // fallback
                let x = Math.ceil(this.difficultyConfig.length / 2 ) - 1;
                return this.difficultyConfig[x][1];
                // return this.difficultyConfig2[x].grid;
            },
        },
        methods: {
            eventChangeDifficulty: function(changeDifficulty) {
                if (this.gameDifficulty !== changeDifficulty) {
                    this.gameDifficulty = changeDifficulty;
                }

                this.newGameStartedFlag = true;
            },
            eventGameStarted: function(gameStartedTime) {
                this.difficultyDisabled = true;
                this.gameStarted = true;
                this.gameFinished = false;
                this.gameStartedTime = gameStartedTime;
            },
            eventGameFinished: async function(gameFinished) {
                this.timeGameFinished = gameFinished[0];
                let clicks = gameFinished[1];
                this.gameSeconds = gameFinished[2];

                this.difficultyDisabled = false;
                this.gameStarted = false;
                this.gameFinished = true;

                let topScoresIndex = this.topScores.findIndex(({difficulty}) => difficulty === this.gameDifficulty);
                let currentBestClicks = this.topScores[topScoresIndex].clicks;
                let currentBestSeconds = this.topScores[topScoresIndex].seconds;

                if (clicks < currentBestClicks || (clicks == currentBestClicks && this.gameSeconds < currentBestSeconds)) {
                    this.topScores[topScoresIndex].clicks = clicks;
                    this.topScores[topScoresIndex].seconds = this.gameSeconds;
                    this.topScores[topScoresIndex].date = (new Date(Date.now()).toDateString()).substr(-11);
                } 

                let saveresponse = await this.saveScore(this.topScores);
                let getresponse = await this.getScore();
            },
            eventGameReset: function (x) {
                this.newGameStartedFlag = false;
            },
            eventAnotherGuess: function (guesses) {
                // console.log(guesses, 'guesses');
            },
            getScore: function () {
                return axios.get('get-scores');
            },
            saveScore: function () {
                return axios.post('save-scores', {
                    data: this.topScores,
                });
            },
            logWelcome: function () {
                let mm1style = 'border-radius: 5px 30px 0 0; background: #ffd166; color: black';
                let mm2style = 'background: #ffd166; color: black';
                let mm3style = 'border-bottom-left-radius: 5px; background: #ffd166; color: black';
                let mm4style = 'border-radius: 0 5px 5px 0; background: #2c3e50; color: #ffd166';
                let mm5style = 'color: #ffd166';

                let mm1 = " ┌┬┐┌─┐┌┬┐┌─┐┬─┐┬ ┬   \n";
                let mm2 = " │││├┤ ││││ │├┬┘└┬┘   \n"
                let mm3 = " ┴ ┴└─┘┴ ┴└─┘┴└─ ┴ 🐘";
                let mm4 = " by Bill Kremer \n"
                let mm5 = "https://github.com/billkremer/memory-laravel-vue"
                console.log("Welcome to your\n%c" + mm1 + '%c' + mm2 +'%c'+ mm3 + '%c' + mm4 + '%c' + mm5, mm1style, mm2style, mm3style, mm4style, mm5style);
            },
        },

    }
</script>
