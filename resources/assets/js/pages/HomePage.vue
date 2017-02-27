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

    export default{
        data(){
            return{
                msg:'hello vue'
            }
        },

        components: {
            'about-us': AboutUs,
            'churches': Churches,
            'faq' : FAQ,
            'testimonials' : Testimonials,
            'gallery' : Gallery
        }
    }
</script>
