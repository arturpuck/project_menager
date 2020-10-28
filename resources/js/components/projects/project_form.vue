<template>
 <form action="" class="project-form">
    <input v-bind:value="csrfToken" type="hidden" name="_token">
    <div class="close-bar">
        <close-button v-bind:description="translations['close']" v-on:buttonClicked="closeForm" />
    </div>
   
    <fieldset class="project-form-fieldset">
       <caption v-text="translations['client_data']" class="project-form-caption"></caption>
       <labeled-input name="client_name">{{translations['client_name_and_second_name']}} : </labeled-input>
       <labeled-input name="client_phone_number">{{translations['client_phone_number']}} : </labeled-input>
       <labeled-input name="email">{{translations['client_email']}} : </labeled-input>
    </fieldset>

    <fieldset class="project-form-fieldset">
       <caption v-text="translations['invoice_data']" class="project-form-caption"></caption>
       <labeled-input name="addres">{{translations['addres']}} : </labeled-input>
       <labeled-input name="company_name">{{translations['company_name']}} : </labeled-input>
       <labeled-input name="tax_identification_number">{{translations['tax_identification_number']}} : </labeled-input>
    </fieldset>
 </form>
</template>

<script lang="ts">
  import {Vue, Component, Prop} from 'vue-property-decorator';
  import translator from '@js/translator';
  import LabeledInput from '@jscomponents/controls/labeled_input.vue';
  import CloseButton from '@jscomponents/controls/close_button.vue';
  
@Component({ components : {
     LabeledInput, CloseButton
 }})

  export default class ProjectForm extends Vue {

    private translations = translator('project_form');
    private csrfToken:string = '';

    logout(){
      (<HTMLFormElement>this.$refs.logout_form).submit();
    }

    closeForm(){
        this.$emit('close');
    }

    created(){
        this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
    }

 
  }
</script>

<style lang="scss" scoped>

@import '~sass/fonts';

.project-form-caption{
    @include responsive-font(1.5vw,22px);
    color:black;
    display: block;
    padding: 5px 0 5px 10px;
    text-align: left;
}

.project-form-fieldset{
    border:2px solid black;
    border-radius:5px;
    margin: 5px 0;
}

.project-form{
    padding: 5px;
    position:fixed;
    top:0;
    width:100%;
    left:0;
    overflow-y:auto;
    background:#fbffff;
}

.close-bar{
    text-align:right;
    padding:5px;
    background:black;
}

  
</style>