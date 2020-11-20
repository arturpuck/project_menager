import Vue from 'vue';
import Navbar from '@jscomponents/navbar.vue';
import EmployeesList from '@jscomponents/team/employees_list.vue';
import EmployeeCard from '@jscomponents/team/employee_card.vue';
import UserNotification from '@jscomponents/user_notification.vue'

Vue.component('navbar', Navbar);
Vue.component('employees-list', EmployeesList);
Vue.component('employee-card', EmployeeCard);
Vue.component('user-notification', UserNotification);

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