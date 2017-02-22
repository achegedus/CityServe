<template>

    <div>
        <h3>Groups <router-link class="small" :to="{ name: 'admin-group-new-page' }">Create new</router-link></h3>

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Group Type</th>
                <th>Leader</th>
                <th>Members</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="group in this.groups">
                <td><router-link :to="{ name: 'admin-group-edit-page', params: {groupID: group.id }}">{{ group.name }}</router-link></td>
                <td>{{ group.group_type_id }}</td>
                <td>{{ group.person_id }}</td>
                <td>{{ group.members }}</td>
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
