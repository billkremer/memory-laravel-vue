
<template>
    <div class="card-back"
         v-bind:style="{ width: card.size + 'px', 
                         height: card.size + 'px'}"
         @click="clicked"
    >         <!-- :ref="card.cardId"  -->

        <img 
            v-show="card.cardFaceShown"
            v-bind:src="card.url"
        >
    </div>
</template>

<script>
    export default {
        name: "GameCard",
        data: function () {
            return {
                // cardFaceShown: false,
            }
        },
        props: [
            'card',
            // 'canClick'
],
        mounted() {


        },
        methods: {
            clicked: function($event) {
                if (this.card.canClick == true) {
                    this.card.cardFaceShown=true;
                    // console.log(this.card, $event);
                    this.$emit('event_card_clicked', this.card);
                    this.card.canClick = false;
                }
            },



        },
        
    }
</script>
