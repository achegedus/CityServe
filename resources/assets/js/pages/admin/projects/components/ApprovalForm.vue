<template>
    <div>
        <h1>Administrative Review</h1>
        <div class="checkbox">
            <label>
                <input type="checkbox" v-model="project.evaluated">
                Project has been evaluated
            </label>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" v-model="project.approved">
                Project has been approved
            </label>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" v-model="project.assigned">
                Project has been assigned
            </label>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" v-model="project.volunteers_needed">
                Volunteers still needed
            </label>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.coordinator_id') }" >
            <label for="time">Coordinator</label>
            <select name="coordinator_id" class="form-control" v-validate data-vv-rules="required">
                <option>Select One</option>
            </select>
            <span v-show="errors.has('coordinator_id')">{{ errors.first('coordinator_id') }}</span>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" v-model="project.confirmed">
                Confirmed
            </label>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.evaluator_id') }" >
            <label for="time">Evaluated by</label>
            <select name="evaluator_id" class="form-control" v-validate data-vv-rules="required">
                <option>Select One</option>
            </select>
            <span v-show="errors.has('evaluator_id')">{{ errors.first('evaluator_id') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.category_id') }" >
            <label for="time">Category</label>
            <select name="category_id" class="form-control" v-validate data-vv-rules="required">
                <option>Select One</option>
            </select>
            <span v-show="errors.has('category_id')">{{ errors.first('category_id') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.notes') }" >
            <label for="notes">Notes</label>
            <textarea name="notes" type="text" class="form-control" v-model="project.notes"></textarea>
            <span v-show="errors.has('notes')">{{ errors.first('notes') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.short_description') }" >
            <label for="short_description">Short Description</label>
            <textarea name="short_description" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.short_description"></textarea>
            <span v-show="errors.has('short_description')">{{ errors.first('short_description') }}</span>
        </div>

    </div>
</template>

<style>

</style>

<script>
    import bus from '../../../../bus.js'

    export default{
        props: ['project'],

        data(){
            return{
                msg:'hello vue'
            }
        },

        methods: {
            onValidate() {
                this.$validator.validateAll();
                if (this.errors.errors.length == 0) {
                    bus.$emit('project_validate');
                }
            }
        },

        created() {
            bus.$on('approval_validate', this.onValidate);
            this.$watch(() => this.errors.errors, (value) => {
                bus.$emit('errors-changed', value);
            });
        },

        beforeDestroy() {
            bus.$off('approval_validate', this.onValidate);
        }
    }
</script>
