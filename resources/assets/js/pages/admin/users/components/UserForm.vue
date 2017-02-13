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

        <div class="form-group">
            <label for="church">Church</label>
            <input name="church" type="text" class="form-control" v-model="user.church_id">
            <span v-show="errors.has('church_id')">{{ errors.first('church_id') }}</span>
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

            }
        }
    }
</script>
