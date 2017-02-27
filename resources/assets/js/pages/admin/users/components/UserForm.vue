<template>
    <div>
        <div class="form-group" :class="{'has-error': errors.has('user.name') }" >
            <label for="name">Name</label>
            <input name="name" v-validate data-vv-rules="required" type="text" class="form-control" v-model="user.name">
            <span v-show="errors.has('name')">{{ errors.first('name') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('user.email') }" >
            <label for="email">Email</label>
            <input name="email" v-validate data-vv-rules="required|email"  type="text" class="form-control" v-model="user.email">
            <span v-show="errors.has('email')">{{ errors.first('email') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('user.password') }" >
            <label for="email">Password</label>
            <input name="email" v-validate data-vv-rules="required"  type="text" class="form-control" v-model="user.password">
            <span v-show="errors.has('password')">{{ errors.first('password') }}</span>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input name="phone" type="text" class="form-control" v-model="user.phone">
            <span v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('user.church_id') }" >
            <label for="church_id">Church</label>
            <select class="form-control" name="church_id" id="church_id" v-model="user.church_id">
                <option>Select One</option>
                <option v-for="church in churches" v-bind:value="church.id">
                    {{ church.name }}
                </option>
            </select>
            <span v-show="errors.has('church_id')">{{ errors.first('church_id') }}</span>
        </div>


        <div class="form-group" :class="{'has-error': errors.has('user.church_id') }" >
            <label for="roles">Roles</label>
            <select multiple name="selectedroles[]" v-model="selected_roles" options="roles">
            </select>
            <span v-show="errors.has('roles')">{{ errors.first('roles') }}</span>
        </div>

    </div>
</template>

<style>

</style>

<script>
    export default{
        props: ['user'],


        data(){
            return{
                churches: [],
                roles: []
            }
        },

        components: {  },


        computed: {
            // a computed getter
            selected_roles: function () {
                // `this` points to the vm instance
                return this.user.selected_roles
            }
        },


        methods: {
            fetchChurches: function() {
                this.axios.get('/api/churches')
                .then((response) => {
                    this.churches = response.data.data
                });
            },

            fetchRoles: function() {
                this.axios.get('/api/roles')
                .then((response) => {
                    this.roles = response.data.data
                });
            }
        },

        mounted: function() {
            this.fetchChurches();
            this.fetchRoles();
            this.user_roles = this.userRoles
        }
    }
</script>
