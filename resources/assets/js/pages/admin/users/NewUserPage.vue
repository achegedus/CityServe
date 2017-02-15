<template>
    <div>
        <h3>Create User</h3>
        <form @submit.prevent="validateBeforeSubmit">
            <user-form :user="this.user"></user-form>

            <div class="form-group">
                <button type="submit" class="btn btn-error">Create User</button>
            </div>
        </form>
    </div>
</template>


<style>

</style>


<script>
    import UserForm from './components/UserForm.vue'

    export default{
        data(){
            return{
                user: {}
            }
        },

        components: {
            UserForm
        },

        methods: {

            validateBeforeSubmit(e) {
                this.$validator.validateAll();
                if (!this.errors.any()) {
                    this.saveUser()
                }
            },

            saveUser: function() {
                var self = this;

                const postData = {
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password,
                    phone: this.user.phone,
                    church_id: this.user.church_id
                }

                this.axios.post('/api/user', postData)
                .then((response) => {
                    console.log('Updated');
                    self.$router.push({ name: 'admin-users-page'})
                })
                .catch((error) => {
                    console.log('An error occurred');
                    console.log(error);
                });

            }
        }

    }
</script>
