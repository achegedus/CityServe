<template>

    <div>
        <h3>Admin Users <router-link class="small" :to="{ name: 'admin-user-new-page' }">Create new</router-link></h3>

        <table class="table">
            <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Church</th>
                <th>Roles</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="user in this.users">
                <td><router-link :to="{ name: 'admin-user-edit-page', params: {userID: user.id }}">{{ user.email }}</router-link></td>
                <td>{{ user.name }}</td>
                <td>{{ user.church_id }}</td>
                <td>{{ user.phone }}</td>
                <td></td>
            </tr>
            </tbody>
        </table>

    </div>

</template>


<style>


</style>


<script>

    export default{
        data(){
            return{
                users: []
            }
        },

        methods: {
            getUsers: function() {

                this.axios.get('/api/users').then((response) => {
                    this.users = response.data.data
                })

            }
        },

        mounted: function() {
            this.getUsers();
        },

        components:{

        }
    }

</script>
