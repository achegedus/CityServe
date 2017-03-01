<template>

    <div v-on:>
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

        <login-modal :initialActive="showModal"></login-modal>
    </div>

</template>


<style>


</style>


<script>

    import { mapState } from 'vuex'
    import TopMenu from './components/admin/TopMenu.vue'

    import HomeHeader from './components/HomeHeader.vue'
    import HomeFooter from './components/HomeFooter.vue'
    import LoginModal from './components/LoginModal.vue'
    import bus from './bus.js'

    export default {

        data(){
            return{
                showModal: null
            }
        },

        components: {
            TopMenu, HomeHeader, HomeFooter, LoginModal
        },

        computed: {
            ...mapState({
                userStore: state => state.userStore
            })
        },

        methods: {
            showLogin() {
                this.showModal = 'login'
            },

            showRegister() {
                this.showModal = 'register'
            },

            closeModal() {
                this.showModal = null
            }
        },

        created() {
            const userObj = JSON.parse(window.localStorage.getItem('authUser'))
            this.$store.dispatch('setUserObject', userObj)

            bus.$on('show-login-modal', this.showLogin);
            bus.$on('show-register-modal', this.showRegister);
            bus.$on('close-modal', this.closeModal);
        }

    }

</script>