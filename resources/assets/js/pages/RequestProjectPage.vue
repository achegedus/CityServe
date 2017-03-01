<template>
    <div>
    <!--=== Slider ===-->
    <div class="interactive-slider-v2 img-v1">
        <div class="container">
            <h1>Request a Project</h1>
            <p>Serving beyond our walls</p>
        </div>
    </div>

    <div class="container">
        <project-form :project="this.project"></project-form>
    </div>
    </div>
</template>


<style>

</style>


<script>

    import ProjectForm from './admin/projects/components/ProjectForm.vue'

    export default{
        data(){
            return{
                project: {}
            }
        },

        components:{
            ProjectForm
        }
    }

</script>
