<template>
    <div class="container">
        <project-form :project="this.project"></project-form>
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
