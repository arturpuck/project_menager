<template>
   <button v-bind:type="type" class="positive-button">
       <slot></slot>
   </button>
</template>

<script>
	export default {
        name: 'positive-button',

        props : {
             type : {
                 required: false,
                 type : String,
                 default : 'button'
             }
        }
    }
</script>

<style lang="scss">

@import'~sass/fonts';

.positive-button
{
	background: linear-gradient(#0fe00b, #054004);
	padding:5px;
	color:white;
	width: 15vw;
    min-width: 200px;
	border-radius: 5px;
    font-weight:bold;
    border: none;
    cursor:pointer;
    &:hover{
        background:#ef0244;
    }
    @include responsive-font(1.5vw, 19px);
}
</style>