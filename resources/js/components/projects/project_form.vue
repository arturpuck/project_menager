<template>
 <form action="" class="project-form">
    <input v-bind:value="csrfToken" type="hidden" name="_token">
    <div class="close-bar">
        <close-button v-bind:description="translations['close']" v-on:buttonClicked="closeForm" />
    </div>

    <fieldset class="project-form-fieldset">
        <caption v-text="translations['project_basic_data']" class="project-form-caption"></caption>
        <labeled-input name="project_name">{{translations['name']}} : </labeled-input>
        <labeled-select name="project_menager_id" v-bind:displayed-values="projectMenagerNames" v-bind:values="projectMenagerIds">
          {{translations['project_menager']}} : 
       </labeled-select>
    </fieldset>

    <fieldset class="project-form-fieldset">
        <caption v-text="translations['work_range']" class="project-form-caption"></caption>
        <multiselect v-model="selectedWorkRangeOptions"
          v-bind:close-on-select="false"
          open-direction="bottom"
          v-bind:options="workRangeOptions">

        </multiselect>
    </fieldset>
   
    <fieldset class="project-form-fieldset">
       <caption v-text="translations['client_data']" class="project-form-caption"></caption>
       <labeled-input name="client_contact_person">{{translations['client_contact_person']}} : </labeled-input>
       <labeled-input name="client_phone_number">{{translations['client_phone_number']}} : </labeled-input>
       <labeled-input name="email">{{translations['client_email']}} : </labeled-input>
       <labeled-select name="client_id" v-bind:displayed-values="clientNames" v-bind:values="clientIds">
          {{translations['client']}} : 
       </labeled-select>
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
  import LabeledSelect from '@jscomponents/controls/labeled_select.vue';
  import Multiselect from 'vue-multiselect';
  
@Component({ components : {
     LabeledInput, CloseButton, LabeledSelect, Multiselect
 }})

  export default class ProjectForm extends Vue {

   @Prop({
            type: Array,
            required: true,
    }) readonly clientNames: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly clientIds: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly projectMenagerNames: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly projectMenagerIds: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly workRangeOptions: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly workRangeIds: string[];

    private translations = translator('project_form');
    private csrfToken:string = '';
    private selectedWorkRangeOptions :[] = []

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