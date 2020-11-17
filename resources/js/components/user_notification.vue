<template>
  <div v-bind:class="{'visible-user-notification-container' : visible, 'flickering-background' : flicker}" class="user-notification-container">
    <header v-bind:class="{'no-error-notification-bar' : !showsError, 'error-notification-bar' : showsError}" class="notification-bar">   
       <h1 v-text="headerText" class="notification-header"></h1> 
       <close-button v-on:click.native="closeNotification"></close-button>
    </header>
        <p v-text="notificationText" class="notification-content">

        </p>
        <div class="notification-pseudo-footer">
            <span v-show="!showsError" class="fas fa-info-circle icon-information" aria-hidden="true"></span>
            <span v-show="showsError" class="fas fa-exclamation-triangle icon-error"></span>
        </div>
 </div>
</template>

<script>

import CloseButton from '@jscomponents/controls/close_button.vue';

	export default {
        name: 'user-notification',

        components : {
            CloseButton
        },

        data(){
            return {
               notificationText : "",
               visible : false,
               headerText : "Information",
               type: "no-error",
               flicker: false
            };
        },

        methods : {
            closeNotification(){
                this.visible = false;
            },

            showNotification(content){
                
                const currentType = this.type;
                const currentNotificationText = this.notificationText;
                

                if(content['headerText']){
                  this.headerText = content['headerText'];
                }

                if(content['notificationText']){
                   this.notificationText = content['notificationText'];
                }

                if(content['notificationType']){
                  this.type = content['notificationType'];
                }
                if(this.visible && (this.type === currentType) && (this.notificationText === currentNotificationText)){
                    this.flicker = true;
                    setTimeout(()=> this.flicker = false,1000);
                }
                this.visible = true;
            }
        },


        computed : {
           showsError(){
              return this.type === 'error';
           }

        },

        mounted(){
            this.$root.$on('showNotification', this.showNotification);
        }
    }
        
</script>

<style lang="scss" scoped>

@import '~sass/fonts';

.notification-pseudo-footer{
    padding:2px;
    text-align: center;
}

.icon-information{
   color:green;
}

.icon-information, .icon-error{
   @include responsive-font(1.5vw,21px,"");
}

  .user-notification-container{
      position:fixed;
      z-index:5;
      right:1%;
      bottom:0;
      transform: translateY(100%);
      transition: transform 1.5s;
      width:20%;
      min-width:250px;
      overflow:hidden;
      border-radius:8px 8px 0 0;
      box-shadow: 2px 2px 2px 2px black;
      background: #b1b1ca;
      color:black;
  }

  .visible-user-notification-container{
      transform: translateY(0);
  }

  .notification-bar{
      display:flex;
      align-items: center;
      justify-content: space-between;
      padding:0 8px;
      line-height: 2.2em;
      @include responsive-font();
  }

  .no-error-notification-bar{
    background:linear-gradient(#0fe00b, #054004);
    color:white;
  }

  .error-notification-bar{
      background:#ca1a1a;
      color:black;
  }

  .notification-header{
      @include responsive-font(1.4vw,21px);
      margin:0;
      padding:0;
  }

  .notification-content{
      margin:0;
      padding:4px;
      @include responsive-font(1.2vw,15px);
  }

  .flickering-background{
      background:#ca1a1a;
      color:white;
  }

  .icon-error{
      color: #ca1a1a;
  }

</style>