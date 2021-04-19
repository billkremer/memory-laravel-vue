<template>
    <div class="container">



        <!-- <game-card
            v-for="(card, index) in cardArray"
            v-bind:value="card.matchPair"
            v-bind:key="index">
        
        ></game-card> -->












    </div>
</template>

<script>
    export default {
        name: "GameBoard",
        data: function () {
            return {
                
            }
        },
        props: [
            'disabled',
            
        ],
        mounted() {
            console.log('Board Component mounted.')
            this.checkWidth();

        },
        computed: {
            cardArray: () => {
                
                




            }


        },
        methods: {
            checkWidth: function() {
                // this checks the form width to help determine whether headers and extra space is necessary
                this.availableWidth =  window.innerWidth;
            },

        }


    }
</script>
