<template>
    <div>
        <div class="form-group" :class="{'has-error': errors.has('group.name') }" >
            <label for="name">Group Name</label>
            <input v-validate data-vv-rules="required" data-vv-as="Group Name" type="text" class="form-control" name="name" v-model="group.name" >
            <span v-show="errors.has('name')">{{ errors.first('name') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('group.members') }" >
            <label for="members">Members</label>
            <input name="members" v-validate data-vv-rules="required" data-vv-as="Number of Members" type="text" class="form-control" v-model="group.members">
            <span v-show="errors.has('members')">{{ errors.first('members') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('group.group_type_id') }" >
            <label for="group_type_id">Group Type</label>

            <select name="group_type_id" class="form-control" v-validate data-vv-rules="required" data-vv-as="Group Type" v-model="group.group_type_id">
                <option>Select One</option>
                <option v-for="option in group_types" v-bind:value="option.id">{{option.name}}</option>
            </select>
            <span v-show="errors.has('group_type_id')">{{ errors.first('group_type_id') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('group.person_id') }" >
            <label for="time">Group Leader</label>
            <select name="time" class="form-control" v-validate data-vv-rules="required" data-vv-as="Group Leader" v-model="group.person_id">
                <option>Select One</option>
                <option v-for="option in people" v-bind:value="option.id">{{option.last_name}}, {{option.first_name}}</option>
            </select>
            <span v-show="errors.has('person_id')">{{ errors.first('person_id') }}</span>
        </div>
    </div>
</template>

<style>

</style>

<script>
    import bus from '../../../../bus.js'

    export default{
        props: ['group'],

        data(){
            return{
                group_types: {},
                people: {}
            }
        },

        methods: {
            fetchGroupTypes: function() {
                this.axios.get('/api/group_types')
                .then((response) => {
                    this.group_types = response.data.data
                });
            },

            fetchPeople: function() {
                this.axios.get('/api/people')
                .then((response) => {
                    this.people = response.data.data
                });
            },

            onValidate() {
                this.$validator.validateAll();
                if (this.errors.errors.length == 0) {
                    bus.$emit('submit-group-response');
                }
            }
        },

        mounted: function() {
            this.fetchGroupTypes();
            this.fetchPeople();
        }
    }
</script>
