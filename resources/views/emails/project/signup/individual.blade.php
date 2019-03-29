@component('mail::message')
# Introduction

Thank you for registering for a project. Your registration summary is listed below for your records. If anything is incorrect please contact us immediately. You may reply to this e-mail.

*   Project Registered: {{ $project->id }}
*   Name: {{ $server->name }}
*   Phone: {{ $server->phone }}

Your project leader will contact you with further details regarding the project once it gets closer to the CityServe weekend.


Thanks,<br>
CityServe Coordinators
@endcomponent
