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

    import {loginUrl} from '../config'

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
                    client_id: '2',
                    client_secret: 'BwyEqTnXN3CtTyN68Y00pGr7cjh824P8SsMyk2SN',
                    username: this.login.email,
                    password: this.login.password,
                    scope: ''
                }

                this.$http.post(loginUrl, postData)
                    .then(response => {
                        console.log(response);
                    });
            }
        }
    }

</script>
