<template>
    <div class="container" id="groupServeBox">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin-top: 40px">
                <div class="panel-heading">Register a group to serve!</div>
                <div class="panel-body">
                    <div class="col-md-3">
                        <h3>Details</h3>
                        <ul class="list-unstyled">
                            <li><i class="fa-fw fa fa-paint-brush"></i> {{ project.project_category.name }}</li>
                            <li><i class="fa-fw fa fa-map-marker"></i> {{ project.event_city }}</li>
                            <li><i class="fa-fw fa fa-calendar"></i> {{ project.day }}</li>
                            <li><i class="fa-fw fa fa-clock-o"></i> {{ project.time }}</li>
                            <li><i class="fa-fw fa fa-users"></i> Volunteers needed: {{project.volunteers_neededf}}</li>
                        </ul>
                    </div>

                    <div class="col-md-9">
                        <h3>Project Description</h3>
                        <p>{{project.description}}</p>

                        <h4>How you will serve</h4>
                        <p>{{project.howUsed}}</p>

                        <h4>Skills needed</h4>
                        <p>{{project.skills}}</p>

                        <form class="sky-form" v-on:submit.prevent="saveGroup">

                            <div class="form-group" :class="{'has-error': errors.has('group.name') }" >
                                <label for="group_name">Group Name</label>
                                <input name="group_name" v-validate data-vv-rules="required|max:2" data-vv-as="Group name" type="text" class="form-control" v-model="group.name">
                                <span class='note note-error' v-show="errors.has('group.name')">{{ errors.first('group.name') }}</span>
                            </div>

                            <div class="form-group" :class="{'has-error': errors.has('group.members') }" >
                                <label for="group_members">Number of people</label>
                                <input name="group_members" v-validate data-vv-rules="required|numeric" data-vv-as="Group members" type="text" class="form-control" v-model="group.members">
                                <span class='note note-error' v-show="errors.has('group.members')">{{ errors.first('group.members') }}</span>
                            </div>

                            <div class="form-group" :class="{'has-error': errors.has('group.members') }" >
                                <label for="group_members">Type of group</label>
                                <multiselect
                                        v-model="group.group_type_id"
                                        :options="group_types"
                                        label="name"
                                        :multiple="false"
                                        track-by="id">
                                </multiselect>
                                <span class='note note-error' v-show="errors.has('group.members')">{{ errors.first('group.members') }}</span>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" v-model="willLead">
                                    <i></i>I would like to lead this project
                                </label>
                            </div>

                            <button type="submit" class="btn btn-info">Sign up my group for this project</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<style>
    #groupServeBox {
        margin-top: 30px;
        margin-bottom: 100px;
    }
</style>


<script>
    //import { mapState } from 'vuex'

    export default{
        data(){
            return{
                project: {},
                group: {},
                willLead: false,
                group_types: []
            }
        },

        computed: {
            authUser() {
                return this.$store.getters.authUser
            }
        },

        components:{

        },

        methods: {
            getProject: function() {
                var self = this
                this.axios.get('/api/project/' + this.$route.params.projectID)
                .then((response) => {
                    self.project = response.data
                });
            },

            getGroupTypes: function() {
                var self = this
                this.axios.get('/api/group_types')
                .then((response) => {
                    self.group_types = response.data.data
                });
            },

            saveGroup: function() {
                var self = this;

                const groupPostData = {
                    name: self.group.name,
                    members: self.group.members,
                    group_type_id: self.group.group_type_id,
                    project_id: self.$route.params.projectID
                }

                self.axios.post('/api/group', groupPostData)
                .then((response) => {
                    const postData = {
                        willLead: self.willLead,
                    }

                    self.axios.post('/api/project/'+ self.$route.params.projectID +'/group/' + response.data.id, postData)
                    .then((response) => {

                    });
                });



            }
        },

        mounted() {
            if (!this.authUser) {
                location.href = '/serve';
            } else {
                this.getProject();
            }

            this.getGroupTypes();
        },
    }
</script>
