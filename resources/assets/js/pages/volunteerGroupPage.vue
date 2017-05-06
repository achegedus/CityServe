<template>
    <div class="container" id="groupServeBox">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin-top: 40px">
                <div class="panel-heading">Register a group to serve!</div>
                <div class="panel-body">
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

                    <div class="col-md-9">
                        <h3>Project Description</h3>
                        <p>{{project.description}}</p>

                        <h4>How you will serve</h4>
                        <p>{{project.howUsed}}</p>

                        <h4>Skills needed</h4>
                        <p>{{project.skills}}</p>

                        <form class="sky-form" v-on:submit.prevent="saveGroup">

                            <div class="form-group" :class="{'has-error': errors.has('group_name') }" >
                                <label for="group_name">Group Name</label>
                                <input name="group_name" v-validate="'required'" data-vv-as="Group name" type="text" class="form-control" v-model="group_name">
                                <span class='note note-error' v-show="errors.has('group_name')">{{ errors.first('group_name') }}</span>
                            </div>

                            <div class="form-group" :class="{'has-error': errors.has('group_members') }" >
                                <label for="group_members">Number of people</label>
                                <input name="group_members" v-validate="'required|numeric|max_vols'" data-vv-as="Group members" type="text" class="form-control" v-model="group_members">
                                <span class='note note-error' v-show="errors.has('group_members')">{{ errors.first('group_members') }}</span>
                            </div>

                            <div class="form-group" :class="{'has-error': errors.has('group_type_id') }" >
                                <input type="hidden"
                                       name="group_type_id_key"
                                       v-model="group_type_id_key"
                                       data-vv-as="Group type"
                                       v-validate data-vv-rules="required|numeric">
                                <label for="group_members">Type of group</label>
                                <multiselect
                                        v-model="group_type_id"
                                        :options="group_types"
                                        label="name"
                                        :multiple="false"
                                        track-by="id">
                                </multiselect>
                                <span class='note note-error' v-show="errors.has('group_type_id_key')">{{ errors.first('group_type_id_key') }}</span>
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
    import { Validator } from 'vee-validate';

    export default{
        data(){
            return{
                project: {},
                group: {},
                willLead: false,
                group_types: [],

                group_name: '',
                group_type_id: null,
                group_members: null
            }
        },

        computed: {
            authUser() {
                return this.$store.getters.authUser
            },

            category_name: function () {
                if (this.project.project_category)
                    return this.project.project_category.name
                else
                    return null
            },

            group_type_id_key: function() {
                if (this.group_type_id)
                    return this.group_type_id.id
                else
                    return null
            }
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

                this.$validator.validateAll().then(() => {
                    const groupPostData = {
                        name: self.group_name,
                        members: self.group_members,
                        group_type_id: self.group_type_id.id,
                        project_id: self.$route.params.projectID
                    }

                    self.axios.post('/api/group', groupPostData)
                    .then((response) => {
                        const postData = {
                            willLead: self.willLead,
                        }

                        self.axios.post('/api/project/'+ self.$route.params.projectID +'/group/' + response.data.id, postData)
                        .then((response) => {
                            self.$router.push({ name: 'serve'})
                        });
                    });
                }).catch(() => {
                    // eslint-disable-next-line
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

            Validator.extend('max_vols', {
                getMessage: (field) => `This project doesn't need that many volunteers.`,
                validate: (value) => new Promise(resolve => {
                    resolve({
                        valid: value <= this.project.numVolunteers
                    });
                })
            });
        }


    }
</script>
