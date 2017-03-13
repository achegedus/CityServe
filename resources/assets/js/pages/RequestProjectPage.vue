<template>
    <div>
    <!--=== Slider ===-->
    <div class="interactive-slider-v2 img-v1">
        <div class="container">
            <h1>Request a Project</h1>
            <p>Serving beyond our walls</p>
        </div>
    </div>

    <div class="container">
        <project-form :project="this.project"></project-form>

        <div class="form-group">
            <button type="submit" class="btn btn-error" @click="submitForm">Submit Project</button>
        </div>
    </div>
    </div>
</template>


<style>

</style>


<script>

    import ProjectForm from './admin/projects/components/ProjectForm.vue'
    import bus from '../bus.js'

    export default{
        data(){
            return{
                project: {}
            }
        },

        components: {
            ProjectForm
        },

        methods: {


            submitForm(e) {
                bus.$emit('project_validate');
            },

            getContent() {
                this.axios.get('/api/content/').then((response) => {
                    this.projects = response.data.data
                })
            },

            saveProject: function() {
                var self = this;

                const postData = {
                    requester_org_name: this.project.requester_org_name,
                    requester_contact_name: this.project.requester_contact_name,
                    requester_address: this.project.requester_address,
                    requester_city: this.project.requester_city,
                    requester_state: this.project.requester_state,
                    requester_zipcode: this.project.requester_zipcode,
                    requester_phone: this.project.requester_phone,
                    requester_email: this.project.requester_email,
                    requester_church: this.project.requester_church,
                    event_contact_name: this.project.event_contact_name,
                    event_contact_phone: this.project.event_contact_phone,
                    event_address: this.project.event_address,
                    event_secondary_address: this.project.event_secondary_address,
                    event_city: this.project.event_city,
                    event_state: this.project.event_state,
                    event_zipcode: this.project.event_zipcode,
                    event_phone: this.project.event_phone,
                    directions: this.project.directions,
                    parking: this.project.parking,
                    description: this.project.description,
                    day: this.project.day,
                    time: this.project.time,
                    numVolunteers: this.project.numVolunteers,
                    family: this.project.family,
                    howUsed: this.project.howUsed,
                    skills: this.project.skills,
                    materialsRequesterWill: this.project.materialsRequesterWill,
                    materialsRequesterCannot: this.project.materialsRequesterCannot
                }

                this.axios.post('/api/submit-project', postData)
                .then((response) => {
                    console.log('Updated');
                    self.$router.push({ name: '<project-submit-complete></project-submit-complete>'})
                })
                .catch((error) => {
                    console.log('An error occurred');
                    console.log(error);
                });

            }
        },

        created() {
            bus.$on('errors-changed', (errors) => {
                this.errors.clear();
                errors.forEach(e => {
                    this.errors.add(e.field, e.msg, e.rule, e.scope);
                });
            });

            bus.$on('submit-project-response', this.saveProject);
        },

        beforeDestroy() {
            bus.$off('submit-project-response', this.saveProject);
        }


    }

</script>
