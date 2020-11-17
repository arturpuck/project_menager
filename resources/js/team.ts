import Vue from 'vue';
import Navbar from '@jscomponents/navbar.vue';
import EmployeesList from '@jscomponents/employees_list.vue';

Vue.component('navbar', Navbar);
Vue.component('employees-list', EmployeesList);

new Vue({
    el: '#app',
   
    data() {

        return{
            csrfToken:''
        };
    
    },
   
    methods : {
    
   },

   created(){
       this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
   }
   
});