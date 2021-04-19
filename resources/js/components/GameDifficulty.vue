<template>
    <div class="container">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label 
            class="btn" 
            :class="{
                'btn-outline-warning': this.disabled == false,
                'btn-outline-warning active focus': this.pickedDifficulty === 'easy' && this.disabled,
                'btn-outline-info': this.pickedDifficulty !== 'easy' && this.disabled,
            }"
        >
            <input type="radio" name="difficulty" id="difficulty1" value="easy"
                v-model="pickedDifficulty" 
                @change="emitChangeDifficulty"
                :disabled="disabled"
            > Easy
        </label>
        <label class="btn" 
            :class="{
                'btn-outline-warning': this.disabled == false,
                'btn-outline-warning active focus': this.pickedDifficulty === 'medium' && this.disabled,
                'btn-outline-info': this.pickedDifficulty !== 'medium' && this.disabled,
            }"
        >
            <input type="radio" name="difficulty" id="difficulty2" value="medium"
                v-model="pickedDifficulty"
                @change="emitChangeDifficulty"
                :disabled="disabled"
            checked> Medium
        </label>
        <label class="btn" 
            :class="{
                'btn-outline-warning': this.disabled == false,
                'btn-outline-warning active focus': this.pickedDifficulty === 'hard' && this.disabled,
                'btn-outline-info': this.pickedDifficulty !== 'hard' && this.disabled,
            }"
        >
            <input type="radio" name="difficulty" id="difficulty3" value="hard"
                v-model="pickedDifficulty"
                @change="emitChangeDifficulty"
                :disabled="disabled"
            > Hard
        </label>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GameDifficulty",
        data: function () {
            return {
                pickedDifficulty: 'medium',
            }
        },
        props: [
            'disabled',
        ],
        mounted() {
            console.log('difficulty Component mounted.')
        },
        watch: {

        },
        methods: {
            emitChangeDifficulty: function() {
                this.$emit('event_change_difficulty', this.pickedDifficulty)
            },
        },
    }
</script>
