<template>
    <div class="row justify-content-center" ref="gameboard" id="gameboard">
        <game-card
            v-for="card in cardArray"
            v-bind:card="card"
            v-bind:key="card.cardId"
            v-bind:ref="card.cardId"
            v-bind:stoptransitions="stoptransitions"
            v-on:event_card_clicked="eventCardClicked(card)"
        ></game-card>
    </div>
</template>

<script>
import GameCard from './GameCard.vue';
    export default {
        name: "GameBoard",
        components: { GameCard },
        data: function () {
            return {
                availableWidth: 0,
                cardArray: [],
                cardsClicked: [],
                numberOfGuesses: 0,
                numberOfMatches: 0,
                gameStarted: false,
                timeGameStarted: 0,
                timeGameFinished: 0,
                stoptransitions: false,
            }
        },
        props: [
            'disabled',
            'gameGrid',
            'newGameStartedFlag'
        ],
        mounted() {
            this.$nextTick(function () {
                this.resetGame();
                window.addEventListener("resize", this.checkWidth);
            });
        },
        computed: {

        },
        watch: {
            newGameStartedFlag: function (newGS, oldGS) {
                if (newGS == true) {
                    this.resetGame();
                        this.$nextTick(function () {
                            this.$emit('event_game_reset', 'reset');
                        })
                }
            },
            gameGrid: function() {
                this.resetGame();
            },
            cardsClicked: function (newCards, oldCards) {
                if (this.cardsClicked.length >= 2) {

                    if (this.cardsClicked[0].pairValue === this.cardsClicked[1].pairValue
                        && this.cardsClicked[0].cardId !== this.cardsClicked[1].cardId) {
                         
                        this.$refs[this.cardsClicked[0].cardId][0].card.canClick = false;
                        this.$refs[this.cardsClicked[1].cardId][0].card.canClick = false;
                        this.cardsClicked = [];

                        this.numberOfMatches++;
                        
                    } else {
                        this.$refs[this.cardsClicked[0].cardId][0].card.canClick = true;
                        this.$refs[this.cardsClicked[1].cardId][0].card.canClick = true;

                        this.$nextTick(function () {
                            this.$refs[this.cardsClicked[0].cardId][0].card.cardFaceShown = false;
                            this.$refs[this.cardsClicked[1].cardId][0].card.cardFaceShown = false;

                            this.cardsClicked = [];
                        })
                    }

                }
            },
            numberOfMatches: function (n,o) {
                if (this.numberOfMatches == this.cardArray.length / 2 ) {
                    this.stoptransitions = true;
                    this.emitGameFinished();
                }
            },
        },
        methods: {
            resetGame: function () {
                this.canClick = true;
                this.cardArray = [];
                this.cardsClicked = [];
                this.numberOfGuesses = 0;
                this.numberOfMatches = 0;
                this.gameStarted = false; 

                this.checkWidth();
                
            },
            checkWidth: function() {
                this.availableWidth = this.$refs.gameboard.clientWidth;
                this.createCardArray();
            },
            createCardArray: function () {
                let cards = [];
                let numberOfCards = this.gameGrid[0] * this.gameGrid[1];

                // https://robohash.org/a?bgset=any&size=250x250&set=set4
                let baseurl = 'https://robohash.org/';
                let randSeed = String((new Date(Date.now())).getHours()); // gets new images every hour

                let bgParam = '?bgset=any';
                let setParam = '&set=set' + Math.floor((Math.random() * 5) + 1);

                let width = (this.availableWidth - 20 * (this.gameGrid[1] )) / this.gameGrid[1];
                let height = (window.innerHeight - 310 - 20 * (this.gameGrid[0])) / this.gameGrid[0];
                let robotSize = Math.floor(width);

                if ( width > height ) { robotSize = Math.floor(height); }
                let sizeParam = '&size=250x250';

                for (let i = 0; i < numberOfCards; i += 2) {
                    cards[i] = { url: (baseurl + i + randSeed + bgParam + setParam + sizeParam),
                                 pairValue: i, 
                                 cardId: i, 
                                 size: robotSize,
                                 cardFaceShown: false,
                                 canClick: true, }
                  cards[i+1] = { url: (baseurl + i + randSeed + bgParam + setParam + sizeParam),
                                 pairValue: i,
                                 cardId: (i + 1),
                                 size: robotSize,
                                 cardFaceShown: false, 
                                 canClick: true, }
                }

                this.cardArray = this.shuffleArray(cards);
            },
            shuffleArray: function (array) {
                // https://javascript.info/array-methods#shuffle-an-array
                for (let i = array.length - 1; i > 0; i--) {
                    let j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            },
            eventCardClicked: function(card) {
                if(this.gameStarted == false) {
                    this.gameStarted = true;
                    this.emitGameStarted();
                } // currently this just deactivates the difficulty select

                if (this.cardsClicked.length > 0 
                    && this.cardsClicked[0].cardId !== card.cardId) {
                    this.cardsClicked.push(card);
                    this.numberOfGuesses++;
                } else if (this.cardsClicked.length == 0 ) {
                    this.cardsClicked.push(card);
                    this.numberOfGuesses++;
                }

                this.$emit('event_another_guess', this.numberOfGuesses);
            },
            emitGameStarted: function () {
                this.stoptransitions = false;

                this.timeGameStarted = Date.now();
                this.$emit('event_game_started', this.timeGameStarted);
            },
            emitGameFinished: function () {
                this.timeGameFinished = Date.now();
                let gameTime = Math.floor((this.timeGameFinished - this.timeGameStarted) / 1000);

                this.$emit('event_game_finished', [this.timeGameFinished, this.numberOfGuesses, gameTime]);
            },
        }
    }
</script>
