<template>
    <div class="container">



        <div
            v-for="score in topScores"
            v-bind:value="score.points"
            :key="score.points"
            >
            {{ score.name }} {{ score.points }} 
        </div>





        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
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
