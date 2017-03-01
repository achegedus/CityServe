<template>
    <div class="col-sm-6 projectbox">
        <div class="funny-boxes funny-boxes-top-sea">
            <div class="row">
                <div class="col-md-4 funny-boxes-img">
                    <ul class="list-unstyled">
                        <li><i class="fa-fw fa fa-briefcase"></i> {{ project.category.name }}</li>
                        <li><i class="fa-fw fa fa-map-marker"></i> {{project.event_city}}</li>
                    </ul>
                </div>
                <div class="col-md-8">
                    <h2><a href="#">Oluptatum Box</a></h2>
                    <p>{{ project.description }}</p>


                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .projectbox {
        margin-top: 10px;
    }

    .funny-boxes {
        min-height: 300px;
    }
</style>

<script>
    export default{
        props: ['project'],

        data(){
            return{
                msg:'hello vue'
            }
        }
    }
</script>
