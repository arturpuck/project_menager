<template>
<div class="close-decoration-container">
    <div class="close-decoration"></div>
    <span v-if="description" v-text="description" class="decoration-description"></span>
</div>
</template>

<script>
	export default {
        name: 'close-decoration',

        props : {
            description : {
                required: false,
                default:'',
                type: String
            }
        }

    }
</script>

<style lang="scss">

.close-decoration{
    display: inline-block;
    background:black;
    width: 65%;
    height: 65%;
    position: absolute;
    font-size: 0;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    clip-path: polygon(20% 0%, 0% 20%, 30% 50%, 0% 80%, 20% 100%, 50% 70%, 80% 100%, 100% 80%, 70% 50%, 100% 20%, 80% 0%, 50% 30%);
}

.close-decoration-container:hover .close-decoration{
        background:white;
}

.close-decoration-container{
    position:relative;
    background:white;
    border-radius:50%;
    border:3px solid black;
    font-size: 0;
    min-width: 20px;
    min-height: 20px;
    width: 1.8vw;
    height: 1.8vw;
    cursor: pointer;
    display: inline-block;
    &:hover{
        background:black;
    }
}

.decoration-description{
    position:absolute;
    top:-9999px;
    left:0;
}

</style>