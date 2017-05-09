<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        .page-break { page-break-after: always; }

        td { vertical-align: top }

        body { font-size: 10pt; }
    </style>
</head>
<body>

@foreach ($projects as $project)
    <table width="100%" cellpadding="2" cellspacing="0" border="1">
        <tr>
            <td width="33%"><b>PROJECT ID: {{$project->id}}</b></td>
            <td width="33%">TEAM LEADER: </td>
            <td width="33%"></td>
        </tr>
        <tr>
            <td>DAY: {{strtoupper($project->day)}}</td>
            <td>TIME: {{$project->time}}</td>
            <td>CATEGORY: {{$project->category_id}}</td>
        </tr>
        <tr>
            <td>SERVANTS REQUESTED: {{$project->numVolunteers}}</td>
            <td>SERVANTS REGISTERED: </td>
            <td></td>
        </tr>
        <tr>
            <td>EVALUATOR: </td>
            <td>EVALUATED: </td>
            <td>CONFIRMED: </td>
        </tr>
        <tr>
            <td>STREET: {{$project->event_address}}</td>
            <td>CITY: {{$project->event_city}}</td>
            <td>EVENT PHONE: {{$project->event_phone}}</td>
        </tr>
        <tr>
            <td>PROJECT DESCRIPTION:</td>
            <td colspan="2">{{$project->description}}</td>
        </tr>
        <tr>
            <td>HOW SERVANTS WILL BE USED: </td>
            <td colspan="2">{{$project->howUsed}}</td>
        </tr>
        <tr>
            <td>NOTES: </td>
            <td colspan="2">{{$project->notes}}</td>
        </tr>
        <tr>
            <td>EQUIPMENT PROVIDED BY REQUESTER: </td>
            <td colspan="2">{{$project->materialsRequesterWill}}</td>
        </tr>
        <tr>
            <td>EQUIPMENT NEEDED BY VOLUNTEERS: </td>
            <td colspan="2">{{$project->materialsRequesterCannot}}</td>
        </tr>
        <tr>
            <td>CITYSERVE-PROVIDED SUPPLIES: </td>
            <td colspan="2">{{$project->materialsCityServe}}</td>
        </tr>
        <tr>
            <td>DIRECTIONS: </td>
            <td colspan="2">{{$project->directions}}</td>
        </tr>
        <tr>
            <td>PARKING: </td>
            <td colspan="2">{{$project->parking}}</td>
        </tr>
        <tr>
            <td>CITYSERVE PLANNING TEAM PROJECT COORDINATOR: </td>
            <td colspan="2"></td>
        </tr>
    </table>

    <hr>



    <table width="100%">
        <tr>
            <th>SERVANT NAME</th>
            <th>PHONE</th>
            <th>EMAIL</th>
            <th># VOL</th>
            <th>MATERIALS</th>
            <th>CHURCH</th>
            <th>LEAD?</th>
        </tr>

        @foreach($project->users as $vol)
            <tr>
                <td>{{ $vol->first_name . " " . $vol->last_name }}</td>
                <td>{{ $vol->phone }}</td>
                <td>{{ $vol->email }}</td>
                <td>1</td>
                <td></td>
                <td>{{ $vol->church->name || "Other" }}</td>
                <td>{{ $vol->pivot->leader == 1? 'YES' : 'NO' }}</td>
            </tr>
        @endforeach

        @foreach($project->groups as $group)
            <tr>
                <td>{{ $group->user->first_name . " " . $group->user->last_name }}</td>
                <td>{{ $group->user->phone }}</td>
                <td>{{ $group->user->email }}</td>
                <td>{{ $group->pivot->number_of_volunteers }}</td>
                <td></td>
                <td>{{ $group->user->church->name }}</td>
                <td>{{ $group->pivot->leader == 1? 'YES' : 'NO' }}</td>
            </tr>
        @endforeach
    </table>

    <div class="page-break"></div>
@endforeach


</div>
</body>
</html>




