
<template>
    <div class="card-back"
         @click="clicked"
         v-bind:style="{ width: card.size + 'px', 
                         height: card.size + 'px'}"
    >
        <transition name="gamecard"  mode="out-in">

            <img 
                v-show="card.cardFaceShown"
                v-bind:src="card.url"
                key="b"
                :alt="'robot number ' + card.pairValue"
            >
        </transition>
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
