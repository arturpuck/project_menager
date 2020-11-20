<template>
<div class="expect-circles-outer-container">
    <div v-if="label" v-text="label" class="expect-circles-label"></div>
    <div class="expect-circles-inner-container">
        <div class="flickering-circle circle-1"></div>
        <div class="flickering-circle circle-2"></div>
        <div class="flickering-circle circle-3"></div>
        <div class="flickering-circle circle-4"></div>
        <div class="flickering-circle circle-5"></div>
        <div class="flickering-circle circle-6"></div>
        <div class="flickering-circle circle-7"></div>
        <div class="flickering-circle circle-8"></div>
    </div>
</div>
</template>

<script>
	export default {
        name: 'expect-circle',

        props : {
            label : {
                required : false,
                type : String,
                default : null
            }
        },

    }
</script>

<style lang="scss" scoped>

@import'~sass/fonts';

.expect-circles-outer-container{
    display:inline-block;
}

.expect-circles-label{
  padding:4px 0;
  text-align:center;
  @include responsive-font();
  color:white;
}

.expect-circles-inner-container{
  min-width:100px;
  min-height:100px;
  width:10vw;
  height:10vw;
  position:relative;
  margin: 0 auto;
}

.flickering-circle{
  border-radius:50%;
  width:20%;
  height:20%;
  background:#0b5a8a;
  position:absolute;
  opacity:0;
  animation:flicker 4s linear 0s infinite;
}

.circle-1{
  top:5%;
  left:40%;
}

.circle-2{
  top:15%;
  right:15%;
  animation-delay:0.5s;
}

.circle-3{
  top:40%;
  right:5%;
  animation-delay:1s;
}

.circle-4{
  bottom:15%;
  right:15%;
  animation-delay:1.5s;
}

.circle-5{
  bottom:5%;
  left:40%;
  animation-delay:2s;
}

.circle-6{
  left:15%;
  bottom:15%;
  animation-delay:2.5s;
}

.circle-7{
  left:5%;
  top:40%;
  animation-delay:3s;
}

.circle-8{
  top:15%;
  left:15%;
  animation-delay:3.5s;
}

@keyframes flicker{
  0%{
    opacity:0;
  }
  
  50%{
    opacity:1;
  }

  70%{
    opacity:0;
  }

  
  100%{
    opacity:0;
  }
}


</style>