<template>

    <form v-on:submit.prevent="handleLoginFormSubmit()" >
        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="text" class="form-control" v-model="login.email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" v-model="login.password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-default">Login</button>
    </form>

</template>


<style>

    body{
        background-color:#ffffff;
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
