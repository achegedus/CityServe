<template>
    <div id="register">
        <!--=== Slider ===-->
        <div class="interactive-slider-v2 img-v3">
            <div class="container">
                <h1>Register to Serve</h1>
                <p>Serving beyond our walls</p>
            </div>
        </div>

        <div class="container" id="registerForm">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur deserunt iste soluta suscipit? Alias omnis vel voluptates! Labore neque qui quibusdam sed suscipit, velit voluptate! Eum obcaecati quo reprehenderit sed?</p>
            <form @submit.prevent="validateBeforeSubmit">
                <user-form :user="this.user"></user-form>

                <div class="form-group">
                    <button type="submit" class="btn btn-error">Create User</button>
                </div>
            </form>
        </div>
    </div>
</template>
<style>
    #registerForm {
        padding-top: 100px;
        padding-bottom: 50px
    }

    .img-v3 {
        background: url(/Community-Service.jpg) no-repeat;
    }
</style>
<script>

    import UserForm from '../pages/admin/users/components/UserForm.vue'

    export default{
        data(){
            return{
                user: {}
            }
        },
        components:{
            UserForm
        }
    }
</script>
