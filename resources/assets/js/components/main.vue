<template>
    <div class="container">
        <input type="number" v-model="sinValue" />
        Result sin : {{ outputSin }} /  {{ sinValue }}
        <input type="button" value="Calc" @click="getC" />
    </div>
</template>

<script>
    export default {
        name:'calculator',

        data(){
        return {
            sinValue: 0,
            outputSin: 0,
        };
    },

    methods:{
        getC(){
            this.outputSin = Math.sin(this.sinValue);
        }
    }

    }
</script>

<style>
</style>
