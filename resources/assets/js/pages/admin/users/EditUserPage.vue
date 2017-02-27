<template>
    <div>
        <h3>Update User</h3>
        <form @submit.prevent="validateBeforeSubmit">
            <user-form :user="this.user"></user-form>

            <div class="form-group">
                <button type="submit" class="btn btn-error">Update User</button>
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
                user: {},
            }
        },

        components: {
            UserForm
        },

        methods: {
            fetchUser: function() {
                var self = this
                this.axios.get('/api/user/' + this.$route.params.userID)
                .then((response) => {
                    self.user = response.data
                });
            },

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
                    church_id: this.user.church_id,
                    roles: this.user.selected_roles
                }

                this.axios.put('/api/user/' + this.$route.params.userID, postData)
                .then((response) => {
                    console.log('Updated');
                    self.$router.push({ name: 'admin-users-page'})
                })
                .catch((error) => {
                    console.log('An error occurred');
                    console.log(error);
                });

            }
        },

        mounted: function() {
            this.fetchUser();
        }

    }
</script>
