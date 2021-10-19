@component('mail::message')
# Twoje przypomnienia

Zbliżają się następujące zdarzenia:

@component('mail::table')
| Nazwa | Element (kategoria) | Data |
|:----  |:------------------  |---: |
@foreach($notifications as $event)
| {{$event->event->element->object_model->name}} | {{$event->event->element->name}} ({{$event->event->element->elements_typeable->name}}) | {{$event->event->expired_date}} |
@endforeach
@endcomponent

Pozdrawiamy,<br>
zespół TFM
@endcomponent
