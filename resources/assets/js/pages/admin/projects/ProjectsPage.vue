<template>

    <div>
        <h3>Projects <router-link class="small" :to="{ name: 'admin-project-new-page' }">Create new</router-link></h3>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Address</th>
                <th>Requester</th>
                <th>Phone</th>
                <th>Day</th>
                <th>Volunteers</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="project in this.projects">
                <td><router-link :to="{ name: 'admin-project-edit-page', params: {projectID: project.id }}">{{ project.id }}</router-link></td>
                <td>{{ project.event_address }}</td>
                <td>{{ project.requester_contact_name }}</td>
                <td>{{ project.requester_phone | phone }}</td>
                <td>{{ project.day | capitalize }}</td>
                <td>{{ project.volunteers + "/" + project.numVolunteers}}</td>
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
                projects: []
            }
        },

        filters: {
            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            },

            phone: function (value) {
                return value.replace(/[^0-9]/g, '')
                    .replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            }
        },

        methods: {
            getProjects: function() {

                this.axios.get('/api/projects').then((response) => {
                    this.projects = response.data.data
                })

            }
        },

        mounted: function() {
            this.getProjects();
        },

        components:{

        }
    }

</script>
