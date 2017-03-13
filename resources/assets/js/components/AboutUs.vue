<template>
    <section id="about">
        <div class="container content-md">
            <div class="headline">
                <h2>About CityServe</h2>
            </div>
            <p class="lead">CityServe is a partnership of several local churches to bless our local community. It's an opportunity for the church to be the church through practical acts of kindness. We're looking forward to completing more than 150 projects using 1500 volunteers during the weekend of May 20 and 21! All types of projects will be requested - painting, yard work, cleaning and organizing, baking, home repair/construction, visiting with folks, hosting events and more. Want to request a project?</p>
            <p class="lead">Please do so <router-link :to="{ name: 'request-project' }">here</router-link>! Want to serve? Please register for a project between April 1 and May 8. Volunteers can register as an individual or group.</p>

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
