<template>

    <div>
        <h3>Dashboard</h3>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Volunteers Needed</h3>
                    </div>
                    <div class="panel-body">
                        <h1 style="text-align: center">{{stats.total_volunteers_needed}}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Volunteer Signups</h3>
                    </div>
                    <div class="panel-body">
                        <h1 style="text-align: center">{{stats.total_volunteers_registered}}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Projects Requested</h3>
                    </div>
                    <div class="panel-body">
                        <h1 style="text-align: center">{{stats.project_count}}</h1>
                    </div>
                </div>
            </div>
<!--
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Work vs Workers</h3>
                    </div>
                    <div class="panel-body">
                        Panel content
                    </div>
                </div>
            </div>
            -->
        </div>

    </div>

</template>


<style>


</style>


<script>

    export default{
        data(){
            return{
                stats: []
            }
        },

        components:{

        },

        methods: {
            getStats: function() {
                this.axios.get('/api/stats').then((response) => {
                    this.stats = response.data
                })
            }
        },

        mounted: function() {
            this.getStats();
        }
    }

</script>
