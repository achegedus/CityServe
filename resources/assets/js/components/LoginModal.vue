<template>
    <div class="user-modal-container" :class="{ 'active': active }" id="login-modal" @click="close">
        <div class="user-modal">
            <ul class="form-switcher">
                <li @click="active = 'register'"><a href="#" id="register-form">Register</a></li>
                <li @click="active = 'login'"><a href="#" id="login-form">Login</a></li>
            </ul>
            <div class="form-register" :class="{ 'active': active == 'register' }" id="form-register">
                <p>Register or <a href="#" @click="active = 'login'">Login</a> to register to serve.</p>
                <div class="error-message" v-text="registerError"></div>
                <input type="text" name="name" placeholder="Name" v-model="registerName">
                <input type="email" name="email" placeholder="Email" v-model="registerEmail">
                <input type="text" name="address" placeholder="Address" v-model="registerAddress">
                <input type="text" name="city" placeholder="City" v-model="registerCity">
                <input type="text" name="state" placeholder="State" v-model="registerState">
                <input type="text" name="zipcode" placeholder="Zipcode" v-model="registerZipcode">
                <input type="text" name="phone" placeholder="phone" v-model="registerPhone">
                <input type="password" name="password" placeholder="Password" v-model="registerPassword">
                <input type="submit" :class="{ 'disabled': submitted == 'register' }" @click="submit('register', $event)" id="registerSubmit" value="Register">
                <div class="links"> <a href="" @click.prevent="active = 'login'">Already have an account?</a>

                </div>
            </div>
            <div class="form-login" :class="{ 'active': active == 'login' }" id="form-login">
                <form ref="loginform" role="form" method="POST" action="/login">
                    <div class="error-message" v-text="loginError"></div>
                    <input type="hidden" name="_token" :value="csrfToken">
                    <input type="text" name="email" placeholder="Email or Username" v-model="loginUser" >
                    <input type="password" name="password" placeholder="Password" v-model="loginPassword" >
                    <input type="submit" id="loginSubmit" value="Login" @click="submitLogin">
                </form>
                <div class="links">
                    <a href="" @click.prevent="active = 'password'">Forgot your password?</a>
                </div>
            </div>
            <div class="form-password" :class="{ 'active': active == 'password' }" id="form-password">
                <div class="error-message" v-text="passwordError"></div>
                <input type="text" name="email" placeholder="Email" v-model="passwordEmail" @keyup.enter="submit('password', $event)">
                <input type="submit" :class="{ 'disabled': submitted == 'password' }" @click="submit('password', $event)"  id="passwordSubmit" value="Reset Password">
            </div>
        </div>
    </div>
</template>

<style>
    .user-modal-container * {
        box-sizing: border-box;
    }

    .user-modal-container {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        visibility: hidden;
        cursor: pointer;
        overflow-y: auto;
        z-index: 3;
        font-family: 'Lato', 'Helvetica Neue', 'Helvetica', 'Arial', 'sans-serif';
        font-size: 14px;
        background-color: rgba(17, 17, 17, .9);
        -webkit-transition: all 0.25s linear;
        -moz-transition: all 0.25s linear;
        -o-transition: all 0.25s linear;
        -ms-transition: all 0.25s linear;
        transition: all 0.25s linear;
    }

    .user-modal-container.active {
        opacity: 1;
        visibility: visible;
    }

    .user-modal-container .user-modal {
        position: relative;
        margin: 150px auto;
        width: 90%;
        max-width: 500px;
        background-color: #f6f6f6;
        cursor: initial;
    }

    .user-modal-container .form-login,
    .user-modal-container .form-register,
    .user-modal-container .form-password {
        padding: 75px 25px 25px;
        display: none;
    }

    .user-modal-container .form-login.active,
    .user-modal-container .form-register.active,
    .user-modal-container .form-password.active {
        display: block;
    }

    .user-modal-container ul.form-switcher {
        margin: 0;
        padding: 0;
    }

    .user-modal-container ul.form-switcher li {
        list-style: none;
        display: inline-block;
        width: 50%;
        float: left;
        margin: 0;
    }

    .user-modal-container ul.form-switcher li a {
        width: 100%;
        display: block;
        height: 50px;
        line-height: 50px;
        color: #666666;
        background-color: #dddddd;
        text-align: center;
    }

    .user-modal-container ul.form-switcher li a.active {
        color: #000000;
        background-color: #f6f6f6;
    }

    .user-modal-container input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #eeeeee;
    }

    .user-modal-container input[type="submit"] {
        color: #f6f6f6;
        border: 0;
        margin-bottom: 0;
        background-color: #e67e22;
        cursor: pointer;
    }

    .user-modal-container input[type="submit"]:hover {
        background-color: #BF5B00;
    }

    .user-modal-container input[type="submit"]:active {
        background-color: #e67e22;
    }

    .user-modal-container .links {
        text-align: center;
        padding-top: 25px;
    }

    .user-modal-container .links a {
    }

    .user-modal-container input[type="submit"].disabled {
        background-color: #98d6b7;
    }
</style>

<script>
    import bus from '../bus.js'
    export default{
        props: ['initialActive'],

        data(){
            return{
                active: this.initialActive,
                // Modal text fields
                registerName: '',
                registerEmail: '',
                registerPassword: '',
                registerAddress: '',
                registerCity: '',
                registerState: '',
                registerZipcode: '',
                registerPhone: '',
                loginUser: '',
                loginPassword: '',
                passwordEmail: '',
                csrfToken: window.Laravel.csrfToken,

                registerError: '',
                submitted: '',
                loginError: '',
                passwordError: '',
            }
        },

        watch: {
            initialActive: function(val) {
                this.active = this.initialActive
            }
        },

        methods: {
            close: function(e) {
                e.preventDefault();
                if (e.target === this.$el) {
                    bus.$emit('close-modal')
                }
            },

            submitLogin: function(e) {
                console.log(e);
                this.$refs.loginform.submit()
            }
        },

        components:{

        }
    }
</script>
