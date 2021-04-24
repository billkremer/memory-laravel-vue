
<template>
<!-- <transition> -->
    <div class="card-back"
         v-bind:style="{ width: card.size + 'px', 
                         height: card.size + 'px'}"
         @click="clicked"
    >         <!-- :ref="card.cardId"  -->
            <transition name="gamecard"  mode="out-in">
                <!-- <div class="card-cover"
                v-show="!card.cardFaceShown"
                key="a"> -->
                <!-- </div> -->
                <img 
                    v-show="card.cardFaceShown"
                    v-bind:src="card.url"
                    key="b"
                >
            </transition>
    </div>
<!-- </transition> -->
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
            this.$nextTick(function () {

            })
        },
        methods: {
            clicked: function($event) {
                if (this.card.canClick == true) {
                    this.card.cardFaceShown = true;
                    this.card.canClick = false;
                    this.$emit('event_card_clicked', this.card);
                }
            },

        },
        
    }
</script>
