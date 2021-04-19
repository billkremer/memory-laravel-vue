<template>
    <div class="container">



        <div
            v-for="score in topScores"
            v-bind:value="score.points"
            :key="score.points"
            >
            {{ score.name }} {{ score.points }} 
        </div>






    </div>
</template>

<script>
    export default {
        name: "GameBoard",
        data: function () {
            return {
                
            }
        },
        mounted() {
            console.log('Board Component mounted.')
        }
    }
</script>
