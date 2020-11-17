<template>
<button ref="container" type="button" class="button-close-container">
    <div class="button-close"></div>
    <span v-text="description" class="button-description"></span>
</button>
</template>

<script>
	export default {
        name: 'close-button',

        props : {
            description : {
                required: false,
                default:'close',
                type: String
            }
        }

    }
</script>

<style lang="scss">

.button-close{
    display: inline-block;
    background:#ef0244;
    width: 65%;
    height: 65%;
    position: absolute;
    font-size: 0;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    clip-path: polygon(20% 0%, 0% 20%, 30% 50%, 0% 80%, 20% 100%, 50% 70%, 80% 100%, 100% 80%, 70% 50%, 100% 20%, 80% 0%, 50% 30%);
}

.button-close-container:hover .button-close{
        background:white;
}

.button-close-container{
    position:relative;
    background:white;
    border-radius:50%;
    border:3px solid #ef0244;
    font-size: 0;
    min-width: 20px;
    min-height: 20px;
    width: 2.3vw;
    height: 2.3vw;
    cursor: pointer;
    display: inline-block;
    &:hover{
        background:#ef0244;
    }
}

.button-description{
    position:absolute;
    top:-9999px;
    left:0;
}

</style>