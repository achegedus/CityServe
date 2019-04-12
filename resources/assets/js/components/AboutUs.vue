<template>
    <section id="about">
        <div class="container content-md">
            <div class="headline">
                <h2>About CityServe</h2>
            </div>
            <p class="lead">CityServe is a partnership of several local churches to bless our local community. It's an opportunity for the church to be the church through practical acts of kindness. We're looking forward to completing more than 150 projects using 1500 volunteers on April 27 & 28! All types of projects will be requested - painting, yard work, cleaning and organizing, baking, home repair/construction, visiting with folks, hosting events and more. </p>
            <p class="lead">Most CityServe projects will take place at 11am on Saturday April 27. (Please note the start time on each individual project, as some of them are different.) Volunteers will gather at Calvary Harvest Fields for donuts, coffee, and prayer at 10am. Supplies will be passed out during the pre-project gathering.</p>
            <div style="text-align: center; margin: 40px;">
                <router-link :to="{ name: 'request-project'}" class="btn btn-u-lg btn-primary rounded-2x" style="width: 300px;">Request a project?</router-link>
                <a v-if="Date.now() < new Date('2019-03-30')" href="#" class="btn btn-u-lg btn-primary rounded-2x" style="width: 300px;" disabled>Volunteer to Serve (Opens 3/30)</a>
                <router-link v-if="Date.now() >= new Date('2019-03-30')" :to="{ name: 'serve'}" class="btn btn-u-lg btn-primary rounded-2x" style="width: 300px;">Volunteer to Serve</router-link>
            </div>
            <!--<p class="lead">Please <router-link :to="{ name: 'serve' }">register to serve on a project between March 23 and April 15.</router-link> Volunteers can register as an individual or group.</p>-->
            <p class="lead">Registrations to serve on a project will open on March 30. Volunteers can register as an individual or group.</p>

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
