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

    import {loginUrl, userUrl, getHeader} from '../config'
    import {clientId, clientSecret} from '../env'

    export default{
        data(){
            return{
                login: {
                    email: 'adam@heged.us',
                    password: 'asdfasdf'
                }
            }
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

                this.$http.post(loginUrl, postData)
                    .then(response => {
                        if (response.status === 200) {
                            console.log(response);
                            authUser.access_token = response.data.access_token
                            authUser.refresh_token = response.data.refresh_token

                            // store the credentials
                            window.localStorage.setItem('authUser', JSON.stringify(authUser));

                            this.$http.get(userUrl, {headers: getHeader()})
                                .then(response => {
                                    console.log(response);

                                    authUser.email = response.body.email
                                    authUser.name = response.body.name
                                    authUser.isSuperAdmin = response.body.isSuperAdmin
                                    authUser.isChurchPrimary = response.body.isChurchPrimary
                                    authUser.phone = response.body.phone
                                    authUser.church_id = response.body.church_id

                                    window.localStorage.setItem('authUser', JSON.stringify(authUser));

                                    // redirect
                                    this.$router.push({name: 'dashboard'})
                            });
                        }
                    });
            }
        }
    }

</script>
