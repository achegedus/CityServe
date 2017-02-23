<template>

    <div>
        <h3>People <router-link class="small" :to="{ name: 'admin-church-new-page' }">Create new</router-link></h3>

        <table class="table">
            <thead>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Church</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="person in this.people">
                <td><router-link :to="{ name: 'admin-person-edit-page', params: {projectID: person.id }}">{{ person.first_name }}</router-link></td>
                <td>{{ person.last_name }}</td>
                <td>{{ person.email }}</td>
                <td>{{ person.phone | phone }}</td>
                <td>{{ person.church_id }}</td>
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
                people: []
            }
        },

        filters: {
            phone: function (value) {
                return value.replace(/[^0-9]/g, '')
                    .replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            }
        },

        methods: {
            getPeople: function() {

                this.axios.get('/api/people').then((response) => {
                    this.people = response.data.data
                })

            }
        },

        mounted: function() {
            this.getPeople();
        },

        components:{

        }
    }

</script>
