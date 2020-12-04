<template>
<form class="new-employee-form">
   <div class="header-bar">
     <h2 v-text="translations['add_new_employee']" class="header"></h2>
     <close-button v-on:click.native="hideForm"></close-button>
   </div>
   <div class="user-data">
      <labeled-input v-model="login" name="login" >{{translations['login']}} : </labeled-input>
      <labeled-input v-model="email" name="email" >{{translations['email']}} : </labeled-input>
      <labeled-input v-model="password" input-type="password" name="password" >{{translations['password']}} : </labeled-input>
      <labeled-input v-model="passwordConfirmation" input-type="password" name="password_confirmation" >{{translations['confirm_password']}} : </labeled-input>
      <labeled-input v-model="fullName" name="full_name" >{{translations['full_name']}} : </labeled-input>
      <labeled-input v-model="phoneNumber" name="phone_number" >{{translations['phone_number']}} : </labeled-input>
      <labeled-input v-model="ratePerHourSetByDeal" input-type="number" name="rate_per_hour_set_by_deal" >{{translations['rate_per_hour_set_by_deal']}} : </labeled-input>
      <labeled-input v-model="realRatePerHour" input-type="number" name="real_rate_per_hour" >{{translations['real_rate_per_hour']}} : </labeled-input>
      <labeled-input v-model="monthRate" input-type="number" name="month_rate" >{{translations['month_rate']}} : </labeled-input>
      <labeled-select name="role_id"  v-model="userRole"
            v-bind:values="userRolesIds"
            v-bind:displayed-values="userRolesValues">
            {{translations['role']}} : 
        </labeled-select>
        <div class="textarea-container">
          <label for="note" v-text="translations['note']" class="textarea-label"></label>
          <textarea name="comment" v-model="employeeNote" id="note" class="textarea" cols="30" rows="10"></textarea>
        </div>   
      <fieldset class="block-fieldset">
         <caption v-text="translations['positions']" class="classic-caption"></caption>
          <ul class="rectangular-elements-list">
                <multiselect v-on:added="addItemToPositionsList" v-bind:values="employeePositions" >{{translations['add_position']}}</multiselect> 
                <li v-for="position in employeePositionsList" class="rectangular-list-element">
                    {{position}}
                    <close-button class="remove-rectangular-element-icon" v-bind:description="translations['close']" v-on:click.native="removePositionFromList(position)" /> 
                </li>
              </ul>
      </fieldset>
      <fieldset class="block-fieldset">
              <caption v-text="translations['skills']" class="classic-caption"></caption>
              <ul class="rectangular-elements-list">
                <multiselect v-on:added="addItemToSkillsList" v-bind:values="employeeSkills" >{{translations['add_skill']}}</multiselect> 
                <li v-for="skill in employeeSkillsList" class="rectangular-list-element">
                    {{skill}}
                    <close-button class="remove-rectangular-element-icon" v-bind:description="translations['close']" v-on:click.native="removeSkillFromList(skill)" /> 
                </li>
              </ul>
      </fieldset>
      <positive-button class="colored-button wide-button" v-on:click.native="createNewEmployee">{{translations['add_employee']}} </positive-button>
   </div>
</form>
</template>

<script lang="ts">
  import {Vue, Component, Prop} from 'vue-property-decorator';
  import translator from '@js/translator';
  import RelativeShadowContainer from '@jscomponents/decoration/relative_shadow_container.vue'
  import ExpectCircle from '@jscomponents/decoration/expect_circle.vue';
  import CloseButton from '@jscomponents/controls/close_button.vue';
  import LabeledInput from '@jscomponents/controls/labeled_input.vue';
  import PositiveButton from '@jscomponents/controls/positive_button.vue';
  import LabeledSelect from '@jscomponents/controls/labeled_select.vue';
  import Multiselect from '@jscomponents/controls/multiselect.vue';
  
@Component({ components : {
     RelativeShadowContainer, ExpectCircle, CloseButton, 
     LabeledInput, PositiveButton, LabeledSelect, Multiselect
 }})

 
  export default class NewEmployee extends Vue {

    @Prop({
            type: Array,
            required: true,
    }) readonly employeePositions: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly employeePositionsIds: number[];

    @Prop({
            type: Array,
            required: true,
    }) readonly employeeSkills: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly employeeSkillsIds: number[];

    @Prop({
            type: Array,
            required: true,
    }) readonly userRolesValues: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly userRolesIds: string[];

    private translations = translator('new_employee');
    private passwordConfirmation:string = '';
    private password:string = '';
    private login:string = '';
    private email:string = '';
    private fullName:string = '';
    private phoneNumber:string = '';
    private employeeNote:string = '';
    private userRole:string = '';
    private ratePerHourSetByDeal:number = 0;
    private realRatePerHour:number = 0;
    private monthRate:number = 0;
    private employeePositionsList :string[] = [];
    private employeeSkillsList :string[] = [];
    private csrfToken:string = '';

    getNewEmployeeData() : Object{

      let employeeData = {};
      let skillsIds:number[] = [];
      let positionsIds:number[] = [];

      this.employeeSkillsList.forEach(value => {
            skillsIds.push(this.getSkillId(value));
      });

      this.employeePositionsList.forEach(value => {
            positionsIds.push(this.getPositionId(value));
      });

      employeeData['positions_ids'] = positionsIds;
      employeeData['login'] = this.login;
      employeeData['password'] = this.password;
      employeeData['password_confirmation'] = this.passwordConfirmation;
      employeeData['skills_ids'] = skillsIds;
      employeeData['full_name'] = this.fullName;
      employeeData['email'] = this.email;
      employeeData['phone_number'] = this.phoneNumber;
      employeeData['role_id'] = this.userRole;
      employeeData['rate_per_hour_set_by_deal'] = this.ratePerHourSetByDeal;
      employeeData['rate_per_month'] = this.monthRate;
      employeeData['real_rate_per_hour'] = this.realRatePerHour;
      employeeData['note'] = this.employeeNote;

      return employeeData;
    }

   async createNewEmployee(){

    let employeeData:object = this.getNewEmployeeData();

           const requestData = {
               method : 'POST',
               headers : {
                  'X-CSRF-TOKEN' : this.csrfToken,
                  'Content-type': 'application/json; charset=UTF-8'
               },
               body : JSON.stringify(employeeData)
               
            };

            const response = await fetch('/employee/create',requestData);

            switch(response.status){
                 case 200:
                   this.showNotification(this.translations['employee_created_successfully'])
                 break;

                  case 400:
                   this.showNotification(this.translations['the_data_is_invalid']);
                 break;
            }
    }

    hideForm(){
      this.$emit('close');
    }

    showNotification(text, type="no-error"){
         const header = type === "no-error" ? "information" : "error";
         this.$root.$emit('showNotification', {notificationText : text, notificationType : type, headerText : this.translations['information']});
    }

    getSkillId(skillName:string):number{
      const index = this.employeeSkillsList.findIndex( name => name == skillName);
      return this.employeeSkillsIds[index];
    }

    getPositionId(positionName:string):number{
      const index = this.employeePositionsList.findIndex( name => name == positionName);
      return this.employeePositionsIds[index];
    }

    removePositionFromList(position){
      this.employeePositionsList = this.employeePositionsList.filter(value => value != position); 
    }

    removeSkillFromList(skill){
         this.employeeSkillsList = this.employeeSkillsList.filter(value => value != skill);
    }

    addItemToPositionsList(position){

         if(!this.employeePositionsList.includes(position)){
           this.employeePositionsList.push(position);
        }
    }

    addItemToSkillsList(skill){

         if(!this.employeeSkillsList.includes(skill)){
           this.employeeSkillsList.push(skill);
        }
    }

    created(){
      this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
    }
    
  }
</script>

<style lang="scss">

@import '~sass/fonts';
@import '~sass/components/header';
@import '~sass/components/rectangular_list';
@import '~sass/components/labeled_wide_textarea';

.block-fieldset{
  width:100%;
}

.colored-button {
    background: #00C8C8;
    color: white;
    padding: 0.7vw 10px;
}

.wide-button {
    display: block;
    width: 95%;
    margin: 0 auto;
}

.classic-caption{
    @include responsive-font(1.5vw,22px,Montserrat);
    letter-spacing: 0px;
    color: #3C4346;
    opacity: 1;
    display:block;
    text-align:left;
    padding-left:2vw;
}

.new-employee-form{
  position:fixed;
  width:100%;
  height:100vh;
  overflow-y:auto;
  top:0;
  left:0;
  background:white;
  z-index: 2;
}

.header-bar{
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.7vw;
}

.user-data{
  display: flex;
  flex-wrap:wrap;
  justify-content: space-between;
}

</style>