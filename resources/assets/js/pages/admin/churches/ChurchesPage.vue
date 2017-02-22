<template>

    <div>
        <h3>Churches <router-link class="small" :to="{ name: 'admin-church-new-page' }">Create new</router-link></h3>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Phone</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="church in this.churches">
                    <td><router-link :to="{ name: 'admin-church-edit-page', params: {churchID: church.id }}">{{ church.name }}</router-link></td>
                    <td>{{ church.address }}</td>
                    <td>{{ church.city }}</td>
                    <td>{{ church.phone | phone}}</td>
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
                churches: []
            }
        },

        filters: {
            phone: function (value) {
                return value.replace(/[^0-9]/g, '')
                    .replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            }
        },

        methods: {
            getChurches: function() {

                this.axios.get('/api/churches').then((response) => {
                    this.churches = response.data.data
                })

            }
        },

        mounted: function() {
            this.getChurches();
        },

        components:{

        }
    }

</script>
