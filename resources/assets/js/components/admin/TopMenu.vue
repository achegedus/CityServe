<template>
    <!--=== Header v6 ===-->
    <div class="header-v6 header-classic-white header-sticky">
        <!-- Navbar -->
        <div class="navbar mega-menu" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="menu-container">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Navbar Brand -->
                    <div class="navbar-brand">
                        <router-link :to="{ name: 'home-page' }">
                            <img class="default-logo" src="/CITY_SERVE_2017a.png" alt="Logo">
                            <img class="shrink-logo" src="/CITY_SERVE_2017a.png" alt="Logo">
                        </router-link>
                    </div>
                    <!-- ENd Navbar Brand -->


                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <div class="menu-container">
                        <ul class="nav navbar-nav">
                            <router-link tag="li" :to="{name:'admin-dashboard'}" active-class="active"><a>Dashboard</a></router-link>
                            <router-link tag="li" :to="{name:'admin-churches-page'}" active-class="active" v-if="isSuperAdmin"><a>Churches</a></router-link>
                            <router-link tag="li" :to="{name:'admin-projects-page'}" active-class="active"><a>Projects</a></router-link>
                            <router-link tag="li" :to="{name:'admin-groups-page'}" active-class="active" v-if="isSuperAdmin"><a>Groups</a></router-link>
                            <router-link tag="li" :to="{name:'admin-users-page'}" active-class="active" v-if="isSuperAdmin"><a>Users</a></router-link>

                            <li v-if="loggedIn"><a v-on:click.prevent="handleLogout">Logout</a></li>
                        </ul>
                    </div>
                </div><!--/navbar-collapse-->
            </div>
        </div>
        <!-- End Navbar -->
    </div>
    <!--=== End Header v6 ===-->





</template>


<style>



</style>


<script>

    //import { mapState } from 'vuex'

    export default{
        data(){
            return{
                username_old: window.localStorage
            }
        },


        computed: {
            authUser() {
                return this.$store.getters.authUser
            },

            username() {
                if (this.authUser)
                    return this.authUser.name
                else
                    return false
            },

            loggedIn() {
                if (this.authUser)
                    return true
                else
                    return false
            },

            isReviewer() {
                if (this.authUser)
                    return this.authUser.isReviewer
                else
                    return false
            },

            isSuperAdmin() {
                if (this.authUser)
                    return this.authUser.isSuperAdmin
                else
                    return false
            }
        },


        methods: {
            handleLogout() {
                this.$store.dispatch('clearAuthUser')
                window.localStorage.removeItem('authUser')
                //this.$router.push({name: 'home-page'})
                location.href = '/log_out';
            }
        }
    }
</script>
