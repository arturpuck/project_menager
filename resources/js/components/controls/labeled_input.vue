<template>
 <div ref="container" class="labeled-input-container">
  <label ref="label" class="labeled-input-value-label">
     <span class="text-input-description"><slot></slot></span>
     <input v-bind:disabled="isDisabled" v-bind:value="value" v-on:input="modifyModel"  ref="text_input" v-bind:name="name" :required="inputIsRequired" class="labeled-input-value"  v-bind:type="inputType">
  </label>
</div>
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
    display: flex;
    align-items: baseline;
    background: white;
    border: 1px solid #E3E3E3;
    border-radius: 4px;
    color:#3C4346;
    margin: 5px;
    position:relative;
    height: 2em;
    font-weight:bold;
}

.text-input-description{
  white-space: nowrap;
  line-height:2em;
  padding:0 10px;
  background: #e9e9ea;
  color: #3C4346;
  opacity: 0.5;
  font-weight:bold;
   @include responsive-font(1.2vw, 15px,Montserrat);
}

.labeled-input-value {
    background: white;
    border: none;
    border-bottom: 1px solid transparent;
    @include responsive-font(1.2vw, 15px,Montserrat);
    color: #3C4346;
    width: 1%;
    flex-grow:10;
    padding-left:4px;
    font-weight:bold;
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