<template>
    <div>
        <h3>Update Church</h3>
        <form @submit.prevent="validateBeforeSubmit">
            <church-form :church="this.church"></church-form>

            <div class="form-group">
                <button type="submit" class="btn btn-error">Create Church</button>
            </div>
        </form>
    </div>
</template>


<style>

</style>


<script>
    import ChurchForm from './components/ChurchForm.vue'

    export default{
        data(){
            return{
                msg:'hello vue',
                church: {}
            }
        },

        components: {
            ChurchForm
        },

        methods: {

            validateBeforeSubmit(e) {
                this.$validator.validateAll();
                if (!this.errors.any()) {
                    this.saveChurch()
                }
            },

            saveChurch: function() {
                var self = this;

                const postData = {
                    name: this.church.name,
                    address: this.church.address,
                    address2: this.church.address2,
                    city: this.church.city,
                    state: this.church.state,
                    zipcode: this.church.zipcode,
                    url: this.church.url
                }

                this.axios.post('/api/church/', postData)
                .then((response) => {
                    console.log('Updated');
                    self.$router.push({ name: 'admin-churches-page'})
                })
                .catch((error) => {
                    console.log('An error occurred');
                    console.log(error);
                });

            }
        },

        mounted: function() {

        }

    }
</script>
