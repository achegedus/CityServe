<template>

    <div>
        <div v-if="$route.name.indexOf('admin') == -1">
            <home-header></home-header>

            <div class="container content">
                <router-view></router-view>
            </div>

            <home-footer></home-footer>
        </div>
        <div v-else>
            <top-menu></top-menu>
            <div class="container">
                <router-view></router-view>
            </div>
        </div>
    </div>

</template>


<style>


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
            const userObj = JSON.parse(window.localStorage.getItem('authUser'))
            this.$store.dispatch('setUserObject', userObj)
        }

    }

</script>