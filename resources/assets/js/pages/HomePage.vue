<template>
    <div>
        <!--=== Slider ===-->
        <div class="interactive-slider-v2 img-v1">
            <div class="container">
                <h1>Welcome to CityServe</h1>
                <p>Serving beyond our walls</p>
            </div>
        </div>
        <!--=== End Slider ===-->

        <!--=== Content ===-->
        <about-us></about-us>

        <gallery></gallery>

        <testimonials></testimonials>

        <faq></faq>

        <churches></churches>
        <!--=== End Content ===-->
    </div>
</template>


<style>
    .bg-image-v2 {
        background: url(/Community-Service.jpg) repeat fixed;
    }
</style>


<script>
    import AboutUs from '../components/AboutUs.vue'
    import Churches from '../components/Churches.vue'
    import FAQ from '../components/FAQ.vue'
    import Testimonials from '../components/Testimonials.vue'
    import Gallery from '../components/Gallery.vue'

    import { mapState } from 'vuex'

    export default{
        data(){
            return{
                msg:'hello vue'
            }
        },

        computed: {
            ...mapState({
                userStore: state => state.userStore
            })
        },

        components: {
            'about-us': AboutUs,
            'churches': Churches,
            'faq' : FAQ,
            'testimonials' : Testimonials,
            'gallery' : Gallery
        },

        mounted: function() {
            this.axios.get('/api/user').then((response) => {
                const authUser = {}
                authUser.email = response.data.email
                authUser.name = response.data.name
                authUser.isSuperAdmin = response.data.isSuperAdmin
                authUser.isReviewer = response.data.isReviewer
                authUser.isChurchPrimary = response.data.isChurchPrimary
                authUser.phone = response.data.phone
                authUser.church_id = response.data.church_id
                authUser.access_token = 'laravel_token'

                window.localStorage.setItem('authUser', JSON.stringify(authUser));

                // dispatch set user object vuex
                this.$store.dispatch('setUserObject', authUser)

                // redirect
                this.$router.push({name: 'home-page'})
            })
        }
    }
</script>
