<template>

    <div>
        <h3>Projects <router-link class="small" :to="{ name: 'admin-project-new-page' }">Create new</router-link></h3>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Address</th>
                <th>Requester</th>
                <th>Day</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="project in this.projects">
                <td><router-link :to="{ name: 'admin-project-edit-page', params: {projectID: project.id }}">{{ project.id }}</router-link></td>
                <td>{{ project.address }}</td>
                <td>{{ project.requester_id }}</td>
                <td>{{ project.day }}</td>
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
                projects: []
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
