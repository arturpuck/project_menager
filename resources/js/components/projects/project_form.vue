<template>
 <form method="POST" action="/add-project" class="project-form">
    <input v-bind:value="csrfToken" type="hidden" name="_token">
    <input v-if="projectId" type="hidden" v-bind:value="projectId" name="project_id">
    <div class="introductory-bar offset-bar">
        <h2 v-text="translations['adding_project']" class="header"></h2>
        <close-button v-bind:description="translations['close']" v-on:click.native="closeForm" />
    </div>

    <fieldset class="project-form-fieldset">
        <caption v-text="translations['project_basic_data']" class="project-form-caption"></caption>
        <labeled-input v-model="projectName" name="project_name">{{translations['name']}} : </labeled-input>
        <labeled-select name="project_menager_id" v-model="projectMenagerID" v-bind:displayed-values="projectMenagerNames" v-bind:values="projectMenagerIds">
          {{translations['project_menager']}} 
       </labeled-select>
       <labeled-select name="account_id" v-model="accountID" v-bind:displayed-values="accountsNames" v-bind:values="accountsIds">
          {{translations['account']}}
       </labeled-select>
    </fieldset>

    <fieldset class="project-form-fieldset">
        <caption v-text="translations['work_stages']" class="project-form-caption"></caption>
          <positive-button class="add-stage-button colored-button" v-on:click.native="addWorkStage">
              {{translations['add_work_stage']}}
              <img class="button-icon" src="/images/decoration/Group 61.svg"></img>
          </positive-button>
          <ul class="stages-list">
              <li v-for="workStage in workStages"  class="stage-list-element">
                 <labeled-select name="work_stages[]" v-model="workRangeValues[workStage]" v-on:input="fetchEmployeesHavingDesiredSkill(workStage)" v-bind:values="tasksIds" v-bind:displayed-values="tasksNames" >
                    {{translations['work_range']}} 
                 </labeled-select>
                    <label v-on:click="notifyUserWhyInputIsDisabled(workStage)" class="select-label" >
                        <span v-text="translations['engaged_persons']" class="select-description"></span>
                        <select name="work_stage_engaged_persons[]" v-bind:disabled="disabledEmployeeInputs[workStage]" v-model="employeeWithDesiredSkill[workStage]"  class="described-select">
                            <option value="">---</option>
                            <option v-for="(value, index) in employeesWithDesiredSkillNames[workStage]" v-bind:value="employeesWithDesiredSkillIds[workStage][index]">{{value}}</option>
                        </select>
                    </label>
                 <labeled-input input-type="number" v-model="estimatedHours[workStage]" name="work_stage_estimated_number_of_hours[]">{{translations['estimated_number_of_hours']}} : </labeled-input>
                 <span class="datepicker-wrapper">
                     <span class="datepicker-description">
                         {{translations['start_at']}}
                     </span>
                     <span class="datepicker-bottom-container">
                        <datepicker input-class="calendar-input" name="work_stage_date_start[]" format="yyyy-MM-dd" v-model="startDates[workStage]" ></datepicker>
                        <img src="/images/decoration/Icon awesome-calendar-alt.svg" alt="" class="calendar-icon">
                     </span>
                 </span>
                 <span class="datepicker-wrapper">
                     <span class="datepicker-description">
                         {{translations['deadline']}}
                     </span>
                     <span class="datepicker-bottom-container">
                        <datepicker input-class="calendar-input" format="yyyy-MM-dd" name="work_stage_dead_line_date[]" v-model="deadLineDates[workStage]" ></datepicker>
                        <img src="/images/decoration/Icon awesome-calendar-alt.svg" alt="" class="calendar-icon">
                     </span>
                 </span>
                 <button type="button" v-on:click="removeWorkStage(workStage)" class="removal-button">
                  {{translations['remove_work_stage']}}
                  <close-decoration class="button-icon"></close-decoration>
                 </button>
              </li>
          </ul>
    </fieldset>

     <fieldset class="project-form-fieldset">
        <caption v-text="translations['payment_stages']" class="project-form-caption"></caption>
         <positive-button class="add-stage-button colored-button" v-on:click.native="addPaymentStage">
              {{translations['add_payment_stage']}}
              <img class="button-icon" src="/images/decoration/Group 61.svg"></img>
          </positive-button>
        <ul class="stages-list">
          <li v-for="paymentStage in paymentStages"  class="stage-list-element">
            <labeled-input v-model="paymentStageNames[paymentStage]" input-type="text" name="payment_stage_names[]">{{translations['name']}} : </labeled-input>
            <labeled-input input-type="number" v-on:aditional="updatePaymentSummary" v-model="paymentStagesMoneyAmmount[paymentStage]" v-bind:step="0.5" name="payment_ammounts[]">{{translations['ammount']}} : </labeled-input>
            <span class="datepicker-wrapper">
                <span class="datepicker-description">
                    {{translations['estimated_date_of_invoice']}} :
                </span>
                <span class="datepicker-bottom-container">
                    <datepicker input-class="calendar-input" name="payment_stage_dates[]" format="yyyy-MM-dd" v-model="paymentStageDates[paymentStage]" ></datepicker>
                    <img src="/images/decoration/Icon awesome-calendar-alt.svg" alt="" class="calendar-icon">
                </span>
            </span>
            <labeled-select name="payment_status[]" v-model="paymentStageStatuses[paymentStage]" v-bind:displayed-values="paymentStatusesValues" v-bind:values="paymentStatusesIds">
                {{translations['status']}} : 
            </labeled-select>
            <button type="button" v-on:click="removePaymentStage(paymentStage)" class="removal-button">
                {{translations['remove_payment_stage']}}
                <close-decoration class="button-icon"></close-decoration>
            </button>
          </li>
        </ul>
    </fieldset>
   
    <fieldset class="project-form-fieldset relative-container">
        <relative-shadow-container  v-show="fetchingClientDataInProgress">
            <expect-circle v-bind:label="translations['fetching_client_data']" ></expect-circle>
        </relative-shadow-container>
       <caption v-text="translations['client_data']" class="project-form-caption"></caption>
       <labeled-input v-model="clientContactPerson" name="client_contact_person">{{translations['client_contact_person']}}</labeled-input>
       <labeled-input v-model="clientPhoneNumber" input-type="tel" name="client_phone_number">{{translations['client_phone_number']}}</labeled-input>
       <labeled-input input-type="email" v-model="clientEmail"  name="client_email">{{translations['client_email']}}</labeled-input>
       <labeled-select name="client_id" v-model="clientId" v-on:input="fetchClientsData" v-bind:displayed-values="clientNames" v-bind:values="clientIds">
          {{translations['client']}} : 
       </labeled-select>
    </fieldset>

    <fieldset class="project-form-fieldset">
       <caption v-text="translations['invoice_data']" class="project-form-caption"></caption>
       <labeled-input v-model="invoiceAddres" name="invoice_addres">{{translations['addres']}}</labeled-input>
       <labeled-input v-model="invoiceCompanyName" name="invoice_company_name">{{translations['company_name']}}</labeled-input>
       <labeled-input v-model="taxIdentificationNumber" name="tax_identification_number">{{translations['tax_identification_number']}}</labeled-input>
    </fieldset>

    <fieldset class="project-form-fieldset">
       <caption v-text="translations['summary']" class="project-form-caption"></caption>
       <div class="summary-container">
            <span class="read-only-box-container">
                <span class="sub-container read-only-content read-only-label">
                   <span v-text="translations['total_cost']"></span>
                </span>
                <span class="sub-container read-only-content money-ammount">
                    <span>
                        <span v-text="paymentSummary"></span>
                        <span v-text="translations['current_currency']"></span>
                    </span>
                </span>
            </span>
                <span class="datepicker-wrapper">
                    <span class="datepicker-description">
                        {{translations['finish_date']}} :
                    </span>
                    <span class="datepicker-bottom-container">
                        <datepicker format="yyyy-MM-dd" input-class="calendar-input" v-model="finishDate"  name="finish_date"></datepicker>
                        <img src="/images/decoration/Icon awesome-calendar-alt.svg" alt="" class="calendar-icon">
                    </span>
                </span>
                <labeled-select name="project_status_id" v-model="projectStatusId" v-bind:displayed-values="projectStatusesValues" v-bind:values="projectStatusesIds">
                {{translations['project_status']}} : 
            </labeled-select>
        </div>
        <div class="textarea-container">
            <label for="project-comment" v-text="translations['project_comment']" class="textarea-label"></label>
            <textarea name="comment" v-model="projectComment" id="project-comment" class="textarea" cols="30" rows="10"></textarea>
        </div> 
    </fieldset>
    <button class="positive-button colored-button wide-button" v-text="translations['save']" type="submit"></button>
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
  import RelativeShadowContainer from '@jscomponents/decoration/relative_shadow_container.vue';
  import ExpectCircle from '@jscomponents/decoration/expect_circle.vue';
  import CloseDecoration from '@jscomponents/decoration/close_decoration.vue';
  
@Component({ components : {
     LabeledInput, CloseButton, LabeledSelect, Multiselect, Datepicker, RelativeShadowContainer, ExpectCircle, CloseDecoration
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
    }) readonly projectStatusesIds: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly projectStatusesValues: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly tasksNames: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly tasksIds: number[];

     @Prop({
            type: Array,
            required: true,
    }) readonly accountsNames: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly accountsIds: number[];

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
    private engagedPersons:object = {};

    private projectId = null;

    private fetchingClientDataInProgress:boolean = false;

    private workStageIndex: number = 0;
    private workStages: Array<number> = [];
    private startDates:object = {};
    private deadLineDates:object = {};
    private workRangeValues:object = {};
    private estimatedHours:object = {};
    private workStageEngagedPersons:object = {};
    
    private paymentStageIndex:number = 0;
    private paymentStageDates:object = {};
    private paymentStagesMoneyAmmount:object = {};
    private paymentStages: Array<number> = [];
    private paymentStageNames:object = {};
    private paymentStageStatuses:object = {};

    private paymentSummary:number = 0;
    private projectName:string = '';
    private accountID = '';
    private projectMenagerID = '';
    private clientContactPerson:string = '';
    private clientPhoneNumber:string = '';
    private clientEmail:string = '';
    private clientId = '';
    private invoiceAddres:string = '';
    private invoiceCompanyName:string = '';
    private taxIdentificationNumber:string = '';
    private finishDate = new Date();
    private projectStatusId = '';
    private projectComment:string = '';
    private disabledEmployeeInputs: object = {};
    private employeesWithDesiredSkillIds: object = {};
    private employeesWithDesiredSkillNames:object = {};
    private employeeWithDesiredSkill:object = {};

    logout(){
      (<HTMLFormElement>this.$refs.logout_form).submit();
    }

  loadClientData(client){
     this.clientContactPerson = client.contact_person_name;
     this.clientPhoneNumber = client.contact_phone_number;
     this.clientEmail = client.email;
     this.invoiceAddres = client.address;
     this.invoiceCompanyName = client.name;
     this.taxIdentificationNumber = client.tax_identification_number;
  }

  setEngagedPersonsInputState(disabledInput:boolean, workStage){

         if(disabledInput){
             this.employeeWithDesiredSkill[workStage] = '';
             this.employeesWithDesiredSkillIds[workStage] = [];
             this.employeesWithDesiredSkillNames[workStage] = [];
         }
         this.employeeWithDesiredSkill[workStage] = '';
         const disabledInputData = {};
         disabledInputData[workStage] = disabledInput;
         this.disabledEmployeeInputs = Object.assign({}, this.disabledEmployeeInputs, disabledInputData);
  }

  loadEmployeesForSelectedWorkRange(employees, workStage, employeeId = null){
    

     if(employees.length > 0){

         let employeesWithDesiredSkillIds = [];
         let employeesWithDesiredSkillNames = [];

         employees.forEach(employee => {
            employeesWithDesiredSkillIds.push(employee.id);
            employeesWithDesiredSkillNames.push(employee.full_name);
         });

         this.setEngagedPersonsInputState(false, workStage);
         
         this.employeesWithDesiredSkillIds[workStage] = employeesWithDesiredSkillIds;
         this.employeesWithDesiredSkillNames[workStage] = employeesWithDesiredSkillNames;
         if(employeeId){
             this.employeeWithDesiredSkill[workStage] = employeeId;
         }
     }
     else{
         this.setEngagedPersonsInputState(true, workStage);
         this.showNotification(this.translations['there_are_no_employees_with_this_skill']); 
     }
  }

  notifyUserWhyInputIsDisabled(workStage){
     
      if(this.disabledEmployeeInputs[workStage] === true){
         this.showNotification(this.translations['in_order_to_select_an_employee_you_have_to_select_work_range'],'error');
      }
  }

  async fetchEmployeesHavingDesiredSkill(workStage, employeeId:number = null){

        const desiredSkillId = this.workRangeValues[workStage];

        if(!desiredSkillId){
            this.setEngagedPersonsInputState(true, workStage);
            return;
        }


        const requestData = {

               method : 'GET',
               headers : {
                  'X-CSRF-TOKEN' : this.csrfToken
               },
        };

         const response = await fetch(`/employees/get-with-desired-skill?skill_id=${desiredSkillId}`,requestData);

            switch(response.status){

                  case 200:
                     const responseBody = await response.json();
                     this.loadEmployeesForSelectedWorkRange(responseBody, workStage, employeeId);
                  break;

                  case 400:
                   this.showNotification(this.translations['the_work_range_data_is_invalid'], 'error');
                  break;

                  case 500:
                    this.showNotification(this.translations['server_error_occured'], 'error');
                  break;

                  default:
                    this.showNotification(this.translations['undefined_error'], 'error');
                  break;
            }

  }

  async  fetchClientsData(){
        const clientID = this.clientId;
        if(!clientID){
            return;
        }
        this.fetchingClientDataInProgress = true;
        

        const requestData = {

               method : 'GET',
               headers : {
                  'X-CSRF-TOKEN' : this.csrfToken
               },
        };

        const response = await fetch(`/clients/get-single?id=${clientID}`,requestData);

            switch(response.status){

                  case 200:
                     const responseBody = await response.json();
                     console.log(responseBody);
                     this.loadClientData(responseBody);
                  break;

                  case 400:
                   this.showNotification(this.translations['the_data_is_invalid'], 'error');
                  break;

                  case 500:
                    this.showNotification(this.translations['server_error_occured'], 'error');
                  break;

                  default:
                    this.showNotification(this.translations['undefined_error'], 'error');
                  break;
            }

            this.fetchingClientDataInProgress = false;
    }


    closeForm(){
        this.$root.$emit('closeProjectForm');
    }

    showNotification(text, type="no-error"){
         const header = type === "no-error" ? "information" : "error";
         this.$root.$emit('showNotification', {notificationText : text, notificationType : type, headerText : this.translations['information']});
      }

    addWorkStage(){
        ++this.workStageIndex;
        this.deadLineDates[this.workStageIndex] = new Date();
        this.startDates[this.workStageIndex] = new Date();
        this.workRangeValues[this.workStageIndex] = '';
        this.estimatedHours[this.workStageIndex] = 0;
        this.workStageEngagedPersons[this.workStageIndex] = 0;
        this.workStages.push(this.workStageIndex);
        this.disabledEmployeeInputs[this.workStageIndex] = true;
        this.employeesWithDesiredSkillIds[this.workStageIndex] = {};
        this.employeesWithDesiredSkillNames[this.workStageIndex] = {};
        this.employeeWithDesiredSkill[this.workStageIndex] = '';
    }

    addPaymentStage(){
        ++this.paymentStageIndex;
        this.paymentStageDates[this.paymentStageIndex] = new Date();
        this.paymentStagesMoneyAmmount[this.paymentStageIndex] = 0;
        this.paymentStageNames[this.paymentStageIndex] = '';
        this.paymentStageStatuses[this.paymentStageIndex] = 0;
        this.paymentStages.push(this.paymentStageIndex);
    }

    removeWorkStage(workStageID:number){
        this.workStages = this.workStages.filter(value => value != workStageID);
        delete this.deadLineDates[workStageID];
        delete this.startDates[workStageID];
        delete this.workRangeValues[workStageID];
        delete this.estimatedHours[workStageID];
        delete this.workStageEngagedPersons[workStageID];
        delete this.disabledEmployeeInputs[workStageID];
        delete this.employeesWithDesiredSkillIds[workStageID];
        delete this.employeesWithDesiredSkillNames[workStageID];
        delete this.employeeWithDesiredSkill[workStageID];
    }

    removePaymentStage(paymentStageID:number){
        this.paymentStages = this.paymentStages.filter(value => value != paymentStageID);
        delete this.paymentStageDates[paymentStageID];
        delete this.paymentStagesMoneyAmmount[paymentStageID];
        delete this.paymentStageNames[paymentStageID];
        delete this.paymentStageStatuses[paymentStageID];
        this.updatePaymentSummary();
    }

    updatePaymentSummary(){
        let totalCost:number = 0;
        Object.values(this.paymentStagesMoneyAmmount).forEach(cost => totalCost += parseFloat(cost));
        this.paymentSummary = totalCost;
    }

    loadProjectData(project){
        this.resetForm();
        this.projectName = project.name;
        this.projectMenagerID = project.project_menager_id;
        this.accountID = project.account_id;

        project.task_stages.forEach(value =>{
            ++this.workStageIndex;
            this.workRangeValues[this.workStageIndex] = value.task_id;
            this.workStageEngagedPersons[this.workStageIndex] = value.user_id;
            this.estimatedHours[this.workStageIndex] = value.estimated_time_of_work;
            this.startDates[this.workStageIndex] = value.start_at;
            this.deadLineDates[this.workStageIndex] = value.deadline;
            this.workStages.push(this.workStageIndex);
            this.setEngagedPersonsInputState(false,this.workStageIndex);
            this.fetchEmployeesHavingDesiredSkill(this.workStageIndex, value.user_id);
        });

        project.payment_stages.forEach(value => {
            ++this.paymentStageIndex;
            this.paymentStageNames[this.paymentStageIndex] = value.name;
            this.paymentStagesMoneyAmmount[this.paymentStageIndex] = value.ammount;
            this.paymentStageDates[this.paymentStageIndex] = value.estimated_payment_date;
            this.paymentStageStatuses[this.paymentStageIndex] = value.payment_status_id;
            this.paymentStages.push(this.paymentStageIndex);
        });
        this.updatePaymentSummary();
        this.clientId = project.client_id;
        this.clientContactPerson = project.client_contact_person_name;
        this.clientPhoneNumber = project.client_phone_number;
        this.clientEmail = project.client_email;
        this.invoiceAddres = project.company_addres;
        this.invoiceCompanyName = project.company_name;
        this.taxIdentificationNumber = project.company_tax_identification_number;
        this.finishDate = project.should_be_finished_at;
        this.projectStatusId = project.status_id;
        this.projectId = project.id;
        this.projectComment = project.project_comment;
    }

    resetForm(){
       this.projectName = '';
       this.projectMenagerID = '';
       this.accountID = '';
       this.clientContactPerson = '';
       this.clientPhoneNumber = '';
       this.clientEmail = '';
       this.clientId = '';
       this.invoiceAddres = '';
       this.invoiceCompanyName = '';
       this.taxIdentificationNumber = '';
       this.finishDate = new Date();
       this.projectStatusId = '';
       this.projectComment = '';
       this.projectId = null;
       this.workRangeValues = {};
       this.workStageEngagedPersons = {};
       this.estimatedHours = {};
       this.startDates = {};
       this.deadLineDates = {};
       this.workStageIndex = 0;
       this.workStages = [];
       this.paymentStageIndex = 0;
       this.paymentStageDates = {};
       this.paymentStagesMoneyAmmount = {};
       this.paymentStages = [];
       this.paymentStageNames = {};
       this.paymentStageStatuses = {};
    }

    created(){
        this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
        this.$root.$on('editProject', this.loadProjectData);
        this.$root.$on('resetForm',this.resetForm);
    }

  }
</script>

<style lang="scss" scoped>

@import '~sass/fonts';
@import '~sass/components/rectangular_list';
@import '~sass/components/removal_button';
@import '~sass/components/labeled_wide_textarea';
@import '~sass/components/read_only_box';
@import '~sass/components/labeled_select';
@import '~sass/components/introductory_bar';

$margin-for-inputs : 10px 15px 10px 0;

.read-only-box-container{
    margin: $margin-for-inputs;
}

.summary-container{
   display: flex;
   justify-content: space-between;
   align-content: stretch; 
}

.removal-button{
    margin: $margin-for-inputs;
}

#app .datepicker-wrapper{
    margin: $margin-for-inputs;
}

#app .select-label{
    margin: $margin-for-inputs;
}

#app .labeled-input-value-label{
    margin: $margin-for-inputs;
}

.stage-list-element{
   display: flex;
   flex-wrap: wrap;
   align-items: stretch;
   padding-bottom: 2vw;
}

#app .flickering-circle{
   background: #d0d7dc;
}

#app .expect-circles-label{
    @include responsive-font(1.1vw, 12px,Montserrat);
}

#app .header{
    padding: 1vw 0 0 3vw;
}

.wide-button{
    display:block;
    width: 15%;
    margin: 10px 10px 10px auto;
}

.relative-container{
    position:relative;
}

.calendar-input{
   background: #242229;
   color:white;
   padding:4px;
   border: none;
}

.stages-list{
    list-style-type: none;
    padding:4px;
    margin:0;
}

.add-stage-button{
    margin:5px 0;
    display: block;
}

.project-form-caption{
    @include responsive-font(1.5vw,22px,Montserrat);
    letter-spacing: 0px;
    color: #3C4346;
    opacity: 1;
    display:block;
    text-align:left;
    padding: 0.7vw 0
}

.project-form-fieldset{
    padding: 1vw 0.5vw 0.5vw 3vw;
    border-bottom: 2px solid black;
}

.project-form{
    position:fixed;
    top:0;
    width:100%;
    left:0;
    overflow-y:auto;
    background:#fbffff;
    max-height: 100vh;
    z-index:2;
}

.colored-button{
    background:#00C8C8;
    color:white;
    padding:0.7vw 10px;
}

  
</style>