import Vue from 'vue';
import Navbar from '@jscomponents/navbar.vue';
import EmployeesList from '@jscomponents/team/employees_list.vue';
import EmployeeCard from '@jscomponents/team/employee_card.vue';
import NewEmployee from '@jscomponents/team/new_employee.vue';
import UserNotification from '@jscomponents/user_notification.vue';
import PositiveButton from '@jscomponents/controls/positive_button.vue';

Vue.component('navbar', Navbar);
Vue.component('employees-list', EmployeesList);
Vue.component('employee-card', EmployeeCard);
Vue.component('user-notification', UserNotification);
Vue.component('positive-button', PositiveButton);
Vue.component('new-employee', NewEmployee);

new Vue({
    el: '#app',
   
    data() {

        return{
            csrfToken:'',
            newEmployeeFormIsVisible : false
        };
    
    },
   
    methods : {

        showAddNewEmployeeForm(){
           this.newEmployeeFormIsVisible = true;
        },

        closeNewEmployeeForm(){
            this.newEmployeeFormIsVisible = false;
        }
    
   },

   created(){
       this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
   }
   
});