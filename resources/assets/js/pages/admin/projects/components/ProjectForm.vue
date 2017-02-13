<template>
    <div>
        <div class="form-group" :class="{'has-error': errors.has('church.name') }" >
            <label for="name">Church Name</label>
            <input name="name" v-validate data-vv-rules="required" type="text" class="form-control" v-model="church.name">
            <span v-show="errors.has('name')">{{ errors.first('name') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('church.address') }" >
            <label for="address">Address</label>
            <input name="address" v-validate data-vv-rules="required"  type="text" class="form-control" v-model="church.address">
            <span v-show="errors.has('address')">{{ errors.first('address') }}</span>
        </div>

        <div class="form-group">
            <label for="address2">Secondary Address</label>
            <input name="address2" type="text" class="form-control" v-model="church.address2">
            <span v-show="errors.has('address2')">{{ errors.first('address2') }}</span>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input name="city" v-validate data-vv-rules="required"  type="text" class="form-control" v-model="church.city">
            <span v-show="errors.has('city')">{{ errors.first('city') }}</span>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input name="state" v-validate data-vv-rules="required" type="text" class="form-control" v-model="church.state">
            <span v-show="errors.has('state')">{{ errors.first('state') }}</span>
        </div>

        <div class="form-group">
            <label for="zipcode">Zipcode</label>
            <input name="zipcode" v-validate data-vv-rules="required" type="text" class="form-control" v-model="church.zipcode">
            <span v-show="errors.has('zipcode')">{{ errors.first('zipcode') }}</span>
        </div>

        <div class="form-group">
            <label for="url">URL</label>
            <input name="url" v-validate data-vv-rules="required" type="text" class="form-control" v-model="church.url">
            <span v-show="errors.has('url')">{{ errors.first('url') }}</span>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input name="phone" type="text" class="form-control" v-model="church.phone">
        </div>
    </div>
</template>

<style>

</style>

<script>
    export default{
        props: ['church'],


        data(){
            return{

            }
        }
    }
</script>
