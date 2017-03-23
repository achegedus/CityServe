<template>
    <div>

        <fieldset>

            <div class="form-group" :class="{'has-error': errors.has('user.first_name') }" >
                <label for="first_name">First Name</label>
                <input name="first_name" v-validate data-vv-rules="required" data-vv-as="First name" type="text" class="form-control" v-model="user.first_name">
                <span class='note note-error' v-show="errors.has('first_name')">{{ errors.first('first_name') }}</span>
            </div>

            <div class="form-group" :class="{'has-error': errors.has('user.last_name') }" >
                <label for="last_name">Last Name</label>
                <input name="last_name" v-validate data-vv-rules="required" data-vv-as="Last name" type="text" class="form-control" v-model="user.last_name">
                <span class='note note-error' v-show="errors.has('last_name')">{{ errors.first('last_name') }}</span>
            </div>

            <div class="form-group" :class="{'has-error': errors.has('user.email') }" >
                <label for="email">Email</label>
                <input name="email" v-validate data-vv-rules="required|email" data-vv-as="Email" type="text" class="form-control" v-model="user.email">
                <span class='note note-error' v-show="errors.has('email')">{{ errors.first('email') }}</span>
            </div>

            <div class="form-group" :class="{'has-error': errors.has('user.address') }" >
                <label for="address">Address</label>
                <input name="address" v-validate data-vv-rules="required" data-vv-as="Address"  type="text" class="form-control" v-model="user.address">
                <span class='note note-error' v-show="errors.has('address')">{{ errors.first('address') }}</span>
            </div>

            <div class="form-group">
                <label for="address2">Secondary Address</label>
                <input name="secondary_address" type="text" class="form-control" v-model="user.secondary_address">
                <span class='note note-error' v-show="errors.has('secondary_address')">{{ errors.first('secondary_address') }}</span>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input name="city" v-validate data-vv-rules="required" data-vv-as="City" type="text" class="form-control" v-model="user.city">
                <span class='note note-error' v-show="errors.has('city')">{{ errors.first('city') }}</span>
            </div>

            <div class="form-group">
                <label for="state">State</label>
                <input name="state" v-validate data-vv-rules="required" data-vv-as="State" type="text" class="form-control" v-model="user.state">
                <span class='note note-error' v-show="errors.has('state')">{{ errors.first('state') }}</span>
            </div>

            <div class="form-group">
                <label for="zipcode">Zipcode</label>
                <input name="zipcode" v-validate data-vv-rules="required" data-vv-as="Zipcode" type="text" class="form-control" v-model="user.zipcode">
                <span class='note note-error' v-show="errors.has('zipcode')">{{ errors.first('zipcode') }}</span>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input name="phone" type="text" v-validate data-vv-rules="required" data-vv-as="Phone Number" class="form-control" v-model="user.phone">
                <span class='note note-error' v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
            </div>

            <div class="form-group" :class="{'has-error': errors.has('user.church_id') }" >
                <label for="church_id">Church</label>
                <select class="form-control" name="church_id" id="church_id" v-model="user.church_id">
                    <option>Select One</option>
                    <option v-for="church in churches" v-bind:value="church.id">
                        {{ church.name }}
                    </option>
                </select>
                <span class='note note-error' v-show="errors.has('church_id')">{{ errors.first('church_id') }}</span>
            </div>


            <div class="form-group" :class="{'has-error': errors.has('user.church_id') }" >
                <label for="roles">Roles</label>
                <multiselect
                        v-model="user.selected_roles"
                        :options="roles"
                        label="name"
                        :multiple="true"
                        track-by="id">
                </multiselect>
                <span class='note note-error' v-show="errors.has('roles')">{{ errors.first('roles') }}</span>
            </div>

            <div class="form-group" :class="{'has-error': errors.has('user.password') }" >
                <label for="password">Password</label>
                <input name="password" v-validate data-vv-rules="confirmed:pw_confirm" type="password" class="form-control" v-model="user.password">
                <span class='note note-error' v-show="errors.has('password')">{{ errors.first('password') }}</span>
            </div>

            <div class="form-group" :class="{'has-error': errors.has('user.password') }" >
                <label for="pw_confirm">Password</label>
                <input name="pw_confirm" v-validate type="password" class="form-control">
                <span class='note note-error' v-show="errors.has('pw_confirm')">{{ errors.first('pw_confirm') }}</span>
            </div>
        </fieldset>
    </div>
</template>

<style>

</style>

<script>
    import bus from '../../../../bus.js'


    export default{
        props: ['user'],

        data(){
            return{
                churches: [],
                roles: [],
                selectedRoles: []
            }
        },

        components: {  },

        methods: {
            onValidate() {
                this.$validator.validateAll();
                if (this.errors.errors.length == 0) {
                    bus.$emit('submit-user-response');
                } else {
                    this.$swal('Oops!', 'Form submission errors, please fill out all required fields.', 'error')
                }
            },

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
        },

        created() {
            bus.$on('user_validate', this.onValidate);
            this.$watch(() => this.errors.errors, (value) => {
                bus.$emit('errors-changed', value);
            });
        },

        beforeDestroy() {
            bus.$off('user_validate', this.onValidate);
        }
    }
</script>
