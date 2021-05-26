<template>
    <div class="px-0 col-auto text-right" id="gametimer">
        <h1
            class="timer"
        >
            {{ this.time }}
        </h1>

    </div>
</template>

<script>
    export default {
        name: "GameTimer",
        data: function () {
            return {
                running: false,
                time: 0,
                intervalID: null,
            }
        },
        props: [
            'timeGameStarted',
            'timeGameFinished',
            'gameTime',
        ],
        mounted() {

        },
        watch: {
            timeGameStarted: function (n, o) {
                if (n != o) {
                    this.time = 0;
                    this.running = true;
                    this.startStopTimer()
                }
            },
            timeGameFinished: function (n, o) {
                if (n != o) {
                    this.running = false;
                    this.startStopTimer()
                }
            }
        },
        methods: {
            startStopTimer: function () {
                if (this.running) {
                    this.intervalID = setInterval(this.incrementTime, 1000);
                } else {
                    this.time = this.gameTime;
                    clearInterval(this.intervalID);
                }
            },
            incrementTime() {
                this.time = parseInt(this.time) + 1;
            },
        }
    }
</script>
