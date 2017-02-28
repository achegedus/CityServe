<template>
    <div >
        <form v-on:submit.prevent="handleLoginFormSubmit()" id="sky-form2" class="sky-form">
            <header>Login form</header>

            <fieldset>
                <section>
                    <div class="row">
                        <label class="label col col-4">E-mail</label>
                        <div class="col col-8">
                            <label class="input">
                                <i class="icon-append fa fa-user"></i>
                                <input v-model="login.email" type="email" name="email">
                            </label>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="row">
                        <label class="label col col-4">Password</label>
                        <div class="col col-8">
                            <label class="input">
                                <i class="icon-append fa fa-lock"></i>
                                <input v-model="login.password" type="password" name="password">
                            </label>
                            <div class="note"><a href="#sky-form2" class="modal-opener">Forgot password?</a></div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="row">
                        <div class="col col-4"></div>
                        <div class="col col-8">
                            <label class="checkbox"><input type="checkbox" name="remember" checked><i></i>Keep me logged in</label>
                        </div>
                    </div>
                </section>
            </fieldset>
            <footer>
                <button type="submit" class="btn-u">Log in</button>
                <a href="#" class="btn-u btn-u-default">Register</a>
            </footer>
        </form>
    </div>
</template>


<style>
    #loginForm {
        padding-top: 150px;
        padding-bottom: 50px;
    }
</style>


<script>

    import { mapState } from 'vuex'
    import {loginUrl, userUrl, getHeader} from '../../config'
    import {clientId, clientSecret} from '../../env'

    export default{
        data(){
            return{
                login: {
                    email: 'adam@heged.us',
                    password: 'asdfasdf'
                }
            }
        },

        computed: {
            ...mapState({
                userStore: state => state.userStore
            })
        },

        methods: {
            handleLoginFormSubmit() {
                console.log("hi");

                const postData = {
                    grant_type: 'password',
                    client_id: clientId,
                    client_secret: clientSecret,
                    username: this.login.email,
                    password: this.login.password,
                    scope: ''
                }

                const authUser = {}

                this.axios.post(loginUrl, postData)
                    .then(response => {
                        if (response.status === 200) {
                            console.log(response);
                            authUser.access_token = response.data.access_token
                            authUser.refresh_token = response.data.refresh_token

                            // store the credentials
                            window.localStorage.setItem('authUser', JSON.stringify(authUser));

                            this.axios.get(userUrl, {headers: getHeader()})
                                .then(response => {
                                    console.log(response);

                                    authUser.email = response.data.email
                                    authUser.name = response.data.name
                                    authUser.isSuperAdmin = response.data.isSuperAdmin
                                    authUser.isReviewer = response.data.isReviewer
                                    authUser.isChurchPrimary = response.data.isChurchPrimary
                                    authUser.phone = response.data.phone
                                    authUser.church_id = response.data.church_id

                                    window.localStorage.setItem('authUser', JSON.stringify(authUser));

                                    // dispatch set user object vuex
                                    this.$store.dispatch('setUserObject', authUser)

                                    // redirect
                                    this.$router.push({name: 'home-page'})
                            });
                        }
                    });
            }
        }
    }

</script>
