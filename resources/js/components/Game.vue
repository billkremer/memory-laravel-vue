<template>
    <div class="container">


    <div>
        <!-- {{-- left --}} -->
        <div>
            <game-difficulty
                v-on:event_change_difficulty="eventChangeDifficulty($event)"
        
            
            ></game-difficulty>
            <!-- {{-- difficulty radio select --}} -->
        </div>
        <!-- {{-- right --}} -->
        <div>
            <!-- {{-- top score --}} -->
        </div>


    </div>

    <game-board></game-board>








      





    </div>
</template>

<script>
    export default {
        name: "Game",
        data: function () {
            return {
                gameDifficulty: 'medium',
            }
        },
        mounted() {
            console.log('Game Component mounted.')

                let fs = " ┌┬┐┌─┐┌┬┐┌─┐┬─┐┬ ┬ \n" +
                         " │││├┤ ││││ │├┬┘└┬┘ \n" +
                         " ┴ ┴└─┘┴ ┴└─┘┴└─ ┴  ";
                console.log("Welcome to your\n"+'%c'+fs, 'background: #ffd166; color: black');


        },
        watch: {
            gameDifficulty: function (newDifficulty, oldDifficulty ) {
                console.log('new difficulty = ', newDifficulty, 'old difficulty=', oldDifficulty)
            },
        },
        methods: {
            eventChangeDifficulty: function(changeDifficulty) {
                // this.$emit('event_change_difficulty', changeDifficulty)
                console.log(changeDifficulty, 'game');
                console.log(changeDifficulty.target.value);
                this.gameDifficulty = changeDifficulty.target.value;
            }
        },



    }
</script>
