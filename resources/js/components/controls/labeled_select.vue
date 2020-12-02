<template>
<div class="described-select-container">
    <label class="select-label" >
        <span class="select-description">
            <slot></slot>
        </span>
        <select v-bind:name="name" v-bind:disabled="inputIsDisabled" v-on:input="emitData" v-bind:value="value" ref="select_value" class="described-select">
            <option value="">---</option>
            <option v-if="selectValues" v-for="(value, index) in displayedSelectValues" v-bind:value="selectValues[index]">{{value}}</option>
            <option v-if="!selectValues" v-for="(value, index) in displayedSelectValues" v-bind:value="displayedSelectValues[index]">{{value}}</option>
        </select>
    </label>
</div>
</template>

<script lang="ts">
  import {Vue, Component, Prop} from 'vue-property-decorator';
  
@Component
  export default class LabeledSelect extends Vue {
  
   @Prop({
            type: Array,
            required: false,
            default: function () {return [];}
    }) readonly displayedValues;

    @Prop({
            type: Array,
            required: false,
            default: function () {return [];}
    }) readonly values;

    @Prop({
            type: String,
            required: true,
    }) readonly name: string;

    @Prop({
            type: [String, Number],
            required: false,
            default:0
    }) readonly value: string | number;

    @Prop({
            type: Boolean,
            required: false,
            default:false
    }) readonly isDisabled: boolean;

    @Prop({
            type: [String, Number],
            required: false,
            default: undefined
    }) readonly identifier:  string | number;

    private dynamicDisabledState:boolean = null;
    private dynamicDisplayedValues:Array<string> = null;
    private dynamicValues:Array<string> = null;


    emitData(event){
       this.$emit('input',event.target.value);
    }
    
    get inputIsDisabled() : boolean{

        return (this.dynamicDisabledState === null) ? this.isDisabled : this.dynamicDisabledState;
    }

    get selectValues():Array<string>{

        return (this.dynamicValues === null) ? this.values : this.dynamicValues;
    }

    get displayedSelectValues():Array<string>{

        return (this.dynamicDisplayedValues === null) ? this.displayedValues : this.dynamicDisplayedValues;
    }

    created(){

        if(this.identifier){
            this.$root.$on(`modifyValues${this.identifier}`, this.modifyValues);
            this.$root.$on(`modifyDisabledState${this.identifier}`, this.modifyDisabledState);
        }
    }

    modifyValues(values){
       
        if(values['displayed']){
            this.dynamicDisplayedValues = values['displayed'];
        }

        if(values['values']){
            this.dynamicValues = values['values'];
        }
    }

    modifyDisabledState(state){
        this.dynamicDisabledState = state;
    }


    

  }
</script>

<style lang="scss" scoped>

@import '~sass/fonts';

.select-label{
	display:flex;
	align-items: center;
	border: 1px solid #E3E3E3;
    border-radius: 4px;
	padding: 3px 3px 3px 0;
	color:#3C4346;
	margin: 5px;
	background:white;
	position:relative;
    height: 2em;
}

.select-description{
    white-space: nowrap;
    color:#3C4346;
    line-height: 2em;
    padding: 0 5px;
    background: #e9e9ea;
    opacity: 0.5;
    font-weight:bold;
}

.described-select{
	width:1%;
	flex-grow: 10;
	color:#3C4346;
	border: none;
	background:white;
    outline:none;
    font-weight:bold; 
}

.described-select, .select-description, .select-label{
    @include responsive-font(1.2vw, 15px,Montserrat);
}

.described-select-container{
    min-width: 320px;
    width: 20vw;
    display:inline-block;
}
  
</style>