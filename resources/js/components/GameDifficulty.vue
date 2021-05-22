<template>
    <div class="container-md" id="gameDifficulty">

        <div class="btn-group btn-group-toggle" data-toggle="buttons">

            <label 
                v-for="(difficulty, index) in difficultyConfig"
                v-bind:key="index"
                @click='emitChangeDifficulty'
                class="btn" 
                :class="{
                    'btn-outline-warning': disabled == false,
                    'btn-outline-warning active focus': pickedDifficulty === difficulty[0],
                    'btn-outline-info': pickedDifficulty !== difficulty[0] && disabled,
                }"
            >

                <input type="radio" name="difficulty" 
                    :id="'difficulty' + index" 
                    :value="difficulty[0]"
                    v-model="pickedDifficulty"
                    @change="emitChangeDifficulty"
                    :disabled="disabled"
                    :checked="pickedDifficulty == difficulty[0] ? 'checked' : ''"
                > {{difficulty[0]}}
            </label>

        </div>

    </div>
</template>

<script>
    export default {
        name: "GameDifficulty",
        data: function () {
            return {
                pickedDifficulty: '',
            }
        },
        props: [
            'disabled',
            'difficultyConfig',
        ],
        mounted() {
            this.$nextTick(function () {
                this.createDifficultyArray();
            })
        },
        watch: {
            disabled: function (newDis, oldDis) {
                if (newDis == false && oldDis == true) {
                    this.createDifficultyArray();
                    this.$emit('event_change_difficulty', this.pickedDifficulty)
                }
            },
        },
        methods: {
            emitChangeDifficulty: function() {
                if (!this.disabled) {
                    this.$emit('event_change_difficulty', this.pickedDifficulty)
                }
            },
            createDifficultyArray: function () {
                this.difficultyConfig.sort(function(a,b) {
                    return (a[1][0] * a[1][1] - b[1][0] * b[1][1]);
                })
                if (this.pickedDifficulty === '') {
                    let x = Math.ceil(this.difficultyConfig.length / 2 ) - 1;
                    this.pickedDifficulty = this.difficultyConfig[x][0];
                }
            },
        },
    }
</script>
