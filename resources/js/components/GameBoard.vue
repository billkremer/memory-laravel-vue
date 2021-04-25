<template>
    <div class="row container" ref="gameboard" id="gameboard">


        <game-card
            v-for="card in cardArray"
            v-bind:card="card"
            v-bind:key="card.cardId"
            v-bind:ref="card.cardId"
            v-on:event_card_clicked="eventCardClicked(card)"
        ></game-card>

        <!-- <br><button @click="doit1()">click</button> -->

    </div>
</template>

<script>
    export default {
        name: "GameBoard",
        data: function () {
            return {
                availableWidth: 0,
                cardArray: [],
                cardsClicked: [],
                numberOfGuesses: 0,
                numberOfMatches: 0,
                gameStarted: false,
                gameFinished: false,


            }
        },
        props: [
            'disabled',
            'gameGrid',
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
                this.checkWidth();
                
            },
            checkWidth: function() {
                this.availableWidth = this.$refs.gameboard.clientWidth;
                this.createCardArray();
            },
            createCardArray: function () {
                let cards = [];
                let numberOfCards = this.gameGrid[0] * this.gameGrid[1];

                // https://robohash.org/a?bgset=any&size=300x300&set=set4
                let baseurl = 'https://robohash.org/';
                let randSeed = String(Date.now()).slice(-6);

                let bgParam = '?bgset=any';
                let setParam = '&set=set' + Math.floor((Math.random() * 5) + 1);

                let width = (this.availableWidth - 20 * (this.gameGrid[1] )) / this.gameGrid[1];
                let height = (window.innerHeight - 310 - 20 * (this.gameGrid[0])) / this.gameGrid[0];
                let robotSize = Math.floor(width);

                if ( width > height ) { robotSize = Math.floor(height); }
                let sizeParam = '&size=' + robotSize + 'x' + robotSize;


                for (let i = 0; i < numberOfCards; i += 2) {
                    cards[i] = {url: (baseurl + i + randSeed + bgParam + setParam + sizeParam),
                    // TODO add a substring of epoch time between i & bgparam

                                pairValue: i, 
                                cardId: i, 
                                size: robotSize,
                                cardFaceShown: false,
                                canClick: true, }
                    cards[i+1] = {url: (baseurl + i + randSeed + bgParam + setParam + sizeParam),
                                        // TODO add a substring of epoch time between i & bgparam

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

                // console.log('gameboard card clicked', this.cardsClicked, card);

                if (this.cardsClicked.length > 0 
                    && this.cardsClicked[0].cardId !== card.cardId) {
                    this.cardsClicked.push(card);
                    this.numberOfGuesses++;
                } else if (this.cardsClicked.length == 0 ) {
                    this.cardsClicked.push(card);
                    // console.log('here', card);
                    // card.canClick = false;
                    // this.$refs[this.cardsClicked[0].cardId][0].card.canClick = false;
                                        // console.log('here2', card);

                    this.numberOfGuesses++;
                }

                this.$emit('event_another_guess', this.numberOfGuesses);

            },
            emitGameStarted: function () {
                this.$emit('event_game_started', 'started');
            },
            emitGameFinished: function () {
                this.$emit('event_game_finished', this.numberOfGuesses);
            },

        }


    }
</script>
