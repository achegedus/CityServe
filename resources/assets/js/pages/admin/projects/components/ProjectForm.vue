<template>
    <div>
        <h1>Requester Information</h1>
        <div class="form-group" :class="{'has-error': errors.has('project.organization_name') }" >
            <label for="organization_name">Organization Name</label>
            <input name="organization_name" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.organization_name">
            <span v-show="errors.has('organization_name')">{{ errors.first('organization_name') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.name') }" >
            <label for="name">Name</label>
            <input name="name" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.name">
            <span v-show="errors.has('name')">{{ errors.first('name') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.email') }" >
            <label for="email">Email</label>
            <input name="email" v-validate data-vv-rules="required|email"  type="text" class="form-control" v-model="project.email">
            <span v-show="errors.has('email')">{{ errors.first('email') }}</span>
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

        <div class="form-group">
            <label for="phone">Phone</label>
            <input name="phone" type="text" class="form-control" v-model="project.phone">
            <span v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.requester_church_id') }" >
            <label for="day">Church</label>
            <select name="day" class="form-control" v-validate data-vv-rules="required">
                <option>Select One</option>
            </select>
            <span v-show="errors.has('parking')">{{ errors.first('parking') }}</span>
        </div>

        <div class="form-group">
            <label for="other">Other</label>
            <input name="other" type="text" class="form-control" v-model="project.other">
            <span v-show="errors.has('other')">{{ errors.first('other') }}</span>
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
        <div class="form-group" :class="{'has-error': errors.has('project.address') }" >
            <label for="address">Address</label>
            <input name="address" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.address">
            <span v-show="errors.has('address')">{{ errors.first('address') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.secondary_address') }" >
            <label for="secondary_address">Address 2</label>
            <input name="secondary_address" v-validate data-vv-rules="" type="text" class="form-control" v-model="project.secondary_address">
            <span v-show="errors.has('secondary_address')">{{ errors.first('secondary_address') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.city') }" >
            <label for="city">City</label>
            <input name="city" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.city">
            <span v-show="errors.has('city')">{{ errors.first('city') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.state') }" >
            <label for="secondary_address">State</label>
            <input name="secondary_address" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.secondary_address">
            <span v-show="errors.has('secondary_address')">{{ errors.first('secondary_address') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.zipcode') }" >
            <label for="zipcode">Zipcode</label>
            <input name="zipcode" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.zipcode">
            <span v-show="errors.has('zipcode')">{{ errors.first('zipcode') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.phone') }" >
            <label for="phone">Phone Number</label>
            <input name="phone" v-validate data-vv-rules="required" type="text" class="form-control" v-model="project.phone">
            <span v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
        </div>

        <h1>Project Information</h1>
        <div class="form-group" :class="{'has-error': errors.has('project.description') }" >
            <label for="description">Description</label>
            <textarea name="description" type="text" class="form-control" v-model="project.description"></textarea>
            <span v-show="errors.has('description')">{{ errors.first('description') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.parking') }" >
            <label for="parking">Parking</label>
            <textarea name="parking" type="text" class="form-control" v-model="project.parking"></textarea>
            <span v-show="errors.has('parking')">{{ errors.first('parking') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.parking') }" >
            <label for="day">Day</label>
            <select name="day" class="form-control" v-validate data-vv-rules="required">
                <option>Select One</option>
                <option value="saturday">Saturday</option>
                <option value="sunday">Sunday</option>
            </select>
            <span v-show="errors.has('parking')">{{ errors.first('parking') }}</span>
        </div>

        <div class="form-group" :class="{'has-error': errors.has('project.time') }" >
            <label for="time">Time</label>
            <select name="time" class="form-control" v-validate data-vv-rules="required">
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
            <input name="numVolunteers" v-validate data-vv-rules="required|integer" type="text" class="form-control" v-model="project.numVolunteers">
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
    export default{
        props: ['project'],


        data(){
            return{

            }
        }
    }
</script>
