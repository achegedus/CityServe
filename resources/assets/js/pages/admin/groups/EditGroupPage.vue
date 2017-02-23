<template>
    <div>
        <h3>Update Group</h3>
        <form @submit.prevent="validateBeforeSubmit">
            <group-form :group="this.group"></group-form>

            <div class="form-group">
                <button type="submit" class="btn btn-error">Update Group</button>
            </div>
        </form>
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
            fetchGroup: function() {
                this.axios.get('/api/group/' + this.$route.params.groupID)
                .then((response) => {
                    this.group = response.data
                });
            },

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
                    person_id: this.church.person_id
                }

                this.axios.put('/api/group/' + this.$route.params.groupID, postData)
                .then((response) => {
                    self.$router.push({ name: 'admin-groups-page'})
                })
                .catch((error) => {
                    console.log('An error occurred');
                    console.log(error);
                });

            }
        },

        mounted: function() {
            this.fetchGroup();
        }

    }
</script>
