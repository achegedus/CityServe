<template>

    <div>
        <h3>Groups <router-link class="small" :to="{ name: 'admin-church-new-page' }">Create new</router-link></h3>

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Volunteers</th>
                <th>Leader</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="group in this.groups">
                <td><router-link :to="{ name: 'admin-church-edit-page', params: {churchID: church.id }}">{{ church.name }}</router-link></td>
                <td>{{ church.address }}</td>
                <td>{{ church.city }}</td>
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
                msg:'hello vue',
                groups: []
            }
        },

        methods: {
            getGroups: function() {

                this.axios.get('/api/groups').then((response) => {
                    this.groups = response.data.data
                })

            }
        },

        mounted: function() {
            this.getGroups();
        },

        components:{

        }
    }

</script>
