<template>
<div v-show="showCard" class="employee-card">
    <div class="close-bar">
        <close-button v-bind:description="translations['close']" v-on:click.native="closeCard" />
    </div>
    <ul class="tab-list">
       <li v-text="translations['projects_report']" v-on:click="setCurrentTab" id="report-tab" class="tab-list-element"></li>
       <li v-text="translations['clockify_report']" v-on:click="setCurrentTab" id="clockify-tab" class="tab-list-element"></li>
       <li v-text="translations['data']"  v-on:click="setCurrentTab" id="data-tab" class="tab-list-element"></li>
    </ul>
    
    <section v-show="reportTabIsSelected" class="tab-list-section">
        <form class="filter-results-form">
          <labeled-select v-model="filterMonth" name="month"
            v-bind:values="['01','02','03','04','05','06', '07', '08','09', '10', '11', '12']"
            v-bind:displayed-values="months">
            {{translations['month']}} : 
          </labeled-select>
          <labeled-select v-model="filterYear" name="year"
            v-bind:displayed-values="yearsRange">
            {{translations['year']}} : 
          </labeled-select>
          <positive-button v-on:click.native="filterReports" class="filter-reports" >{{translations['filter_reports']}}</positive-button>
        </form>

        <table class="table">
         <thead>
            <th v-text="translations['project']" class="table-header"></th>
            <th v-text="translations['range']" class="table-header"></th>
            <th v-text="translations['time']" class="table-header"></th>
            <th v-text="translations['status']" class="table-header"></th>
            <th v-text="translations['update_date']" class="table-header"></th>
            <th v-text="translations['comment']" class="table-header"></th>
            <th v-text="translations['action']" class="table-header"></th>
         </thead>
         <tbody>
           <tr class="table-row" v-for="index in numberOfDisplayedReports">
               <td v-text="projectNames[index]" class="table-cell"></td>
               <td v-text="taskRanges[index]" class="table-cell"></td>
               <td class="table-cell">
                  <labeled-input input-type="number" class="project-hours" v-model="workTimes[index]" name="project_reported_hours"></labeled-input>
               </td>
               <td class="table-cell">
                 <labeled-select name="account_id" class="project-status" v-model="workStatuses[index]" v-bind:displayed-values="projectReportStatusesValues" v-bind:values="projectReportStatusesIds"></labeled-select>
               </td>
               <td class="table-cell">
                 <span class="datepicker-wrapper">
                    <datepicker input-class="calendar-input" v-model="reportUpdateDates[index]" format="yyyy-MM-dd" name="update_date" ></datepicker>
                 </span>
               </td>
               <td class="table-cell">
                 <textarea v-model="reportComments[index]" class="classic-textarea"></textarea>
               </td>
               <td class="table-cell">
                  <button v-on:click="saveProjectReportSettings(index)" class="tiny-button">{{translations['save']}}</button>
               </td>
           </tr>
         </tbody>
     </table>
    </section>
    <section v-show="clockifyTabIsSelected" class="tab-list-section">
      <form method="POST" enctype='multipart/form-data' action="/report/store">
          <input type="hidden" v-bind:value="employee.id" name="user_id">
          <input v-bind:value="csrfToken" type="hidden" name="_token">
          <input type="file" class="report-file" name="clockify_report_file" >
          <labeled-input class="reported-hours" input-type="number" name="reported_hours">{{translations['hours_of_work']}}</labeled-input>
          <positive-button class="save-report" type="submit">{{translations['save']}}</positive-button>
      </form>
    </section>
    <section v-show="dataTabIsSelected" class="tab-list-section">
      <form>
        <labeled-input v-model="employee['full_name']" name="full_name" >{{translations['full_name']}} : </labeled-input>
        <labeled-input v-model="employee['email']" name="email">{{translations['email']}} : </labeled-input>
        <labeled-input v-model="employee['phone_number']" name="phone_number">{{translations['phone_number']}} : </labeled-input>
         <labeled-select name="role_id" v-model="employee['role_id']"
            v-bind:values="userRolesIds"
            v-bind:displayed-values="userRolesValues">
            {{translations['role']}} : 
          </labeled-select>
        <positive-button class="save-report">{{translations['save']}} : </positive-button>
      </form>
    </section>
</div>

</template>

<script lang="ts">
  import {Vue, Component, Prop} from 'vue-property-decorator';
  import translator from '@js/translator';
  import CloseButton from '@jscomponents/controls/close_button.vue';
  import LabeledInput from '@jscomponents/controls/labeled_input.vue';
  import PositiveButton from '@jscomponents/controls/positive_button.vue';
  import Datepicker from 'vuejs-datepicker';
  import LabeledSelect from '@jscomponents/controls/labeled_select.vue';

  
@Component({components : {CloseButton, LabeledInput, PositiveButton, Datepicker, LabeledSelect}})


  export default class EmployeeCard extends Vue {

    @Prop({
            type: Array,
            required: true,
    }) readonly userRolesValues: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly userRolesIds: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly projectReportStatusesValues: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly projectReportStatusesIds: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly months: string[];

    @Prop({
            type: Array,
            required: true,
    }) readonly yearsRange: string[];


    private translations = translator('employee_data');
    private csrfToken:string = '';
    private showCard :boolean = false;
    private employee:any = {};
    private selectedTab:string = 'report-tab';
    private projectNames = {};
    private taskRanges = {};
    private workTimes = {};
    private workStatuses = {};
    private reportUpdateDates = {};
    private reportComments = {};
    private numberOfDisplayedReports:number = 0;
    private projectIds = {};
    private filterMonth:number = 0;
    private filterYear:number = new Date().getFullYear();
    private employeePositionsDataCopy: number[] = [];

    showEmployeeCard(employee:object){
       
       this.employee = employee;
       this.makeEmployeePositionsDataCopy(employee);
       this.filterReports();
       this.showCard = true;
    }

    makeEmployeePositionsDataCopy(employee){
        
        employee.positions.forEach(position => {
           this.employeePositionsDataCopy.push(position.id);
        });
    }

    resetProjectReports(){
        this.numberOfDisplayedReports = 0;
        this.projectIds = {};
        this.projectNames = {};
        this.taskRanges = {};
        this.workTimes = {};
        this.workStatuses = {};
        this.reportUpdateDates = {};
        this.reportComments = {};
    }

    loadProjectReports(projects){
          this.resetProjectReports();

          projects.forEach(project => {
            ++this.numberOfDisplayedReports;
            this.projectIds[this.numberOfDisplayedReports] = project.id;
            this.projectNames[this.numberOfDisplayedReports] =  project.name ;
            this.taskRanges[this.numberOfDisplayedReports] = this.tasksList(project);
            this.workTimes[this.numberOfDisplayedReports] = this.projectHours(project) || 0;
            this.workStatuses[this.numberOfDisplayedReports] = this.projectStatus(project) || '';
            this.reportUpdateDates[this.numberOfDisplayedReports] = this.updateDate(project) || new Date().getFullYear();
            this.reportComments[this.numberOfDisplayedReports] = this.reportComment(project);
       });
    }

    showNotification(text, type="no-error"){
         const header = type === "no-error" ? "information" : "error";
         this.$root.$emit('showNotification', {notificationText : text, notificationType : type, headerText : this.translations['information']});
      }

   async filterReports(){

         const requestData = {
               method : 'GET',
               headers : {
                  'X-CSRF-TOKEN' : this.csrfToken,
                  'Content-type': 'application/json; charset=UTF-8'
               }
               
            };

            let queryParams:string = `employee_id=${this.employee.id}&`;

            if(this.filterMonth){
              queryParams += `month=${this.filterMonth}&`
            }

            if(this.filterYear){
              queryParams += `year=${this.filterYear}`;
            }

                 const response = await fetch(`/employee/reports/filter?${queryParams}`,requestData);

                 switch(response.status){

                    case 200:
                      const responseBody = await response.json();
                      console.log(responseBody);
                      if(responseBody.length == 0){
                          this.showNotification(this.translations['no_results_have_been_foound_for_your_authentication_level'])
                      }
                      this.loadProjectReports(responseBody);
                    break;

                    case 400:
                      this.showNotification(this.translations['the_data_is_invalid'], 'error');
                    break;

                    case 500:
                      this.showNotification(this.translations['the_data_is_probably_ok_but_a_server_error_occured'], 'error');
                    break;

                    default:
                      this.showNotification(this.translations['undefined_error'], 'error');
                    break;
                }
            
    }

   async saveProjectReportSettings(index:number){
         const date = this.reportUpdateDates[index].toISOString().slice(0, 10);
      
         const requestBody = {
            project_id : this.projectIds[index],
            time : this.workTimes[index],
            status_id : this.workStatuses[index],
            update_date : date,
            comment : this.reportComments[index],
            employee_id : this.employee.id
         };
         
         const requestData = {
               method : 'PATCH',
               headers : {
                  'X-CSRF-TOKEN' : this.csrfToken,
                  'Content-type': 'application/json; charset=UTF-8'
               },
               body : JSON.stringify(requestBody)
               
          };

          const response = await fetch(`/employee/reports/store`,requestData);

          switch(response.status){

                    case 200:
                      this.showNotification(this.translations['report_saved_successfully']);
                    break;

                    case 400:
                      this.showNotification(this.translations['the_data_is_invalid'], 'error');
                    break;

                    case 500:
                      this.showNotification(this.translations['the_data_is_probably_ok_but_a_server_error_occured'], 'error');
                    break;

                    default:
                      this.showNotification(this.translations['undefined_error'], 'error');
                    break;
                }
    }

    reportComment(project){
      
      if(project.project_reports.length == 0){
         return '';
       }
       else{
         return project.project_reports[0].comment
       }
    }

    updateDate(project){
     
      if(project.project_reports.length == 0){
         return new Date();
       }
       else{
         return new Date(project.project_reports[0].updated_at);
       }
    }

    tasksList(project){
      let taskList:string = '';

      project.task_stages.forEach(taskStage => {
        
        if(taskStage.user_id == this.employee.id){
           taskList += `${taskStage.task.name}, `;
        }
        
      });

      return taskList.slice(0,-2);
    }

    projectHours(project){
       if(project.project_reports.length == 0){
         return 0;
       }
       else{
        return project.project_reports[0].time_spent;
       }
    }

    projectStatus(project){
       if(project.project_reports.length == 0){
         return 0;
       }
       else{
        return project.project_reports[0].status_id;
       }
    }

    closeCard(){
      this.showCard = false;
    }

    setCurrentTab(event){
      this.selectedTab = event.target.id || event.target.parent.id;
    }

    get reportTabIsSelected():boolean{
       return this.selectedTab == 'report-tab';
    }

    get dataTabIsSelected():boolean{
       return this.selectedTab == 'data-tab';
    }

    get clockifyTabIsSelected():boolean{
      return this.selectedTab == 'clockify-tab';
    }

    created(){
        this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
        this.$root.$on('showEmployeeCard', this.showEmployeeCard);
    }
    

  }
</script>

<style lang="scss">

@import '~sass/fonts';
@import '~sass/components/tab_list';
@import '~sass/components/table';

.filter-results-form{
  padding:5px;
  background:black;
  display:flex;
  flex-wrap: wrap;
  justify-content: space-evenly;
}

.employee-card{
    position:fixed;
    top:0;
    left:0;
    width:100vw;
    min-height:100vh;
    overflow-y: auto;
}

.close-bar{
    text-align:right;
    padding:5px;
    background:black;
}

.report-file{
  display: block;
  margin: 0 auto;
  padding: 6px;
}

#app .reported-hours{
    display: block;
    margin: 4px auto;
}

#app .save-report{
  display: block;
  margin: 4px auto;
}

#app .project-hours{
  min-width:50px;
  max-width:10vw;
}

#app .project-status{
   min-width:130px;
   max-width:20vw;
}

.datepicker-wrapper{
    padding:4px;
    background: #242229;
    border-radius:5px;
    display:inline-flex;
    flex-wrap:nowrap;
    align-items: baseline;
    margin: 4px;
}

.calendar-input{
   background: #242229;
   color:white;
   padding:4px;
   border: none;
}

.classic-textarea{
  background: #242229;
  border-radius: 4px;
  color: white;
}



</style>