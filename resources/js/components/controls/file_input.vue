<template>
  <label class="file-input-label">
      <span v-text="caption" class="input-description"></span>
     <input type="file" ref="raport_file" v-on:change="showFileName" class="clockify-report-file" name="clockify_report_file">
     <span v-text="fileName" class="file-name"></span>
  </label>
</template>

<script lang="ts">
  import {Vue, Component, Prop} from 'vue-property-decorator';
  import translator from '@js/translator';
  
@Component({name: 'file-input'})

  export default class FileInput extends Vue {
  
   @Prop({
            type: String,
            required: false,
            default:'File'
    }) readonly caption: string;

    private translations = translator('file_input');
    private fileName:string = this.translations['not_selected'];
   

    showFileName(){
      this.fileName =  (<HTMLFormElement>this.$refs.raport_file).value.split(/(\\|\/)/g).pop();
    }

 
  }
</script>

<style lang="scss" scoped>

@import '~sass/fonts';

.clockify-report-file{
    position:absolute;
    left:0;
    top:-9999px;
}

.file-input-label {
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

.input-description{
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

.file-name {
    background: white;
    @include responsive-font(1.3vw, 16px,Montserrat);
    color: #3C4346;
    padding-left:4px;
    font-weight:bold;
    width: 95%;
    margin: 3px auto;
    display: block;
    overflow:hidden;
    white-space: nowrap;
}

</style>