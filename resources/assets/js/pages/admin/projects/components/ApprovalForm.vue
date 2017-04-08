<template>
    <div>


        <div class="row">
            <div class="col-md-6">
                <header>Administrative Review</header>
                <fieldset>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" v-model="project.evaluated">
                            <i></i>Project has been evaluated
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" v-model="project.approved">
                            <i></i>Project has been approved
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" v-model="project.assigned">
                            <i></i>Project has been assigned
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" v-model="project.volunteers_needed">
                            <i></i>Volunteers still needed
                        </label>
                    </div>

                    <div class="form-group" :class="{'has-error': errors.has('project.coordinator_id') }" >
                        <label for="time">Coordinator</label>
                        <select name="coordinator_id" class="form-control" v-validate data-vv-rules="required">
                            <option>Select One</option>
                        </select>
                        <span v-show="errors.has('coordinator_id')">{{ errors.first('coordinator_id') }}</span>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" v-model="project.confirmed">
                            <i></i>Project has been confirmed
                        </label>
                    </div>

                    <div class="form-group" :class="{'has-error': errors.has('project.evaluator_id') }" >
                        <label for="time">Evaluator</label>
                        <select name="evaluator_id" class="form-control" v-validate data-vv-rules="required">
                            <option>Select One</option>
                        </select>
                        <span v-show="errors.has('evaluator_id')">{{ errors.first('evaluator_id') }}</span>
                    </div>

                    <div class="form-group" :class="{'has-error': errors.has('project.category_id') }" >
                        <label for="time">Category</label>
                        <multiselect
                            v-model="project.category_id"
                            :options="project_categories"
                            :searchable="false"
                            :close-on-select="false"
                            track-by="id"
                            label="name"
                            :show-labels="false"
                            placeholder="Pick a category">
                        </multiselect>
                        <span v-show="errors.has('category_id')">{{ errors.first('category_id') }}</span>
                    </div>

                    <div class="form-group" :class="{'has-error': errors.has('project.notes') }" >
                        <label for="notes">Notes</label>
                        <textarea name="notes" type="text" class="form-control" v-model="project.notes"></textarea>
                        <span v-show="errors.has('notes')">{{ errors.first('notes') }}</span>
                    </div>

                    <div class="form-group" :class="{'has-error': errors.has('project.short_description') }" >
                        <label for="short_description">Short Description</label>
                        <textarea name="short_description" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.short_description"></textarea>
                        <span v-show="errors.has('short_description')">{{ errors.first('short_description') }}</span>
                    </div>
                </fieldset>
            </div>

            <div class="col-md-6">
                <header>Volunteers ({{ project.volunteers }} of {{ project.numVolunteers }})</header>
                <fieldset>
                    <h3>People</h3>
                    <multiselect
                        v-model="volunteers"
                        :options="all_volunteers"
                        label="first_name"
                        :custom-label="first_last_name"
                        :multiple="true"
                        @select="addVolunteer"
                        placeholder="Select a volunteer"
                        @remove="removeVolunteer"
                        track-by="id">
                    </multiselect>

                    <h3>Groups</h3>
                    <multiselect
                        v-model="groups"
                        :options="all_groups"
                        label="name"
                        :multiple="true"
                        placeholder="Select a group"
                        @select="addGroup"
                        @remove="removeGroup"
                        track-by="id">
                    </multiselect>
                </fieldset>
            </div>
        </div>


    </div>
</template>

<style>

</style>

<script>
    import bus from '../../../../bus.js'

    export default{
        props: ['project'],

        data(){
            return{
                volunteers: [],
                groups: [],
                all_volunteers: [],
                all_groups: [],
                project_categories: []
            }
        },

        methods: {
            onValidate() {
                this.$validator.validateAll();
                if (this.errors.errors.length == 0) {
                    bus.$emit('project_validate');
                }
            },

            getAssignedVolunteers() {
                this.axios.get('/api/project/' + this.$route.params.projectID + '/volunteers')
                .then((response) => {
                    this.volunteers = response.data.data
                });
            },

            getAssignedGroups() {
                this.axios.get('/api/project/' + this.$route.params.projectID + '/groups')
                .then((response) => {
                    this.groups = response.data.data
                });
            },

            getAllGroups() {
                this.axios.get('/api/groups')
                .then((response) => {
                    this.all_groups = response.data.data
                });
            },

            getAllVolunteers() {
                this.axios.get('/api/volunteers')
                .then((response) => {
                    this.all_volunteers = response.data.data
                });
            },

            addVolunteer(user) {
                this.axios.post('/api/project/' + this.$route.params.projectID + '/volunteer/' + user.id)
                .then((response) => {

                });
            },

            addGroup(group) {
                this.axios.post('/api/project/' + this.$route.params.projectID + '/group/' + group.id)
                .then((response) => {

                });
            },

            removeVolunteer(user) {
                this.axios.delete('/api/project/' + this.$route.params.projectID + '/volunteer/' + user.id)
                .then((response) => {

                });
            },

            removeGroup(group) {
                this.axios.delete('/api/project/' + this.$route.params.projectID + '/group/' + group.id)
                .then((response) => {

                });
            },


            first_last_name ({ first_name, last_name }) {
                return `${first_name} ${last_name}`
            },

            getCategories() {
                this.axios.get('/api/project-categories')
                .then((response) => {
                    this.project_categories = response.data.data
                });
            }
        },

        created() {
            bus.$on('approval_validate', this.onValidate);
            this.$watch(() => this.errors.errors, (value) => {
                bus.$emit('errors-changed', value);
            });

            this.getAssignedVolunteers()
            this.getAssignedGroups()
            this.getAllVolunteers()
            this.getAllGroups()
            this.getCategories()
        },

        beforeDestroy() {
            bus.$off('approval_validate', this.onValidate);
        }
    }
</script>
