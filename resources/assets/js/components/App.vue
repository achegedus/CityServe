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
                    client_secret: '1muM0tPjA8KM6pICDSX2qhBwbREVpbsNCy0soCrR',
                    username: this.login.email,
                    password: this.login.password,
                    scope: ''
                }

                this.$http.post('http://localhost:8888/oauth/token', postData)
                    .then(response => {
                        console.log(response);

                        const header = {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + response.body.access_token,
                        }

                        this.$http.get('http://localhost:8888/api/user', {headers: header})
                            .then(response => {
                                console.log(response);
                            });
                    });
            }
        }
    }

</script>
