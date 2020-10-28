import Vue from 'vue';
import Navbar from '@jscomponents/navbar.vue';
import PositiveButton from '@jscomponents/controls/positive_button.vue';
import ProjectForm from '@jscomponents/projects/project_form.vue';

Vue.component('positive-button', PositiveButton);
Vue.component('navbar', Navbar);
Vue.component('project-form', ProjectForm);

new Vue({
    el: '#app',
   
    data() {

        return{
            projectFormIsVisible: false
        };
    
    },
   
    methods : {
       showProjectForm(){
          this.projectFormIsVisible = true;
       },

       closeProjectForm(){
           this.projectFormIsVisible = false;
       }
        
   }
   
});