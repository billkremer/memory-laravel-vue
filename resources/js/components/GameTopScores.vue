<template>
    <div class="container-md">
        <div
            class="score-text"
            v-for="score in topScores"
            v-bind:value="score.points"
            :key="score.difficulty + score.date"
        >
            <span>{{ score.difficulty }}</span>: {{ score.clicks }} clicks, {{ score.seconds }} seconds on {{ score.date}}
        </div>

    </div>
</template>

<script>
    export default {
        name: "GameTopScores",
        data: function () {
            return {
                
            }
        },
        props: [
            'topScores',
        ],
        mounted() {

        }
    }
</script>
