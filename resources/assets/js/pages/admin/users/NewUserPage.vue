<template>
    <div>
        <form class="sky-form" v-on:submit.prevent="validateBeforeSubmit" >
            <header>Create User</header>
            <user-form :user="this.user"></user-form>

            <fieldset>
                <div class="form-group">
                    <button type="submit" class="btn btn-error">Create User</button>
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
                user: {}
            }
        },

        components: {
            UserForm
        },

        methods: {

            validateBeforeSubmit(e) {
                if (this.user.password != "" && this.user.password != null) {
                    bus.$emit('user_validate');
                }
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
