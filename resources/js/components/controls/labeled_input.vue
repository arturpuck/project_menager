<template>
 <div ref="container" class="labeled-input-container">
  <label ref="label" class="labeled-input-value-label">
     <span class="text-input-description"><slot></slot></span>
     <input v-bind:disabled="isDisabled" ref="text_input" v-bind:name="name" :required="inputIsRequired" class="labeled-input-value"  v-bind:type="inputType">
  </label>
</div>
</template>

<script lang="ts">
  import {Vue, Component, Prop} from 'vue-property-decorator';
  
@Component
  export default class LabeledInput extends Vue {
  
   @Prop({
            type: Boolean,
            required: false,
            default:false
    }) readonly isDisabled: boolean;

    @Prop({
            type: Boolean,
            required: false,
            default:false
    }) readonly inputIsRequired: boolean;

    @Prop({
            type: String,
            required: true,
    }) readonly name: string;

    @Prop({
            type: String,
            required: false,
            default: 'text'
    }) readonly inputType: string;

     @Prop({
            type: Number,
            required: false,
            default: 0.5
    }) readonly step: string;

    mounted(){

       if(this.inputType == "number"){
           (<HTMLInputElement>this.$refs.text_input).setAttribute('step',this.step);
       }
    }

 
  }
</script>

<style lang="scss" scoped>

@import '~sass/fonts';

.labeled-input-value-label {
    display: flex;
    align-items: baseline;
    background: #242229;
    padding: 3px 10px;
    border-radius: 8px;
    color:white;
    margin: 5px;
    border: 2px solid transparent;
    position:relative;
    height: 2em;
}

.text-input-description{
	white-space: nowrap;
}

.labeled-input-value {
    background: #242229;
    border: none;
    border-bottom: 1px solid transparent;
    color: #fff;
    width: 1%;
    flex-grow:10;
    padding-left:4px;
    box-shadow: 0 0 0 1000px #242229 inset;
}

.labeled-input-value, .text-input-description, .labeled-input-value-label{
    @include responsive-font;
}

.labeled-input-value:focus {
    outline: none;
    border-bottom: 1px solid #86838f;
}

.labeled-input-container{
    display:inline-block;
    min-width: 320px;
    width: 20vw;
}
  
</style>