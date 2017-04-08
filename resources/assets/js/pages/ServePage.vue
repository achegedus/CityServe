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

                <div class="form-group">
                    <label>Filter by category:</label>
                    <select class="form-control" v-model="selected_category" @change="getOpenProjects()">
                        <option value="all">All Categories</option>
                        <option v-for="cat in categories" :value="cat.id">{{cat.name}}</option>
                    </select>
                </div>

            <div v-masonry transition-duration="0.3s" item-selector=".grid-item">
                <project-box v-masonry-tile class="grid-item" v-for="project in my_projects" :project="project" :assigned="true"></project-box>
                <project-box v-masonry-tile class="grid-item" v-for="project in projects" :project="project" :assigned="false"></project-box>
            </div>
        </div>


    </div>
</template>


<style>
    .grid-item {
       width: 50%;
       padding: 10px;
       margin: 0;
    }
</style>


<script>

    import ProjectBox from '../components/ProjectBox.vue'
    //import { mapState } from 'vuex'

    export default{
        data(){
            return{
                projects: [],
                categories: [],
                selected_category: 'all',
                my_projects: []
            }
        },

        components:{
            ProjectBox
        },

        computed: {
            userStore() {
                return this.$store.getters.authUser
            }
        },

        methods: {
            getOpenProjects() {
                this.axios.get('/api/open-projects?category=' + this.selected_category).then((response) => {
                    this.projects = response.data.data
                })
            },

            getCategories() {
                this.axios.get('/api/project-categories').then((response) => {
                    this.categories = response.data.data
                })
            },

            getMyProjects() {
                this.axios.get('/api/projects/serving').then((response) => {
                    this.my_projects = response.data.data
                })
            }
        },

        created: function() {
            this.getOpenProjects();
            this.getCategories();
            this.getMyProjects();
        }
    }

</script>
