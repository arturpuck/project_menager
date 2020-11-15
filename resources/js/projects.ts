import Vue from 'vue';
import Navbar from '@jscomponents/navbar.vue';
import PositiveButton from '@jscomponents/controls/positive_button.vue';
import ProjectForm from '@jscomponents/projects/project_form.vue';
import LabeledSelect from '@jscomponents/controls/labeled_select.vue';
import RelativeShadowContainer from '@jscomponents/decoration/relative_shadow_container.vue'
import ExpectCircle from '@jscomponents/decoration/expect_circle.vue';
import { createDebuggerStatement } from 'typescript';
import translator from '@js/translator';

Vue.component('positive-button', PositiveButton);
Vue.component('navbar', Navbar);
Vue.component('project-form', ProjectForm);
Vue.component('labeled-select', LabeledSelect);
Vue.component('relative-shadow-container', RelativeShadowContainer);
Vue.component('expect-circle', ExpectCircle);

new Vue({
    el: '#app',
   
    data() {

        return{
            projectFormIsVisible: false,
            filterClientId:'',
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

      showEditForm(project){
         this.$root.$emit('editProject', project);
         this.showProjectForm();
      },

       showProjectForm(){
          this.projectFormIsVisible = true;
       },

       getClientContactData(project){
          return `${project.full_name_contact_person} - ${project.contact_person_email} - ${project.contact_person_phone_number}`;
       },

       getProjectValuation(project){
          let totalCost:number = 0;
          project.task_stages.forEach(function(value){
              totalCost += value.estimated_amount_of_money;
          });

          return totalCost;
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
                   this.matchingProjects = responseBody;
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