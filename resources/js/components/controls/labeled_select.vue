<template>
    <label class="select-label">
        <div class="select-description">
            <slot></slot>
        </div>
        <select v-bind:name="name" v-bind:disabled="isDisabled" v-on:input="emitData" v-bind:value="value" ref="select_value" class="described-select">
            <option value="" >---</option>
            <option v-if="values" v-for="(value, index) in displayedValues" v-bind:value="values[index]">{{value}}</option>
            <option v-if="!values" v-for="(value, index) in displayedValues" v-bind:value="displayedValues[index]">{{value}}</option>
        </select>
    </label>
</template>

<script lang="ts">
  import {Vue, Component, Prop} from 'vue-property-decorator';
  
@Component
  export default class LabeledSelect extends Vue {
  
   @Prop({
            type: Array,
            required: true,
    }) readonly displayedValues;

    @Prop({
            type: Array,
            required: false,
            default: undefined
    }) readonly values;

    @Prop({
            type: String,
            required: true,
    }) readonly name: string;

    @Prop({
            type: [String, Number],
            required: false,
            default:''
    }) readonly value: string | number;

    @Prop({
            type: Boolean,
            required: false,
            default:false
    }) readonly isDisabled: boolean;


    emitData(event){
       this.$emit('input',event.target.value);
    }

  }
</script>

<style lang="scss" scoped>
@import '~sass/components/labeled_select';
  
</style>