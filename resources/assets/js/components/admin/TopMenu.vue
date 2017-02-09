<template>
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">CityServe Administration</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <router-link tag="li" :to="{name:'admin-dashboard'}" active-class="active"><a>Dashboard</a></router-link>
                    <router-link tag="li" :to="{name:'admin-churches-page'}" active-class="active"><a>Churches</a></router-link>
                    <router-link tag="li" :to="{name:'admin-projects-page'}" active-class="active"><a>Projects</a></router-link>
                    <router-link tag="li" :to="{name:'admin-people-page'}" active-class="active"><a>People</a></router-link>
                </ul>

                <ul v-if="loggedIn" class="nav navbar-nav navbar-right">
                    <li><p class="navbar-text">{{username}}</p></li>
                    <li><button type="button" class="btn btn-default navbar-btn" v-on:click.prevent="handleLogout">Logout</button></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</template>


<style>



</style>


<script>

    import { mapState } from 'vuex'

    export default{
        data(){
            return{
                username_old: window.localStorage
            }
        },


        computed: {
            ...mapState({
                userStore: state => state.userStore
            }),

            username() {
                if (this.userStore.authUser)
                    return this.userStore.authUser.name
                else
                    return false
            },

            loggedIn() {
                if (this.userStore.authUser)
                    return true
                else
                    return false
            }

        },


        methods: {
            handleLogout() {
                this.$store.dispatch('clearAuthUser')
                window.localStorage.removeItem('authUser')
                this.$router.push({name: 'admin-login'})
            }
        }
    }
</script>
