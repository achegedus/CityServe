<template>
    <div>
        <h3>Update Church</h3>
        <church-form :church="this.church"></church-form>

        <div class="form-group">
            <button type="submit" class="btn btn-error" @click="submitForm">Create Church</button>
        </div>
    </div>
</template>


<style>

</style>


<script>
    import ChurchForm from './components/ChurchForm.vue'
    import bus from '../../../bus.js'

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

            validateChild() {
                bus.$emit('validate');
            },

            clearChild() {
                bus.$emit('clear');
            },

            submitForm(e) {
                // Validate All returns a promise and provides the validation result.
                this.validateChild();
                console.log(this.errors);
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

        created() {
            bus.$on('errors-changed', (errors) => {
                this.errors.clear();
                errors.forEach(e => {
                    this.errors.add(e.field, e.msg, e.rule, e.scope);
                });
            });

            bus.$on('submit-church-response', this.saveChurch);
        },

        mounted: function() {

        },

        beforeDestroy() {
            bus.$off('submit-church-response', this.saveChurch);
        }

    }
</script>
