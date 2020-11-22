import Vue from 'vue';
import Navbar from '@jscomponents/navbar.vue';
import PositiveButton from '@jscomponents/controls/positive_button.vue';
import LabeledSelect from '@jscomponents/controls/labeled_select.vue';
import RelativeShadowContainer from '@jscomponents/decoration/relative_shadow_container.vue'
import ExpectCircle from '@jscomponents/decoration/expect_circle.vue';
import UserNotification from '@jscomponents/user_notification.vue';
import { createDebuggerStatement } from 'typescript';
import translator from '@js/translator';

Vue.component('positive-button', PositiveButton);
Vue.component('navbar', Navbar);
Vue.component('labeled-select', LabeledSelect);
Vue.component('relative-shadow-container', RelativeShadowContainer);
Vue.component('expect-circle', ExpectCircle);
Vue.component('user-notification', UserNotification);

new Vue({
    el: '#app',
   
    data() {

        return{
            filterPaymentStatus:'',
            filterMonth:'',
            filterYear:'',
            clientNames: {},
            projectNames:{},
            paymentNames:{},
            paymentAmmounts:{},
            paymentDates:{},
            paymentStatusesIds:{},
            ammountOfItems:0,
            paymentStagesIds:{},
            translations : translator('income')
        };
    
    },
   
    methods : {

        async getPayments(){

                const requestData = {
                   method : 'GET',
                   headers : {
                      'X-CSRF-TOKEN' : this.csrfToken,
                      'Content-type': 'application/json; charset=UTF-8'
                   }
                   
                };
                let queryParams:string = '';

                if(this.filterPaymentStatus){
                   queryParams = `status=${this.filterPaymentStatus}&`;
                }

                if(this.filterMonth){
                    queryParams += `month=${this.filterMonth}&`;
                 }

                 if(this.filterYear){
                    queryParams += `year=${this.filterYear}&`;
                 }
                
                 queryParams = queryParams.slice(0,-1);

                const response = await fetch(`/income/filter?${queryParams}`,requestData);
                
                switch(response.status){
                    case 200:
                       const responseBody = await response.json();
                       console.log(responseBody);
                       this.loadPaymentsData(responseBody);
                    break;
                }
       
    },

    loadPaymentsData(payments){
        this.resetTable();

        payments.forEach(payment => {
              ++this.ammountOfItems;
              this.paymentStagesIds[this.ammountOfItems] = payment.id;
              this.clientNames[this.ammountOfItems] = payment.project.client.name;
              this.projectNames[this.ammountOfItems] = payment.project.name;
              this.paymentNames[this.ammountOfItems] = payment.name;
              this.paymentAmmounts[this.ammountOfItems] = payment.ammount;
              this.paymentDates[this.ammountOfItems] = payment.estimated_payment_date;
              this.paymentStatusesIds[this.ammountOfItems] = payment.payment_status_id;
        });
          
    },

   async editPaymentStatus(index){

       const paymentStatusId  = this.paymentStatusesIds[index];

       try{

         if(!paymentStatusId ){
             throw new Error('you_have_to_select_some_status')
         }
       
      
        const requestData = {
            method : 'PATCH',
            headers : {
            'X-CSRF-TOKEN' : this.csrfToken,
            'Content-type': 'application/json; charset=UTF-8'
            },
            body:JSON.stringify({
                payment_status_id : paymentStatusId ,
                payment_stage_id: this.paymentStagesIds[index]
            }) 
        };

        const response = await fetch('/income/update-status',requestData);
                
                switch(response.status){
                    case 200:
                       this.showNotification(this.translations['status_changed_successfully']);
                    break;
                }

    }catch(error){
        this.showNotification(this.translations[error.message], 'error');
      }
    },

    showNotification(text, type="no-error"){
        const header = type === "no-error" ? "information" : "error";
        this.$root.$emit('showNotification', {notificationText : text, notificationType : type, headerText : this.translations['information']});
    },

    resetTable(){
       this.ammountOfItems = 0;
       this.clientNames = {};
       this.projectNames = {};
       this.paymentNames = {};
       this.paymentAmmounts = {};
       this.paymentDates = {};
       this.paymentStatuses = {};
    }
   
   },

   created(){
       this.csrfToken = (<HTMLMetaElement>document.getElementById('csrf-token')).content;
   }
   
});