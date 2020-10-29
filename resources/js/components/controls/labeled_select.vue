<template>
<div class="described-select-container">
    <label class="select-label" >
        <span class="select-description">
            <slot></slot>
        </span>
        <select v-bind:name="name" ref="select_value" class="described-select">
            <option v-if="values" v-for="(value, index) in displayedValues" v-bind:value="values[index]">{{value}}</option>
            <option v-if="!values" v-for="(value, index) in displayedValues" v-bind:value="displayedValues">{{value}}</option>
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
            required: true,
    }) readonly displayedValues: Array<string>;

    @Prop({
            type: Array,
            required: false,
            default:undefined
    }) readonly values: Array<string>;

    @Prop({
            type: String,
            required: true,
    }) readonly name: Array<string>;


  }
</script>

<style lang="scss" scoped>

@import '~sass/fonts';

.select-label{
	display:flex;
	align-items: baseline;
	border-radius:7px;
	padding: 3px 10px;
	color:white;
	margin: 5px;
	background:#242229;
	position:relative;
    border: 2px solid transparent;
    height: 2em;
}

.select-description{
	white-space: nowrap;
}

.described-select{
	width:1%;
	flex-grow: 10;
	color:white;
	border: none;
	background:#242229;
	outline:none;
}

.described-select, .select-description, .select-label{
    @include responsive-font;
}

.described-select-container{
    min-width: 320px;
    width: 20vw;
    display:inline-block;
}
  
</style>