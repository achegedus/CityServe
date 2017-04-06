<template>
    <div class="projectbox">
        <div class="funny-boxes funny-boxes-top-sea">
            <div class="row">
                <div class="col-md-4 funny-boxes-img">
                    <h5>Details:</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa-fw fa fa-paint-brush"></i> {{ category_name }}</li>
                        <li><i class="fa-fw fa fa-map-marker"></i> {{ project.event_city }}</li>
                        <li><i class="fa-fw fa fa-calendar"></i> {{ project.day }}</li>
                        <li><i class="fa-fw fa fa-clock-o"></i> {{ project.time }}</li>
                        <li><i class="fa-fw fa fa-users"></i> Volunteers needed: {{project.volunteers_neededf}}</li>
                    </ul>
                    <h5>Register to serve:</h5>
                    <button type="submit" class="btn btn-error signupButton" @click="indivButtonClicked">Individual</button>
                    <button type="submit" class="btn btn-error signupButton" @click="groupButtonClicked">Group</button>
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
    import { mapState } from 'vuex'

    export default{
        props: ['project'],

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

            ...mapState({
                userStore: state => state.userStore
            })
        },

        methods: {
            groupButtonClicked: function () {
                if (this.userStore.authUser) {
                    this.$router.push({ name: 'volunteer-group', params: { projectID: this.project.id }})
                } else {
                    location.href = '/login';
                }
            },

            indivButtonClicked: function() {
                if (this.userStore.authUser) {
                    this.$router.push({ name: 'volunteer-individual', params: { projectID: this.project.id }})
                } else {
                    location.href = '/login';
                }
            }
        }
    }
</script>
