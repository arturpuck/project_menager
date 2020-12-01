import Vue from 'vue';
import Navbar from '@jscomponents/navbar.vue';
import PositiveButton from '@jscomponents/controls/positive_button.vue';
import ProjectForm from '@jscomponents/projects/project_form.vue';
import LabeledSelect from '@jscomponents/controls/labeled_select.vue';
import RelativeShadowContainer from '@jscomponents/decoration/relative_shadow_container.vue'
import ExpectCircle from '@jscomponents/decoration/expect_circle.vue';
import UserNotification from '@jscomponents/user_notification.vue';
import { createDebuggerStatement } from 'typescript';
import translator from '@js/translator';

Vue.component('positive-button', PositiveButton);
Vue.component('navbar', Navbar);
Vue.component('project-form', ProjectForm);
Vue.component('labeled-select', LabeledSelect);
Vue.component('relative-shadow-container', RelativeShadowContainer);
Vue.component('expect-circle', ExpectCircle);
Vue.component('user-notification', UserNotification);

new Vue({
    el: '#app',
   
    data() {

        return{
            projectFormIsVisible: false,
            filterClientId:'',
            filterProjectMenager:'',
            filterAccount:'',
            filterTaskId:'',
            filterStatusId:'',
            filterMonth:'',
            filterYear:'',
            csrfToken:'',
            matchingProjects: [],
            fetchingProjectsInProgress : false,
            translations : translator('projectsTable')
        };
    
    },
   
    methods : {

      checkProjectStatus(project):boolean{
         return project.status.name === 'finished';
      },

      showNotification(text, type="no-error"){
         const header = type === "no-error" ? "information" : "error";
         this.$root.$emit('showNotification', {notificationText : this.translations[text], notificationType : type, headerText : this.translations['information']});
      },

      showEditForm(project){
         this.$root.$emit('editProject', project);
         this.projectFormIsVisible = true;
      },

       showProjectForm(){
          this.$root.$emit('resetForm');
          this.projectFormIsVisible = true;
       },

       getClientContactData(project){
          return `${project.client_contact_person_name} - ${project.client_email} - ${project.client_phone_number}`;
       },

       buildFilterQuery(){
          const filterPropertiesNames = [
              'filterClientId',
              'filterTaskId',
              'filterStatusId',
              'filterMonth',
              'filterYear'
          ];

          const paramsNames = {
            filterClientId : 'client_id',
            filterTaskId : 'task_id',
            filterStatusId : 'status_id',
            filterMonth : 'month',
            filterYear : 'year'
          }
          let query = '';

          filterPropertiesNames.forEach(value => {
               if(this[value]){
                  query += `${paramsNames[value]}=${this[value]}&`
               }
          });

          return query;
       },

       async filterProjects(){

       this.fetchingProjectsInProgress = true;

        try{

            const requestBody = {
                client_id: this.filterClientId,
                task_id: this.filterTaskId,
                status_id: this.filterStatusId,
                month: this.filterMonth,
                year: this.filterYear
            };

            const queryParams = this.buildFilterQuery();

            const requestData = {
               method : 'GET',
               headers : {
                  'X-CSRF-TOKEN' : this.csrfToken,
                  'Content-type': 'application/json; charset=UTF-8'
               }
               
            };
            
            const response = await fetch(`/projects/filter?${queryParams}`,requestData);
            
            switch(response.status){
                case 200:
                   const responseBody = await response.json();
                   //console.log(responseBody);
                   if(responseBody.length == 0){
                      this.showNotification('no_results_have_been_foound_for_your_authentication_level')
                   }
                   this.matchingProjects = responseBody;
                break;

                case 400:
                  this.showNotification('the_data_is_invalid', 'error');
                break;

                case 500:
                  this.showNotification('the_data_is_probably_ok_but_a_server_error_occured', 'error');
                break;

                default:
                   this.showNotification('undefined_error', 'error');
                break;
            }
   
       }
       catch(error){
          alert(error.message);
       }
       finally{
           this.fetchingProjectsInProgress = false;
       }
    }
        
   },

   created(){
       this.$root.$on('closeProjectForm', () => this.projectFormIsVisible = false);
       this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
   }
   
});