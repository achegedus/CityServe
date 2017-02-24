<template>

    <div>
        <div v-if="$route.name.indexOf('admin') == -1">
            <home-header></home-header>

                <router-view></router-view>

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

    import HomeHeader from './components/HomeHeader2.vue'
    import HomeFooter from './components/HomeFooter2.vue'

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