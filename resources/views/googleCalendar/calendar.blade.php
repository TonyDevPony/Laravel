<form action="{{route('createEvent')}}" method="GET">
    <button type="submit">
        Create event
    </button>
</form>
@dd($events)
@foreach($events as $key => $events)
    <div>
        {{$events->googleEvent->creator->email}}
    </div>

@endforeach
