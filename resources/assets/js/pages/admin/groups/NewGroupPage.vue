<template>
    <div>
        <h3>Create Group</h3>
        <group-form :group="this.group"></group-form>

        <div class="form-group">
            <button type="submit" class="btn btn-error" @click="validateBeforeSubmit">Create Group</button>
        </div>
    </div>
</template>


<style>

</style>


<script>
    import GroupForm from './components/GroupForm.vue'

    export default{
        data(){
            return{
                group: {}
            }
        },

        components: {
            GroupForm
        },

        methods: {

            validateBeforeSubmit(e) {
                this.$validator.validateAll();
                if (!this.errors.any()) {
                    this.saveGroup()
                }
            },

            saveGroup: function() {
                var self = this;

                const postData = {
                    name: this.group.name,
                    members: this.group.members,
                    group_type_id: this.group.group_type_id,
                    person_id: this.group.person_id
                }

                this.axios.post('/api/group', postData)
                .then((response) => {
                    console.log('Updated');
                    self.$router.push({ name: 'admin-groups-page'})
                })
                .catch((error) => {
                    console.log('An error occurred');
                    console.log(error);
                });

            }
        }

    }
</script>
