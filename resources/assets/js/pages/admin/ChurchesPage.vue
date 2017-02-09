<template>

    <div>
        <h3>Churches</h3>

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
                    <td>{{ church.name }}</td>
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
                churches: []
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
