<template>
    <div class="container" id="indivServeBox">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin-top: 40px">
                <div class="panel-heading">Register to serve!</div>
                <div class="panel-body row">
                    <div class="col-md-3">
                        <h3>Details</h3>
                        <ul class="list-unstyled">
                            <li><i class="fa-fw fa fa-hashtag"></i> Project {{ project.id }}</li>
                            <li><i class="fa-fw fa fa-paint-brush"></i> {{ category_name }}</li>
                            <li><i class="fa-fw fa fa-map-marker"></i> {{ project.event_city }}</li>
                            <li><i class="fa-fw fa fa-calendar"></i> {{ project.day | capitalize }}</li>
                            <li><i class="fa-fw fa fa-clock-o"></i> {{ project.time | timeformat }}</li>
                            <li><i class="fa-fw fa fa-users"></i> Volunteers needed: {{project.numVolunteers}}</li>
                        </ul>
                    </div>

                    <div class="col-md-8">
                        <h3>Project Description</h3>
                        <p>{{project.description}}</p>

                        <h4>How you will serve</h4>
                        <p>{{project.howUsed}}</p>

                        <h4>Skills needed</h4>
                        <p>{{project.skills}}</p>

                        <form class="sky-form" v-on:submit.prevent="signup">


                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" v-model="willLead">
                                    <i></i>I would like to lead this project
                                </label>
                            </div>

                            <button type="submit" class="btn btn-info">Sign up for this project</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<style>
    #indivServeBox {
        margin-top: 30px;
        margin-bottom: 100px;
    }

    .checkbox {
        padding-bottom: 20px;
    }

    .sky-form {
        border: none;
    }
</style>


<script>
    //import { mapState } from 'vuex'

    export default{
        data(){
            return{
                project: {},
                willLead: false
            }
        },

        computed: {
            authUser() {
                return this.$store.getters.authUser
            },

            category_name: function () {
                // `this` points to the vm instance
                return this.project.project_category.name
            }
        },

        components:{

        },

        filters: {
            timeformat: function (value) {
                if (!value) return ''
                if (value < 13) {
                    return value + ':00 AM'
                } else {
                    var time = value - 12;
                    return time + ':00 PM'
                }
            },

            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            }
        },

        methods: {
            getProject: function() {
                var self = this
                this.axios.get('/api/project/' + this.$route.params.projectID)
                .then((response) => {
                    self.project = response.data
                });
            },

            signup: function() {
                var self = this;

                const postData = {
                    willLead: this.willLead,
                }

                this.axios.post('/api/project/'+ this.$route.params.projectID +'/volunteer', postData)
                .then((response) => {

                    self.$router.push({ name: 'serve'})

                });
            }
        },

        mounted() {
            if (!this.authUser) {
                location.href = '/serve';
            } else {
                this.getProject();
            }
        },
    }
</script>
