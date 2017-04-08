<template>
    <div class="projectbox">
        <div :class="boxStyle">
            <div class="row">
                <div class="col-md-4 funny-boxes-img">
                    <h5>Details:</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa-fw fa fa-hashtag"></i> Project {{ project.id }}</li>
                        <li><i class="fa-fw fa fa-paint-brush"></i> {{ category_name }}</li>
                        <li><i class="fa-fw fa fa-map-marker"></i> {{ project.event_city }}</li>
                        <li><i class="fa-fw fa fa-calendar"></i> {{ project.day | capitalize }}</li>
                        <li><i class="fa-fw fa fa-clock-o"></i> {{ project.time | timeformat }}</li>
                        <li><i class="fa-fw fa fa-users"></i> Volunteers needed: {{project.numVolunteers}}</li>
                    </ul>
                    <div v-if="!assigned">
                        <h5>Register to serve:</h5>
                        <button class="btn btn-error signupButton" @click="indivButtonClicked">Individual</button>
                        <button class="btn btn-error signupButton" @click="groupButtonClicked">Group</button>
                    </div>
                    <div v-else>
                        <h5>You are signed up for this project!</h5>
                    </div>
                </div>
                <div class="col-md-8">
                    <h5>Description:</h5>
                    <p>{{ project.description }}</p>

                    <h5>Skills Requested:</h5>
                    <p>{{ project.skills }}</p>
                </div>
            </div>

        </div>
    </div>
</template>

<style>
    h5 {
        margin-top: 10px;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .funny-boxes-top-sea {
        border-top: solid 2px #468390;
    }

    .funny-boxes .funny-boxes-img li i {
        color: #468390;
    }

    .signupButton {
        width: 100%;
        margin-bottom: 5px;
        color: #ffffff;
        background-color: #468390;
    }

    .projectbox {
        margin-top: 10px;
    }

    .funny-boxes {
        min-height: 300px;
    }
</style>

<script>
    import bus from '../bus.js'
    //import { mapState } from 'vuex'

    export default{
        props: ['project', 'assigned'],

        data(){
            return{
                msg:'hello vue'
            }
        },

        computed: {
            category_name: function () {
                // `this` points to the vm instance
                return this.project.project_category.name
            },

            authUser() {
                return this.$store.getters.authUser
            },

            boxStyle: function() {
                if (this.assigned) {
                    return "funny-boxes funny-boxes-top-red"
                } else {
                    return "funny-boxes funny-boxes-top-sea";
                }
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

        methods: {
            groupButtonClicked: function () {
                if (this.authUser) {
                    this.$router.push({ name: 'volunteer-group', params: { projectID: this.project.id }})
                } else {
                    location.href = '/login';
                }
            },

            indivButtonClicked: function() {
                if (this.authUser) {
                    this.$router.push({ name: 'volunteer-individual', params: { projectID: this.project.id }})
                } else {
                    location.href = '/login';
                }
            }
        }
    }
</script>
