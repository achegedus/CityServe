<template>

    <div>
        <home-header></home-header>

        <div class="container content">
            <router-view></router-view>
        </div>

        <home-footer></home-footer>
    </div>

</template>


<style>

    body { padding-top: 70px; }

</style>


<script>

    import { mapState } from 'vuex'
    import TopMenu from './components/admin/TopMenu.vue'

    import HomeHeader from './components/HomeHeader.vue'
    import HomeFooter from './components/HomeFooter.vue'

    export default {
        components: {
            TopMenu, HomeHeader, HomeFooter
        },

        computed: {
            ...mapState({
                userStore: state => state.userStore
            })
        },

        created() {
            console.log('i was created')
        }

    }

</script>