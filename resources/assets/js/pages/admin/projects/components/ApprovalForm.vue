<template>
    <div>


        <div class="row">
            <div class="col-md-6">
                <header>Administrative Review</header>
                <fieldset>
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

                    <div class="form-group" :class="{'has-error': errors.has('project.evaluator_id') }" >
                        <label for="time">Evaluator</label>
                        <multiselect
                                v-model="project.evaluator"
                                :options="evaluators"
                                :searchable="false"
                                :close-on-select="false"
                                track-by="id"
                                label="name"
                                :show-labels="false"
                                placeholder="Pick an Evaluator">
                        </multiselect>

                        <span v-show="errors.has('evaluator_id')">{{ errors.first('evaluator_id') }}</span>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" v-model="project.evaluated">
                            <i></i>Project has been evaluated
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" v-model="project.approved">
                            <i></i>Project has been approved (*Will be live on website)
                        </label>
                    </div>

                    <div class="form-group" :class="{'has-error': errors.has('project.coordinator_id') }" >
                        <label for="time">Coordinator</label>
                        <multiselect
                                v-model="project.coordinator"
                                :options="coordinators"
                                :searchable="false"
                                :close-on-select="false"
                                track-by="id"
                                label="name"
                                :show-labels="false"
                                placeholder="Pick a coordinator">
                        </multiselect>
                        <span v-show="errors.has('coordinator_id')">{{ errors.first('coordinator_id') }}</span>
                    </div>

                    <div class="form-group" :class="{'has-error': errors.has('project.coordinator_id') }" >
                        <label for="time">Project Leader</label>
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



                    <div class="form-group" :class="{'has-error': errors.has('project.notes') }" >
                        <label for="notes">Notes</label>
                        <textarea name="notes" type="text" class="form-control" v-model="project.notes"></textarea>
                        <span v-show="errors.has('notes')">{{ errors.first('notes') }}</span>
                    </div>

                    <div class="form-group" :class="{'has-error': errors.has('project.short_description') }" >
                        <label for="short_description">Short Description</label>
                        <textarea name="short_description" type="text" class="form-control" v-model="project.short_description"></textarea>
                        <span v-show="errors.has('short_description')">{{ errors.first('short_description') }}</span>
                    </div>
                </fieldset>
            </div>

            <div class="col-md-6">
                <header>Volunteers ({{ project.volunteers }} of {{ project.numVolunteers }})</header>
                <fieldset>
                    <h3>People</h3>
                    <ul>
                        <li v-for="server in servers">{{ server.name}} ({{server.number_of_volunteers}}) - <a :href="'mailto:'+server.email">email</a> - <a v-on:click="removeVolunteer(server)">remove</a></li>
                    </ul>
                  
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
                servers: [],
                groups: [],
                all_volunteers: [],
                all_groups: [],
                project_categories: [],
                evaluators: [],
                coordinators: []
            }
        },

        methods: {
            onValidate() {
                this.$validator.validateAll();
                // if (this.errors.errors.length == 0) {
                if (!this.errors.any()) {
                    bus.$emit('project_validate');
                }
            },

            getAssignedVolunteers() {
                this.axios.get('/api/project/' + this.$route.params.projectID + '/servers')
                .then((response) => {
                    this.servers = response.data.data
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

            removeVolunteer(server) {
                if(confirm("Do you really want to delete?")){
                    this.axios.delete('/api/project/' + this.$route.params.projectID + '/server/' + server.id)
                    .then((response) => {

                    });
                } else {
                    return false;
                }
            },

            removeGroup(group) {
                this.axios.delete('/api/project/' + this.$route.params.projectID + '/group/' + group.id)
                .then((response) => {

                });
            },


            first_last_name ({ first_name, last_name }) {
                return `${first_name} ${last_name}`
            },

            name_number ({ name, number_of_volunteers }) {
                return `${name} (${number_of_volunteers})`
            },

            getCategories() {
                this.axios.get('/api/project-categories')
                .then((response) => {
                    this.project_categories = response.data.data
                });
            },

            getCoordinators() {
                this.axios.get('/api/coordinators')
                .then((response) => {
                    this.coordinators = response.data.data
                });
            },

            getEvaluators() {
                this.axios.get('/api/evaluators')
                .then((response) => {
                    this.evaluators = response.data.data
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
            this.getEvaluators()
            this.getCoordinators()
        },

        beforeDestroy() {
            bus.$off('approval_validate', this.onValidate);
        }
    }
</script>
