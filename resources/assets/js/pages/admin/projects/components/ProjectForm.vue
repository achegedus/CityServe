<template>
    <div>
        <h1>Requester Information</h1>
        <div class="form-group" :class="{'has-error': errors.has('project.requester_org_name') }" >
            <label for="requester_org_name">Organization Name</label>
            <input name="requester_org_name" v-validate data-vv-rules="required" data-vv-as="Requester Organization Name" type="text" class="form-control" v-model="project.requester_org_name">
            <span v-show="errors.has('requester_org_name')">{{ errors.first('requester_org_name') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.requester_contact_name') }" >
            <label for="requester_contact_name">Name</label>
            <input name="requester_contact_name" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.requester_contact_name">
            <span v-show="errors.has('requester_contact_name')">{{ errors.first('requester_contact_name') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.requester_email') }" >
            <label for="requester_email">Email</label>
            <input name="requester_email" v-validate data-vv-rules="required|email" data-vv-as="Requester Email" type="text" class="form-control" v-model="project.requester_email">
            <span v-show="errors.has('requester_email')">{{ errors.first('requester_email') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.requester_address') }" >
            <label for="requester_address">Address</label>
            <input name="requester_address" v-validate data-vv-rules="required"  type="text" class="form-control" v-model="project.requester_address">
            <span v-show="errors.has('requester_address')">{{ errors.first('requester_address') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.requester_city') }" >
            <label for="requester_city">City</label>
            <input name="requester_city" v-validate data-vv-rules="required"  type="text" class="form-control" v-model="project.requester_city">
            <span v-show="errors.has('requester_city')">{{ errors.first('requester_city') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.requester_state') }" >
            <label for="requester_state">State</label>
            <input name="requester_state" v-validate data-vv-rules="required"  type="text" class="form-control" v-model="project.requester_state">
            <span v-show="errors.has('requester_state')">{{ errors.first('requester_state') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.requester_zipcode') }" >
            <label for="requester_zipcode">Zipcode</label>
            <input name="requester_zipcode" v-validate data-vv-rules="required"  type="text" class="form-control" v-model="project.requester_zipcode">
            <span v-show="errors.has('requester_zipcode')">{{ errors.first('requester_zipcode') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.requester_phone') }" >
            <label for="requester_phone">Phone</label>
            <input name="requester_phone" type="text" class="form-control" v-model="project.requester_phone">
            <span v-show="errors.has('requester_phone')">{{ errors.first('requester_phone') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.requester_church') }" >
            <label for="requester_church">Church</label>
            <input name="requester_church" type="text" class="form-control" data-vv-as="Requester Church" v-model="project.requester_church">
            <span v-show="errors.has('requester_church')">{{ errors.first('requester_church') }}</span>
        </div>


        <h1>Event Point of Contact</h1>

        <div class="form-group" :class="{'has-error': errors.has('project.event_contact_name') }" >
            <label for="event_contact_name">Event Contact Name</label>
            <input name="event_contact_name" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.event_contact_name">
            <span v-show="errors.has('event_contact_name')">{{ errors.first('event_contact_name') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.event_contact_phone') }" >
            <label for="event_contact_phone">Event Contact Phone Number</label>
            <input name="event_contact_phone" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.event_contact_phone">
            <span v-show="errors.has('event_contact_phone')">{{ errors.first('event_contact_phone') }}</span>
        </div>

        <h1>Project Location</h1>
        <div class="form-group" :class="{'has-error': errors.has('project.event_address') }" >
            <label for="event_address">Address</label>
            <input name="event_address" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.event_address">
            <span v-show="errors.has('event_address')">{{ errors.first('event_address') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.event_secondary_address') }" >
            <label for="event_secondary_address">Address 2</label>
            <input name="event_secondary_address" type="text" class="form-control" v-model="project.event_secondary_address">
            <span v-show="errors.has('event_secondary_address')">{{ errors.first('event_secondary_address') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.event_city') }" >
            <label for="event_city">City</label>
            <input name="event_city" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.event_city">
            <span v-show="errors.has('event_city')">{{ errors.first('event_city') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.event_state') }" >
            <label for="event_state">State</label>
            <input name="event_state" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.event_state">
            <span v-show="errors.has('event_state')">{{ errors.first('event_state') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.event_zipcode') }" >
            <label for="event_zipcode">Zipcode</label>
            <input name="event_zipcode" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.event_zipcode">
            <span v-show="errors.has('event_zipcode')">{{ errors.first('event_zipcode') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.event_phone') }" >
            <label for="event_phone">Phone Number</label>
            <input name="event_phone" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.event_phone">
            <span v-show="errors.has('event_phone')">{{ errors.first('event_phone') }}</span>
        </div>


        <h1>Project Information</h1>

        <div class="form-group" :class="{'has-error': errors.has('project.description') }" >
            <label for="description">Description</label>
            <textarea name="description" type="text" class="form-control" v-model="project.description"></textarea>
            <span v-show="errors.has('description')">{{ errors.first('description') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.directions') }" >
            <label for="directions">Directions</label>
            <textarea name="directions" type="text" class="form-control" v-model="project.directions"></textarea>
            <span v-show="errors.has('directions')">{{ errors.first('directions') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.parking') }" >
            <label for="parking">Parking</label>
            <textarea name="parking" type="text" class="form-control" v-model="project.parking"></textarea>
            <span v-show="errors.has('parking')">{{ errors.first('parking') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.day') }" >
            <label for="day">Day</label>
            <select name="day" class="form-control" v-validate data-vv-rules="required" v-model="project.day">
                <option>Select One</option>
                <option value="saturday">Saturday</option>
                <option value="sunday">Sunday</option>
            </select>
            <span v-show="errors.has('day')">{{ errors.first('day') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.time') }" >
            <label for="time">Time</label>
            <select name="time" class="form-control" v-validate data-vv-rules="required" v-model="project.time">
                <option>Select One</option>
                <option value="7">7 AM</option>
                <option value="8">8 AM</option>
                <option value="9">9 AM</option>
                <option value="10">10 AM</option>
                <option value="11">11 AM</option>
                <option value="12">12 AM</option>
                <option value="13">1 PM</option>
                <option value="14">2 PM</option>
                <option value="15">3 PM</option>
                <option value="16">4 PM</option>
                <option value="17">5 PM</option>
                <option value="18">6 PM</option>
            </select>
            <span v-show="errors.has('time')">{{ errors.first('time') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.numVolunteers') }" >
            <label for="numVolunteers">Number of Volunteers Needed</label>
            <input name="numVolunteers" v-validate data-vv-rules="required|numeric" type="text" class="form-control" v-model="project.numVolunteers">
            <span v-show="errors.has('numVolunteers')">{{ errors.first('numVolunteers') }}</span>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" v-model="project.family">
                Project is appropriate for families with children
            </label>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.howUsed') }" >
            <label for="howUsed">How Will Volunteers be Used</label>
            <textarea name="howUsed" type="text" class="form-control" v-model="project.howUsed"></textarea>
            <span v-show="errors.has('howUsed')">{{ errors.first('howUsed') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.skills') }" >
            <label for="skills">Skills Requested</label>
            <textarea name="skills" type="text" class="form-control" v-model="project.skills"></textarea>
            <span v-show="errors.has('skills')">{{ errors.first('skills') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.materialsRequesterWill') }" >
            <label for="materialsRequesterWill">Materials Requester Will Provide </label>
            <textarea name="materialsRequesterWill" type="text" class="form-control" v-model="project.materialsRequesterWill"></textarea>
            <span v-show="errors.has('materialsRequesterWill')">{{ errors.first('materialsRequesterWill') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.materialsRequesterCannot') }" >
            <label for="materialsRequesterCannot">Materials Requester Will Not Provide </label>
            <textarea name="materialsRequesterCannot" type="text" class="form-control" v-model="project.materialsRequesterCannot"></textarea>
            <span v-show="errors.has('materialsRequesterCannot')">{{ errors.first('materialsRequesterCannot') }}</span>
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

            }
        },

        methods: {
            onValidate() {
                this.$validator.validateAll();
                if (this.errors.errors.length == 0) {
                    bus.$emit('submit-project-response');
                }
            }
        },

        created() {
            bus.$on('project_validate', this.onValidate);
            this.$watch(() => this.errors.errors, (value) => {
                bus.$emit('errors-changed', value);
            });
        },

        beforeDestroy() {
            bus.$off('project_validate', this.onValidate);
        }
    }
</script>
