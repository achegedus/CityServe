@component('mail::message')
# Your project has been submitted!

Thank you for submitting a project for CityServe 2016. Your project request summary is listed below for your records. If anything is incorrect please contact us immediately. You will be hearing from us soon to schedule a time to evaluate your project or to confirm that a team of volunteers will be there. If you have any questions prior to hearing from us, please contact us at [info@sc-cityserve.org](mailto:info@sc-cityserve.org) or 814.238.0822 ext. 20.

*   Project ID: {{ $project->requester_org_name }}
*   Organization:
*   Contact Name:
*   Address:
*   City:
*   State:
*   Zipcode:
*   Phone:
*   Church:

###Event Point of Contact
*   Name:
*   Phone:

###Project Location
*   Address:
*   City:
*   State:
*   Zipcode:
*   Phone:
*   Directions to project site:
*   Parking Information:

###Project Information
*   Description:
*   Preferred Day:
*   Preferred Time to Start:
*   Number of Volunteers Needed:
*   How will volunteers be used:
*   List any special skills:
*   Materials requester WILL provide:
*   Materials request UNABLE to provide:

Thank you,

CityServe Coordinators
@endcomponent
