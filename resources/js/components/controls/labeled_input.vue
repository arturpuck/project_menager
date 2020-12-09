<template>
  <label ref="label" class="labeled-input-value-label">
     <div class="text-input-description"><slot></slot></div>
     <input v-bind:disabled="isDisabled" v-bind:value="value" v-on:input="modifyModel"  ref="text_input" v-bind:name="name" :required="inputIsRequired" class="labeled-input-value"  v-bind:type="inputType">
  </label>
</template>

<script lang="ts">
  import {Vue, Component, Prop} from 'vue-property-decorator';
  
@Component({name: 'labeled-input'})
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
    }) readonly step: number;


     @Prop({
            type: [Number, String],
            required: false,
            default: undefined
    }) readonly value: number|string;

    modifyModel(event){
      this.$emit('input', event.target.value);
      this.$emit('aditional', event.target.value);
    }

    mounted(){

       if(this.inputType == "number"){
           (<HTMLInputElement>this.$refs.text_input).setAttribute('step',String(this.step));
       }

    }

 
  }
</script>

<style lang="scss" scoped>

@import '~sass/fonts';

.labeled-input-value-label {
    display: inline-block;
    background: white;
    border: 1px solid black;
    border-radius: 4px;
    color:#3C4346;
    margin: 5px;
    font-weight:bold;
    overflow:hidden;
    min-width: min-content;
    width: 20vw;
}

.text-input-description{
    white-space: nowrap;
    display: block;
    color: #3C4346;
    padding: 0.5vw;
    background: #e9e9ea;
    opacity: 0.5;
    font-weight: bold;
    text-align: center;
   @include responsive-font(1vw, 12px,Montserrat);
}

.labeled-input-value {
    background: white;
    border: none;
    border-bottom: 1px solid transparent;
    @include responsive-font(1.3vw, 16px,Montserrat);
    color: #3C4346;
    padding-left:4px;
    font-weight:bold;
    width: 95%;
    margin: 3px auto;
    display: block;
}

.labeled-input-value:focus {
    outline: none;
    border-bottom: 1px solid #86838f;
}

.labeled-input-container{
    display:inline-block;
    min-width: 320px;
}
  
</style>