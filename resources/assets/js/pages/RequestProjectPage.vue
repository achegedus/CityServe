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
            <div class="row" id="formcontainer">
                <div class="col-sm-8">
                    <div class="tag-box tag-box-v2 box-shadow shadow-effect-1">
                        <h2>Have a project to request?</h2>
                        <p>Please complete the project request form! If you're unable to complete the form, please call 814.238.0822 ext 20! All types of projects can be requested - painting, yard work, cleaning and organizing, baking, home repair/construction, visiting with folks, hosting events, roofing repairs and more.</p><p>While we strive to complete all requested projects, we can't commit to that. If you request a painting, home repair, roofing or construction project, you'll hear from a CityServe evaluator to schedule an appointment to learn more about your project. Evaluators will determine if your project is within the scope of what CityServe is able to complete. We'll notify project requestors at least one week prior to CityServe to confirm if we have volunteers for your project.</p>
                    </div>

                    <form class="sky-form" v-on:submit.prevent="submitForm" >
                        <project-form :project="this.project"></project-form>

                        <fieldset>
                            <div class="form-group">
                                <button type="submit" class="btn btn-error">Submit Project</button>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <div class="col-sm-4">
                    <div class="row margin-bottom-50">
                        <div class="shadow-wrapper md-margin-bottom-40">
                            <div class="box-shadow shadow-effect-2">
                                <img class="img-responsive" src="/images/IMG_3669.jpg" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="row margin-bottom-50">
                        <div class="shadow-wrapper md-margin-bottom-40">
                            <div class="box-shadow shadow-effect-2">
                                <img class="img-responsive" src="/images/IMG_1886.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<style>
    .interactive-slider-v2.img-v1 {
        background: url(/images/IMG_1995.jpg) no-repeat;
        background-size: cover;
        background-position: center center;
    }

    #formcontainer {
        margin-top: 50px;
        margin-bottom: 100px;
    }

    p {
        padding-bottom: 10px;
    }
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
                    self.$router.push({ name: 'project-submit-success'})
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
