<template>
    <div>
        <div class="form-group" :class="{'has-error': errors.has('church.name') }" >
            <label for="name">Church Name</label>
            <input v-validate="'required'" type="text" class="form-control" name="name" v-model="church.name" >
            <span v-show="errors.has('name')">{{ errors.first('name') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('church.address') }" >
            <label for="address">Address</label>
            <input name="address" v-validate="'required'" type="text" class="form-control" v-model="church.address">
            <span v-show="errors.has('address')">{{ errors.first('address') }}</span>
        </div>

        <div class="form-group">
            <label for="address2">Secondary Address</label>
            <input name="address2" type="text" class="form-control" v-model="church.address2">
            <span v-show="errors.has('address2')">{{ errors.first('address2') }}</span>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input name="city" v-validate="'required'"  type="text" class="form-control" v-model="church.city">
            <span v-show="errors.has('city')">{{ errors.first('city') }}</span>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input name="state" v-validate="'required'" type="text" class="form-control" v-model="church.state">
            <span v-show="errors.has('state')">{{ errors.first('state') }}</span>
        </div>

        <div class="form-group">
            <label for="zipcode">Zipcode</label>
            <input name="zipcode" v-validate="'required|numeric|max_value:99999'" type="text" class="form-control" v-model="church.zipcode">
            <span v-show="errors.has('zipcode')">{{ errors.first('zipcode') }}</span>
        </div>

        <div class="form-group">
            <label for="url">URL</label>
            <input name="url" v-validate="'url'" type="text" class="form-control" v-model="church.url">
            <span v-show="errors.has('url')">{{ errors.first('url') }}</span>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input name="phone" v-validate="'required|numeric'" type="text" class="form-control" v-model="church.phone">
            <span v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
        </div>
    </div>
</template>

<style>

</style>

<script>
    import bus from '../../../../bus.js'

    export default{
        props: ['church'],

        data(){
            return{

            }
        },

        methods: {
            onValidate() {
                this.$validator.validateAll();
                if (this.errors.errors.length == 0) {
                    bus.$emit('submit-church-response');
                }
            }
        },

        created() {
            bus.$on('validate', this.onValidate);
            this.$watch(() => this.errors.errors, (value) => {
                bus.$emit('errors-changed', value);
            });
        },

        beforeDestroy() {
            bus.$off('validate', this.onValidate);
        }
    }
</script>
