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
                            <img class="default-logo" src="/CITY_SERVE_2018.png" alt="Logo">
                            <img class="shrink-logo" src="/CITY_SERVE_2018.png" alt="Logo">
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
                                <a href="/#">
                                    Home
                                </a>
                            </li>
                            <!-- End Home -->

                            <!-- About -->
                            <li class="dropdown">
                                <a href="/#about">
                                    About
                                </a>
                            </li>
                            <!-- End About -->

                            <!-- Faq -->
                            <li class="dropdown">
                                <a href="/#faq">
                                    FAQ
                                </a>
                            </li>
                            <!-- End Faq -->

                            <!-- Churches -->
                            <!--
                            <li class="dropdown">
                                <a href="/#churches">
                                    Churches
                                </a>
                            </li>
                            -->
                            <!-- End Churches -->
<!---
                            
                            <li class="dropdown">
                                <router-link :to="{ name: 'serve' }">
                                    Serve
                                </router-link>
                            </li>
 --->                           
                            <!-- End Serve -->

                            <!-- Projects -->
                            <li class="dropdown">
                                <router-link :to="{ name: 'request-project' }">
                                    Request a Project
                                </router-link>
                            </li>
                            <!-- End Projects -->

                            <!-- Login -->
                            <li class="dropdown" v-if="!loggedIn">
                                <a href="#" @click.prevent="showLogin">Login</a>
                            </li>
                            <!-- End Login -->

                            <!-- Register -->
                            <li v-if="!loggedIn">
                                <a href="#" @click.prevent="showRegister">Register</a>
                            </li>

                            <!-- Logout -->
                            <li class="dropdown" v-if="loggedIn">
                                <a v-on:click="handleLogout">Logout</a>
                            </li>
                            <!-- End Logout -->

                            <!-- Admin -->
                            <li class="dropdown" v-if="isAdmin">
                                <router-link :to="{ name: 'admin-dashboard' }">Admin</router-link>
                            </li>
                            <!-- End Admin -->

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
    import bus from '../bus.js'

    export default{
        data(){
            return{
                msg:'hello vue'
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

            isAdmin() {
                if (this.authUser)
                    return this.authUser.isSuperAdmin
                else
                    return false
            },

            loggedIn() {
                if (this.authUser)
                    return true
                else
                    return false
            }
        },


        methods: {
            handleLogout() {
                this.$store.dispatch('clearAuthUser')
                window.localStorage.removeItem('authUser')
                location.href = '/log_out';
            },

            showLogin() {
                location.href = '/login';
            },

            showRegister() {
                location.href = '/register';
            }
        }
    }

</script>
