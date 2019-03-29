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

                        <form class="sky-form" v-on:submit.prevent="onValidate">
                            <input type="hidden" name="_token" :value="csrfToken">
                            <div class="form-group" :class="{'has-error': errors.has('server.name') }" >
                                <label for="name">Name</label>
                                <input name="name" v-validate data-vv-rules="required" data-vv-as="Name" type="text" class="form-control" v-model="server.name">
                                <span class='note note-error' v-show="errors.has('name')">{{ errors.first('name') }}</span>
                            </div>

                            <div class="form-group" :class="{'has-error': errors.has('server.email') }" >
                                <label for="email">Email</label>
                                <input name="email" v-validate data-vv-rules="required|email" data-vv-as="Email" type="text" class="form-control" v-model="server.email">
                                <span class='note note-error' v-show="errors.has('email')">{{ errors.first('email') }}</span>
                            </div>

                            <div class="form-group" :class="{'has-error': errors.has('server.phone') }" >
                                <label for="phone">Phone</label>
                                <input name="phone" v-validate data-vv-rules="required" data-vv-as="Phone" type="text" class="form-control" v-model="server.phone">
                                <span class='note note-error' v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
                            </div>

                            <div class="form-group" :class="{'has-error': errors.has('user.church_id') }" >
                                <label for="church_id">Church</label>
                                <select class="form-control" name="church_id" id="church_id" v-model="server.church_id">
                                    <option>Select One</option>
                                    <option v-for="church in churches" v-bind:value="church.id">
                                        {{ church.name }}
                                    </option>
                                </select>
                                <span class='note note-error' v-show="errors.has('church_id')">{{ errors.first('church_id') }}</span>
                            </div>


                            <div class="form-group" :class="{'has-error': errors.has('server.number_of_volunteers') }" >
                                <label for="number_of_volunteers">Number of Volunteers in your group</label>
                                <input name="number_of_volunteers" v-validate data-vv-rules="required" data-vv-as="number_of_volunteers" type="text" class="form-control" v-model="server.number_of_volunteers">
                                <span class='note note-error' v-show="errors.has('number_of_volunteers')">{{ errors.first('number_of_volunteers') }}</span>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" v-model="server.willing_to_lead">
                                    <i></i>I'm willing to lead this project
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
                willLead: false,
                name: '',
                email: '',
                phone: '',
                number_of_volunteers: 1,
                server: {},
                csrfToken: window.Laravel.csrfToken,
                churches: []
            }
        },

        computed: {
            //authUser() {
            //    return this.$store.getters.authUser
            //},

            category_name: function () {
                // `this` points to the vm instance
                if (this.project.project_category)
                    return this.project.project_category.name
                else
                    return null
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

            onValidate() {
                this.$validator.validateAll();
                console.log(this.errors);
                if (!this.errors.any()) {
                    console.log('hi');
                    this.signup();
                } else {
                    console.log('there');
                    this.$swal('Oops!', 'Form submission errors, please fill out all required fields.', 'error')
                }
            },

            validateBeforeSubmit(e) {
                this.$validator.validateAll();
                if (!this.errors.all()) {
                    //alert('hi');
                    //this.saveProject()
                }
            },

            getProject: function() {
                var self = this
                this.axios.get('/api/project/' + this.$route.params.projectID)
                .then((response) => {
                    self.project = response.data
                });
            },

            signup: function() {
                var self = this;

                const postData = this.server;

                this.axios.post('/api/project/'+ this.$route.params.projectID +'/server', postData)
                .then((response) => {
                    this.$swal('Thank you!!', 'You\'re all signed up!   ', 'info')

                    self.$router.push({ name: 'serve'})
                });
            },


            fetchChurches: function() {
                this.axios.get('/api/churches')
                .then((response) => {
                    this.churches = response.data.data
                });
            },
        },

        mounted() {
            //if (!this.authUser) {
            //    location.href = '/serve';
            //} else {
                this.fetchChurches();
                this.getProject();
            //}
        },
    }
</script>
