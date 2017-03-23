<template>
    <div>
        <h3>Update User</h3>
        <form class="sky-form" v-on:submit.prevent="validateBeforeSubmit" >
            <user-form :user="this.user"></user-form>

            <fieldset>
                <div class="form-group">
                    <button type="submit" class="btn btn-error">Update User</button>
                </div>
            </fieldset>
        </form>
    </div>
</template>


<style>

</style>


<script>
    import UserForm from './components/UserForm.vue'
    import bus from '../../../bus.js'


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
                bus.$emit('user_validate');
            },

            saveUser: function() {
                var self = this;

                const postData = {
                    first_name: this.user.first_name,
                    last_name: this.user.last_name,
                    address: this.user.address,
                    secondary_address: this.user.secondary_address,
                    city: this.user.city,
                    state: this.user.state,
                    zipcode: this.user.zipcode,
                    email: this.user.email,
                    phone: this.user.phone,
                    church_id: this.user.church_id,
                    other_church: this.user.other_church,
                    roles: this.user.selected_roles
                }

                if (this.user.password != "" && this.user.password != null) {
                    postData.password = this.user.password
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
        },

        created() {
            bus.$on('errors-changed', (errors) => {
                this.errors.clear();
                errors.forEach(e => {
                    this.errors.add(e.field, e.msg, e.rule, e.scope);
                });
            });

            bus.$on('submit-user-response', this.saveUser);
        },

        beforeDestroy() {
            bus.$off('submit-user-response', this.saveUser);
        }


    }
</script>
