<template>
    <div>
        <h3>Create Project</h3>
        <form @submit.prevent="validateBeforeSubmit">
            <project-form :project="this.project"></project-form>
            <approval-form :project="this.project"></approval-form>

            <div class="form-group">
                <button type="submit" class="btn btn-error">Create Project</button>
            </div>
        </form>
    </div>
</template>
<style>

</style>
<script>

    import ProjectForm from './components/ProjectForm.vue'
    import ApprovalForm from './components/ApprovalForm.vue'

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

            validateBeforeSubmit(e) {
                this.$validator.validateAll();
                if (!this.errors.any()) {
                    //this.saveProject()
                }
            },

            saveProject: function() {
                var self = this;

                const postData = {
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password,
                    phone: this.user.phone,
                    church_id: this.user.church_id
                }

                this.axios.post('/api/project', postData)
                .then((response) => {
                    console.log('Updated');
                    self.$router.push({ name: 'admin-projects-page'})
                })
                .catch((error) => {
                    console.log('An error occurred');
                    console.log(error);
                });

            }
        }

    }

</script>
