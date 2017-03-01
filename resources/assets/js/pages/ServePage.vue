<template>

    <div>
        <!--=== Slider ===-->
        <div class="interactive-slider-v2 img-v1">
            <div class="container">
                <h1>CityServe Projects</h1>
                <p>Serving beyond our walls</p>
            </div>
        </div>

        <div class="container content-md">

            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ornare magna neque, quis sodales ex luctus at. In feugiat finibus sem. Ut nisi est, cursus vitae risus non, sagittis auctor nisl. Aenean sit amet luctus ante. Phasellus pellentesque tempor libero nec rhoncus. Nam sed diam eget ante rhoncus volutpat vitae ac dui. Vestibulum massa velit, pretium pellentesque vestibulum et, pharetra at magna. Praesent sit amet arcu malesuada, malesuada dui et, fringilla neque. Integer sapien elit, gravida in malesuada consectetur, sagittis ac erat. Praesent vel vestibulum eros, ac interdum diam. Cras vitae massa neque. Duis dapibus auctor dui, eu pulvinar odio efficitur non. Sed quis nibh in risus gravida hendrerit.</p>

            <project-box v-for="project in projects" :project="project"></project-box>
        </div>
    </div>
</template>


<style>

</style>


<script>

    import ProjectBox from '../components/ProjectBox.vue'

    export default{
        data(){
            return{
                projects: []
            }
        },

        components:{
            ProjectBox
        },

        methods: {
            getOpenProjects() {
                this.axios.get('/api/open-projects').then((response) => {
                    this.projects = response.data.data
                })
            }
        },

        created: function() {
            this.getOpenProjects();
        }
    }

</script>
