<div>
    @if($count_events > 0)
    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white btn" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
        </svg>
        @if($count_events > 0)
        <span class="badge badge-light">
            {{ $count_events}}
        </span>
        @endif
    </a>

    <div class="dropdown-menu" style="right: -100px !important; left: -80px !important;" aria-labelledby="navbarDropdown">
        @if($count_events > 0)
        <h6 class="dropdown-header">Nadchodzące zdarzenia</h6>
        @foreach ($events as $event)
            @if(!$loop->first)
                <div class="dropdown-divider py-0 my-1"></div>
            @endif

            @if($event->element->object_model->object_type_id == 1)
                <a class="dropdown-item" href="{{ route('vehicles.show', $event->element->object_model->id)}}" >
            @elseif($event->element->object_model->object_type_id == 2)
                <a class="dropdown-item" href="{{ route('trailers.show', $event->element->object_model->id)}}" >
            @elseif($event->element->object_model->object_type_id == 3)
                <a class="dropdown-item" href="{{ route('machines.show', $event->element->object_model->id)}}" >
            @endif
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                    </svg>
                    {{$event->element->object_model->name}} | {{$event->element->name}}
                </div>
                <div class=" text-muted">
                ({{$event->element->elements_typeable->name}})
                </div>
                <div>
                    <span class="text-primary">
                        {{date("d-m-Y", strtotime($event->expired_date))}}
                    </span> 
                </div>
            </a>
        @endforeach
        @else
        <h5 class="dropdown-header">Nie masz nadchodzących zdarzeń</h5>
        @endif
    </div>
    @endif
</div>
