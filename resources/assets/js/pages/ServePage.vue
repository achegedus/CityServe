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

            <p class="lead">Thank you for wanting to serve our community! Below, you'll find a list of all projects that are available for service projects.  Click the links to sign up to serve as an individual or as a leader of a group.</p>
            <p class="lead"><strong>To sign up for a project, you must register first, you can do that <a href="/register">here</a>.<br />If you have already registered, click <a href="/login">here</a> to Login.</strong></p>

            <div class="row">
                <div class="form-group col-md-4">
                    <label>Filter by category:</label>
                    <select class="form-control" v-model="selected_category" @change="getOpenProjects()">
                        <option value="all">All Categories</option>
                        <option v-for="cat in categories" :value="cat.id">{{cat.name}}</option>
                    </select>
                </div>
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
                this.axios.get('/api/projects/serving').then((response) => {
                    this.my_projects = response.data.data

                    this.axios.get('/api/open-projects?category=' + this.selected_category).then((response) => {
                        this.projects = response.data.data

                        this.projects = _.differenceWith(this.projects, this.my_projects, _.isEqual);

                        //this.projects = _.filter(this.projects, function(o) { if((o.volunteers_needed - o.volunteers) > 0) return o;});
                    })
                })
            },

            getCategories() {
                this.axios.get('/api/project-categories').then((response) => {
                    this.categories = response.data.data
                })
            },

            getMyProjects() {

            }
        },

        created: function() {
            this.getCategories();
            this.getOpenProjects();
        }
    }

</script>
