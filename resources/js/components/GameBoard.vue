<template>
    <div class="container">



        <!-- <game-card
            v-for="(card, index) in cardArray"
            v-bind:value="card.matchPair"
            v-bind:key="index">
        
        ></game-card> -->







        <button @click="doit1()">click</button>





    </div>
</template>

<script>
    export default {
        name: "GameBoard",
        data: function () {
            return {
                availableWidth: 0,
                cardArray: [],
            }
        },
        props: [
            'disabled',
            'gameGrid',
        ],
        mounted() {
            console.log('Board Component mounted.')
            this.checkWidth();
            this.createCardArray();


        },
        computed: {
//             cardArray: () => {
//                 let cards = [];
//                 let numberOfCards = this.gameGrid[0] * this.gameGrid[1];
//                 // https://robohash.org/a?bgset=any&size=300x300&set=set4
//                 let baseurl = 'https://robohash.org/';
//                 let bgParam = '?bgset=any';
//                 let setParam = '&set=set' + Math.floor((Math.random() * 4) + 1);

// let x = (this.availableWidth - (this.gameGrid[1]-1) * 10)/ this.gameGrid[1];
// let y = (window.innerHeight - 310 - (this.gameGrid[0]-1) * 10) / this.gameGrid[0];


//                 let robotSize = 100; //TODO calculate proper size pick smaller of x or y
//                 let sizeParam = '&size=' + robotSize + 'x' + robotSize;
//                 // console.log('here');
//                 for (let i = 0; i <= numberOfCards; i + 2) {
//                     cards[i] = {url: (baseurl + i + bgParam + setParam + sizeParam)  }
//                     cards[i+1] = {url: (baseurl + i + bgParam + setParam + sizeParam)  }

//                 }

//                 // console.log(cards, 'cards');

//                 return this.shuffleArray(cards);

//             }


        },
        methods: {
            createCardArray: function () {
                let cards = [];
                let numberOfCards = this.gameGrid[0] * this.gameGrid[1];
                // https://robohash.org/a?bgset=any&size=300x300&set=set4
                let baseurl = 'https://robohash.org/';
                let bgParam = '?bgset=any';
                let setParam = '&set=set' + Math.floor((Math.random() * 4) + 1);

let x = (this.availableWidth - (this.gameGrid[1]-1) * 10)/ this.gameGrid[1];
let y = (window.innerHeight - 310 - (this.gameGrid[0]-1) * 10) / this.gameGrid[0];


                let robotSize = 100; //TODO calculate proper size pick smaller of x or y
                let sizeParam = '&size=' + robotSize + 'x' + robotSize;
                console.log('here');
                for (let i = 0; i < numberOfCards; i += 2) {
                    cards[i] = {url: (baseurl + i + bgParam + setParam + sizeParam),
                                pairValue: i, 
                                cardNumber: i, }
                    cards[i+1] = {url: (baseurl + i + bgParam + setParam + sizeParam),
                                pairValue: i,
                                cardNumber: (i + 1), }

                }


                this.cardArray = this.shuffleArray(cards);
                // this.cardArray = (cards);
            },
            checkWidth: function() {
                // this checks the form width to help determine whether headers and extra space is necessary
                // this.availableWidth =  window.innerWidth;
                this.availableWidth =  document.getElementById('gamegame').clientWidth;
                
            },
            doit1: function() {
                this.checkWidth();
                var element = document.getElementById('gamegame');
let x = (this.availableWidth - (this.gameGrid[1]-1) * 10)/ this.gameGrid[1];
let y = (window.innerHeight - 310 - (this.gameGrid[0]-1) * 10) / this.gameGrid[0];
                console.log(this.availableWidth, this.gameGrid, element.clientWidth);
                console.log(x,y);
                // this.createCardArray();
                console.log(this.cardArray);
            },
            shuffleArray: function (array) {
                // https://javascript.info/array-methods#shuffle-an-array
                for (let i = array.length - 1; i > 0; i--) {
                    let j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            },

        }


    }
</script>
