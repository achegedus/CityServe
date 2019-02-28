<template>
    <section id="about">
        <div class="container content-md">
            <div class="headline">
                <h2>About CityServe</h2>
            </div>
            <p class="lead">CityServe is a partnership of several local churches to bless our local community. It's an opportunity for the church to be the church through practical acts of kindness. We're looking forward to completing more than 150 projects using 1500 volunteers on April 27 & 28! All types of projects will be requested - painting, yard work, cleaning and organizing, baking, home repair/construction, visiting with folks, hosting events and more. </p>
            <p class="lead">Want to request a project? Please do so <router-link :to="{ name: 'request-project' }">here</router-link>! Want to serve?</p>
            <!--<p class="lead">Please <router-link :to="{ name: 'serve' }">register to serve on a project between March 23 and April 15.</router-link> Volunteers can register as an individual or group.</p>-->
            <p class="lead">Registrations to serve on a project will open on March 23. Volunteers can register as an individual or group.</p>

        </div>
    </section>
</template>


<style>

</style>


<script>

    export default{
        data(){
            return{

            }
        },

    }
</script>
