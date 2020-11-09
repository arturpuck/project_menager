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
         <ul class="rectangular-elements-list">
            <li v-for="task in chosenTasksList" class="rectangular-list-element">
                {{task}}
                <close-button class="remove-rectangular-element-icon" v-bind:description="translations['close']" v-on:click.native="removeTaskFromList(task)" /> 
            </li>
         </ul>
         <multiselect v-on:added="addItemToTasksList" v-bind:values="tasks" >{{translations['choose_range']}}</multiselect> 
    </fieldset>

    <fieldset class="project-form-fieldset">
        <caption v-text="translations['engaged_persons']" class="project-form-caption"></caption>
         <ul class="rectangular-elements-list">
            <li v-for="employee in chosenEmployeesList" class="rectangular-list-element">
                {{employee}}
                <close-button class="remove-rectangular-element-icon" v-bind:description="translations['close']" v-on:click.native="removeEmployeeFromList(employee)" /> 
            </li>
         </ul>
         <multiselect v-on:added="addItemToEmployeesList" v-bind:values="employees" >{{translations['choose_persons']}}</multiselect> 
    </fieldset>

    <fieldset class="project-form-fieldset">
        <caption v-text="translations['work_stages']" class="project-form-caption"></caption>
          <positive-button class="add-stage-button" v-on:click.native="addWorkStage">
              {{translations['add_work_stage']}}
          </positive-button>
          <ul class="stages-list">
              <li v-for="workStage in workStages"  class="stage-list-element">
                 <labeled-select name="work_stages[]" v-model="workRangeValues[workStage]" v-bind:displayed-values="tasks" >
                    {{translations['work_range']}} : 
                 </labeled-select>
                 <labeled-select name="engaged_persons[]" v-model="workStageEngagedPersons[workStage]" v-bind:displayed-values="employees" >
                    {{translations['engaged_person']}} : 
                 </labeled-select>
                 <labeled-input input-type="number" v-model="estimatedHours[workStage]" name="estimated_number_of_hours[]">{{translations['estimated_number_of_hours']}} : </labeled-input>
                 <labeled-input input-type="number" v-model="estimatedCosts[workStage]" v-bind:step="0.1" name="estimated_ammount_of_money[]">{{translations['estimated_ammount_of_money']}} : </labeled-input>
                 <span class="datepicker-wrapper">
                     <span class="datepicker-description">
                         {{translations['start_at']}} :
                     </span>
                     <datepicker input-class="calendar-input" v-model="startDates[workStage]" name="date_start[]"></datepicker>
                 </span>
                 <span class="datepicker-wrapper">
                     <span class="datepicker-description">
                         {{translations['deadline']}} :
                     </span>
                     <datepicker input-class="calendar-input" v-model="deadLineDates[workStage]" name="dead_line_date[]"></datepicker>
                 </span>
                 <close-button description="translations['remove_work_stage']" v-on:click.native="removeWorkStage(workStage)">
                 </close-button>
              </li>
          </ul>
    </fieldset>

     <fieldset class="project-form-fieldset">
        <caption v-text="translations['payment_stages']" class="project-form-caption"></caption>
         <positive-button class="add-stage-button" v-on:click.native="addPaymentStage">
              {{translations['add_payment_stage']}}
          </positive-button>
        <ul class="stages-list">
          <li v-for="paymentStage in paymentStages"  class="stage-list-element">
            <labeled-input input-type="text" name="payment_stage_names[]">{{translations['name']}} : </labeled-input>
            <labeled-input input-type="number" v-on:input="setPaymentStageMoneyAmmount(paymentStage, $event)" v-bind:step="0.5" name="payment_ammounts[]">{{translations['ammount']}} : </labeled-input>
            <span class="datepicker-wrapper">
                <span class="datepicker-description">
                    {{translations['estimated_date_of_invoice']}} :
                </span>
                <datepicker input-class="calendar-input" v-model="paymentStageDates[paymentStage]" name="paymentStageDates[]"></datepicker>
            </span>
            <labeled-select name="payment_status[]" v-bind:displayed-values="paymentStatusesValues" v-bind:values="paymentStatusesIds">
                {{translations['status']}} : 
            </labeled-select>
            <close-button description="translations['remove_payment_stage']" v-on:click.native="removePaymentStage(paymentStage)">
                 </close-button>
          </li>
        </ul>
    </fieldset>
   
    <fieldset class="project-form-fieldset">
       <caption v-text="translations['client_data']" class="project-form-caption"></caption>
       <labeled-input name="client_contact_person">{{translations['client_contact_person']}} : </labeled-input>
       <labeled-input input-type="tel" name="client_phone_number">{{translations['client_phone_number']}} : </labeled-input>
       <labeled-input input-type="email"  name="email">{{translations['client_email']}} : </labeled-input>
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

    <fieldset class="project-form-fieldset">
       <caption v-text="translations['summary']" class="project-form-caption"></caption>
       <span class="payment-summary-container">
          <span v-text="translations['total_cost']"></span> : 
          <span v-text="paymentSummary"></span> <span v-text="translations['current_currency']"></span>
       </span>
        <span class="datepicker-wrapper">
            <span class="datepicker-description">
                {{translations['finish_date']}} :
            </span>
            <datepicker input-class="calendar-input"  name="finish_date"></datepicker>
        </span>
    </fieldset>
 </form>
</template>

<script lang="ts">
  import {Vue, Component, Prop, Watch} from 'vue-property-decorator';
  import translator from '@js/translator';
  import LabeledInput from '@jscomponents/controls/labeled_input.vue';
  import CloseButton from '@jscomponents/controls/close_button.vue';
  import LabeledSelect from '@jscomponents/controls/labeled_select.vue';
  import Multiselect from '@jscomponents/controls/multiselect.vue';
  import Datepicker from 'vuejs-datepicker';
  
@Component({ components : {
     LabeledInput, CloseButton, LabeledSelect, Multiselect, Datepicker
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

    @Prop({
            type: Array,
            required: true,
    }) readonly tasks: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly employees: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly paymentStatusesValues: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly paymentStatusesIds: string[];

    private translations = translator('project_form');
    private csrfToken:string = '';
    private selectedWorkRangeOptions :[] = [];
    private chosenTasksList: string[] = [];
    private chosenEmployeesList: string[] = [];
    private engagedPersons:object = {};

    private workStageIndex: number = 0;
    private workStages: Array<number> = [];
    private startDates:object = {};
    private deadLineDates:object = {};
    private workRangeValues:object = {};
    private estimatedHours:object = {};
    private estimatedCosts:object = {};
    private workStageEngagedPersons:object = {};
    

    private paymentStageIndex:number = 0;
    private paymentStageDates:object = {};
    private paymentStagesMoneyAmmount:object = {};
    private paymentStages: Array<number> = [];
    private paymentSummary:number = 0;

    logout(){
      (<HTMLFormElement>this.$refs.logout_form).submit();
    }

    closeForm(){
        this.$emit('close');
    }

    addItemToTasksList(task:string){

        if(!this.chosenTasksList.includes(task)){
           this.chosenTasksList.push(task);
        }
       
    }

    addItemToEmployeesList(employee:string){

        if(!this.chosenEmployeesList.includes(employee)){
           this.chosenEmployeesList.push(employee);
        }

    }

    removeTaskFromList(task:string){
         this.chosenTasksList = this.chosenTasksList.filter(element => element != task);
    }

    removeEmployeeFromList(employee:string){
         this.chosenEmployeesList = this.chosenEmployeesList.filter(element => element != employee);
    }

    addWorkStage(){
        ++this.workStageIndex;
        this.deadLineDates[this.workStageIndex] = new Date();
        this.startDates[this.workStageIndex] = new Date();
        this.workRangeValues[this.workStageIndex] = 0;
        this.estimatedHours[this.workStageIndex] = 0;
        this.estimatedCosts[this.workStageIndex] = 0;
        this.workStageEngagedPersons[this.workStageIndex] = 0;
        this.workStages.push(this.workStageIndex);
    }

    addPaymentStage(){
        ++this.paymentStageIndex;
        this.paymentStageDates[this.paymentStageIndex] = new Date();
        this.paymentStagesMoneyAmmount[this.paymentStageIndex] = 0;
        this.paymentStages.push(this.paymentStageIndex);
    }

    removeWorkStage(workStageID:number){
        this.workStages = this.workStages.filter(value => value != workStageID);
        delete this.deadLineDates[workStageID];
        delete this.startDates[workStageID];
        delete this.workRangeValues[workStageID];
        delete this.estimatedHours[workStageID];
        delete this.estimatedCosts[workStageID];
        delete this.workStageEngagedPersons[workStageID];
    }

    removePaymentStage(paymentStageID:number){
        this.paymentStages = this.paymentStages.filter(value => value != paymentStageID);
        delete this.paymentStageDates[paymentStageID];
    }


    setPaymentStageMoneyAmmount(paymentStageID, event){
          this.paymentStagesMoneyAmmount[paymentStageID] = event;
          this.updatePaymentSummary();
    }

    updatePaymentSummary(){
        let totalCost:number = 0;
        Object.values(this.paymentStagesMoneyAmmount).forEach(cost => totalCost += parseFloat(cost));
        this.paymentSummary = totalCost;
    }

    created(){
        this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
    }

  }
</script>

<style lang="scss" >

@import '~sass/fonts';

.payment-summary-container{
    display:inline-block;
    padding:6px;
    background:#242229;
    color:white;
    @include responsive-font();
    border-radius: 4px;
    margin: 4px;
}

.datepicker-description{
  color:white;
  @include responsive-font();
}

.datepicker-wrapper{
    padding:4px;
    background: #242229;
    border-radius:5px;
    display:inline-flex;
    flex-wrap:nowrap;
    align-items: baseline;
}

.calendar-input{
   background: #242229;
   color:white;
   padding:4px;
   border: none;
}

.stage-list-element{
    border: 2px solid gray;
    margin:4px 0;
}

.stages-list{
    list-style-type: none;
    padding:4px;
    margin:0;
}

.add-stage-button{
    margin:5px;
    display: block;
}

.remove-rectangular-element-icon{
    width:1.8vw;
    height:1.8vw;
}

.rectangular-elements-list{
    list-style-type: none;
    padding:4px;
    margin:0;
}

.rectangular-list-element{
    padding:5px;
    display:inline-block;
    margin:5px;
    background:black;
    color:white;
    @include responsive-font();
}

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
    max-height: 100vh;
}

.close-bar{
    text-align:right;
    padding:5px;
    background:black;
}

  
</style>