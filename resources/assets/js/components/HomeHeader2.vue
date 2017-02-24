<template>

    <!--=== Header v6 ===-->
    <div class="header-v6 header-white-transparent header-sticky">
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
                            <img class="default-logo" src="/CityServeNoHammer.png" alt="Logo">
                            <img class="shrink-logo" src="/CityServeNoHammer.png" alt="Logo">
                        </router-link>
                    </div>
                    <!-- ENd Navbar Brand -->


                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <div class="menu-container">
                        <ul class="nav navbar-nav">
                            <!-- Home -->
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Home
                                </a>
                            </li>
                            <!-- End Home -->

                            <!-- Pages -->
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    About
                                </a>
                            </li>
                            <!-- End Pages -->

                            <!-- Blog -->
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    FAQ
                                </a>
                            </li>
                            <!-- End Blog -->

                            <!-- Blog -->
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Churches
                                </a>
                            </li>
                            <!-- End Blog -->

                            <!-- Portfolio -->
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Serve
                                </a>
                            </li>
                            <!-- End Portfolio -->

                            <!-- Portfolio -->
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Request a Project
                                </a>
                            </li>
                            <!-- End Portfolio -->

                            <!-- Features -->
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    Login
                                </a>
                            </li>
                            <!-- End Features -->

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
    import { mapState } from 'vuex'

    export default{
        data(){
            return{
                msg:'hello vue'
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

            isAdmin() {
                if (this.userStore.authUser)
                    return this.userStore.authUser.isSuperAdmin
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
                this.$router.push({name: 'home-page'})
            }
        }
    }

</script>
