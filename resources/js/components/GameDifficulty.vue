<template>
    <div class="container">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-outline-warning">
            <input type="radio" name="difficulty" id="difficulty1" value="easy" @change="emitChangeDifficulty"> Easy
        </label>
        <label class="btn btn-outline-warning">
            <input type="radio" name="difficulty" id="difficulty2" value="medium" @change="emitChangeDifficulty" checked> Medium
        </label>
        <label class="btn btn-outline-warning">
            <input type="radio" name="difficulty" id="difficulty3" value="hard" @change="emitChangeDifficulty"> Hard
        </label>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GameDifficulty",
        data: function () {
            return {
                
            }
        },
        mounted() {
            console.log('difficulty Component mounted.')
        },
        watch: {

        },
        methods: {
            emitChangeDifficulty: function(changeDifficulty) {
                this.$emit('event_change_difficulty', changeDifficulty)
                // console.log(changeDifficulty);
                // console.log(changeDifficulty.target.value);
            }
        },
    }
</script>
