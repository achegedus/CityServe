@component('mail::message')
# Your project has been submitted!

Thank you for submitting a project for CityServe 2017. Your project request summary is listed below for your records. If anything is incorrect please contact us immediately. You will be hearing from us soon to schedule a time to evaluate your project or to confirm that a team of volunteers will be there. If you have any questions prior to hearing from us, please contact us at [info@sc-cityserve.org](mailto:info@sc-cityserve.org) or 814.238.0822 ext. 20.

*   Project ID: {{ $project->id }}
*   Organization: {{ $project->requester_org_name }}
*   Contact Name: {{ $project->requester_contact_name }}
*   Address: {{ $project->requester_address }}
*   City: {{ $project->requester_city }}
*   State: {{ $project->requester_state }}
*   Zipcode: {{ $project->requester_zipcode }}
*   Phone: {{ $project->requester_phone }}
*   Email: {{ $project->requester_email }}
*   Church: {{ $project->requester_church }}

###Event Point of Contact
*   Name: {{ $project->event_contact_name }}
*   Phone: {{ $project->event_contact_phone }}

###Project Location
*   Address: {{ $project->event_address }}
*   City: {{ $project->event_city }}
*   State: {{ $project->event_state }}
*   Zipcode: {{ $project->event_zipcode }}
*   Phone: {{ $project->event_phone }}
*   Directions to project site: {{ $project->directions }}
*   Parking Information: {{ $project->parking }}

###Project Information
*   Description: {{ $project->description }}
*   Preferred Day: {{ $project->day }}
*   Preferred Time to Start: {{ $project->time }}
*   Number of Volunteers Needed: {{ $project->numVolunteers }}
*   Family friendly: {{ $project->family }}
*   How will volunteers be used: {{ $project->howUsed }}
*   List any special skills: {{ $project->skills }}
*   Materials requester WILL provide: {{ $project->materialsRequesterWill }}
*   Materials request UNABLE to provide: {{ $project->materialsRequesterCannot }}

Thank you,

CityServe Coordinators
@endcomponent
