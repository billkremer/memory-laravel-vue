
<template>
    <div class="card-back"
         @click="clicked"
         v-bind:style="{ position: 'relative',
                         width: card.size + 'px', 
                         height: card.size + 'px'}"
    >
        <transition-group name="gamecard" mode="out-in">
            <img :style="{ position: 'absolute',
                           'z-index': 10,
                           width: card.size + 'px', 
                           height: card.size + 'px' }"
                         
                 v-show="card.cardFaceShown"
                 v-bind:src="card.url"
                 key="b"
                 :alt="'robot number ' + card.pairValue"
            >
            <p  class="cardImageFallback"
                key="c" 
                v-if="card.cardFaceShown"
            >
                {{'#' + card.pairValue}}
            </p>
        </transition-group>
    </div>
</template>

<script>
    export default {
        name: "GameCard",
        data: function () {
            return {
                
            }
        },
        props: [
            'card',
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
