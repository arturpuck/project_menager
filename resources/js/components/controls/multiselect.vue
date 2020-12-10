<template>
<div v-on:click="showList" role="listbox" tabindex="-1" v-on:blur="closeList" class="multiselect-container">
    <slot></slot>
   <img src="/images/decoration/Icon feather-plus-circle.svg" alt="">
    <div v-show="listIsVisible" class="options-list-container">
        <ul  class="multiselect-options-list">
             <li v-for="value in values" v-on:click="valueHasBeenAdded(value)" class="multiselect-option">{{value}}</li>
        </ul>
    </div>
</div>
</template>

<script lang="ts">
  import {Vue, Component, Prop} from 'vue-property-decorator';
  import translator from '@js/translator';
  
@Component
  export default class MultiSelect extends Vue {
  
   @Prop({
            type: Array,
            required: true,
    }) readonly values: Array<string>;

    private listIsVisible:boolean = false;

    showList(){
        this.listIsVisible = true;
    }

    valueHasBeenAdded(value:string){
        this.$emit('added',value);
    }

    closeList(){
        this.listIsVisible = false;
    }


  }
</script>

<style lang="scss" scoped>

@import '~sass/fonts';

.fa-plus{
    position: absolute;
    right: 4px;
}

.fa-window-close{
    float: right;
}

.multiselect-container{
	position: relative;
    background: #242229;
    @include responsive-font(1.2vw, 15px,Montserrat);
    border-radius: 5px;
    cursor:pointer;
    display: inline-flex;
    justify-content: space-between;
    align-items: center;
    min-width: 200px;
    margin: 5px;
    padding: 1vw;
    background: white;
    color: black;
    border: 1px solid black;
    &:focus{
        border: 1px solid black;
    }
}

.multiselect-options-list{
    list-style-type: none;
    margin:0;
    padding:0;
}

.multiselect-option{
    @include responsive-font(1.1vw, 15px,Montserrat);
    color:black;
    background:white;
    padding:0.5vw;
    cursor:pointer;
    &:hover{
       background:black;
       color:white;
    }
}

.options-list-container{
    position:absolute;
    top:100%;
    left:0;
    width:100%;
    max-width:50vh;
    overflow-y:auto;
    z-index: 2;
    border: 1px solid black;
    border-radius:2px;
}
  
</style>