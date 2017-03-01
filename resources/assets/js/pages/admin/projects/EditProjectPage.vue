<template>
    <div>
        <h3>Edit Project</h3>
        <project-form :project="this.project"></project-form>
        <approval-form :project="this.project"></approval-form>

        <div class="form-group">
            <button type="submit" class="btn btn-error" @click="submitForm">Update Project</button>
        </div>
    </div>
</template>
<style>

</style>
<script>

    import ProjectForm from './components/ProjectForm.vue'
    import ApprovalForm from './components/ApprovalForm.vue'
    import bus from '../../../bus.js'

    export default{
        data(){
            return{
                project: {}
            }
        },

        components: {
            ProjectForm, ApprovalForm
        },

        methods: {

            validateChild() {
                bus.$emit('approval_validate');
            },

            fetchProject() {
                this.axios.get('/api/project/' + this.$route.params.projectID)
                .then((response) => {
                    this.project = response.data
                });
            },

            submitForm(e) {
                // Validate All returns a promise and provides the validation result.
                this.validateChild();
                console.log(this.errors);
            },

            validateBeforeSubmit(e) {
                this.$validator.validateAll();
                if (!this.errors.any()) {
                    alert('hi');
                    //this.saveProject()
                }
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
                    materialsRequesterCannot: this.project.materialsRequesterCannot,
                    materialsCityServe: this.project.materialsRequesterWill,
                    evaluated: this.project.evaluated,
                    approved: this.project.approved,
                    assigned: this.project.assigned,
                    evaluator_id: this.project.evaluator_id,
                    category_id: this.project.category_id.id,
                    volunteers_needed: this.project.volunteers_needed,
                    notes: this.project.notes,
                    coordinator_id: this.project.coordinator_id,
                    confirmed: this.project.confirmed,
                    short_description: this.project.short_description
                }

                this.axios.put('/api/project/' + this.$route.params.projectID, postData)
                .then((response) => {
                    console.log('Updated');
                    self.$router.push({ name: 'admin-projects-page'})
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

        mounted () {
            this.fetchProject()
        },

        beforeDestroy() {
            bus.$off('submit-project-response', this.saveChurch);
        }

    }

</script>
