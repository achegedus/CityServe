<template>

    <div>
        <top-menu></top-menu>

        <router-view></router-view>
    </div>

</template>


<style>

    body { padding-top: 70px; }

</style>



<script>

    import TopMenu from './components/TopMenu.vue'

    export default {
        components: {
            TopMenu
        },

        created() {
            console.log('i was created')
        }

    }

</script>