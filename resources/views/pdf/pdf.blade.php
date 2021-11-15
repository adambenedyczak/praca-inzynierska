<!DOCTYPE html>
<html lang="PL">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dane {{ $object->name }}</title>
        <link rel="stylesheet" href="http://projekt0.server677647.nazwa.pl/css/app.css">
        <link rel="stylesheet" href="http://projekt0.server677647.nazwa.pl/css/bootstrap.min.css">
    </head>
    <body style="font-family: DejaVu Sans">   
        <em class="text-small" style="color: #e95420">Zestawienie wygenerowane przez aplikację {{ config('app.name') }}, dnia {{ date("d.m.Y", strtotime($currentDate)) }} </em> 
        <table style="width: 100%">
            <tr>
                <th style="width: 70%"><span style="font-size: 30px;">{{  $object->name }}</span></th>    
                <th><span class="text-muted" style="line-height: 15px; font-weight: light">Przebieg aktualny: <br/>{{ number_format($workTimeValue->value,0,""," ") }} {{ $object->work_time_unit->short }}</th></span> 
            </tr>  
        </table>
        <table style="width: 100%; border-bottom:double 3px #000;">
            <tr>
                <td>
                    <table>
                        @foreach ($details as $detail)
                        <tr>
                            <td>
                                {{ $detail->detail_typeable->name}}: 
                            </td>
                            <td>
                                {{ $detail->value}}
                            </td>
                        </tr>                                        
                        @endforeach
                    </table>
                </td>
                <td>
                    <table>
                        @foreach ($ownDetails as $detail)
                        <tr>
                            <td>
                                {{ $detail->own_name}}: 
                            </td>
                            <td>
                                {{ $detail->value}}
                            </div>
                        </tr>                                        
                        @endforeach
                    </table>
                </td>
                
            </tr>  
        </table> 
    @if($parts != null)
        <table style="width: 100%; border-bottom:double 3px #000;">
            <tr>
                <th style="width: 30%"><span style="font-size: 20px;">>> Części</span></th> 
                <th style="width: 40%"></th>   
                <th style="width: 30%">
                    @if($h == 1) Wykonane zdarzenia @endif</th> 
            </tr>        
        @foreach($parts as $item)                    
            <tr>
                <td style="width: 25%" class="align-top">{{ $item->name }}</td>
                <td style="width: 45%" class="align-top">
                    <table>
                        @foreach($item->detail_ownerable as $detail)
                        <tr>
                            <td>
                                {{ $detail->own_name}}: 
                            </td>
                            <td>
                                {{ $detail->value}}
                            </div>
                        </tr>                                        
                        @endforeach
                    </table>
                </td>
                <td style="width: 30%">
                    @if($h == 1)
                    <table>
                        @foreach($item->events as $event)
                        @if($event->done_date != NULL)
                        <tr>
                            <td>                                
                                {{ date("d-m-Y", strtotime($event->done_date)) }}                                 
                            </td>
                            <td>
                                @if($event->done_work_time_value != null)
                                    ({{ number_format($event->done_work_time_value,0,""," ") }} {{ $object->work_time_unit->short }})
                                @else
                                    --
                                @endif 
                            </div>
                        </tr>   
                        @endif                                     
                        @endforeach
                    </table>
                    @endif
                </td>
            </tr>            
        
        @endforeach
        </table>
    @endif

    @if($overviews != null)
    <table style="width: 100%; border-bottom:double 3px #000;">
            <tr>
                <th style="width: 30%"><span style="font-size: 20px;">>> Przeglądy</span></th> 
                <th style="width: 40%"></th>   
                <th style="width: 30%">
                    @if($h == 1) Wykonane zdarzenia @endif</th> 
            </tr>        
        @foreach($overviews as $item)                    
            <tr>
                <td style="width: 25%" class="align-top">{{ $item->name }}</td>
                <td style="width: 45%" class="align-top">
                    <table>
                        @foreach($item->detail_ownerable as $detail)
                        <tr>
                            <td>
                                {{ $detail->own_name}}: 
                            </td>
                            <td>
                                {{ $detail->value}}
                            </div>
                        </tr>                                        
                        @endforeach
                    </table>
                </td>
                <td style="width: 30%">
                    @if($h == 1)
                    <table>
                        @foreach($item->events as $event)
                        @if($event->done_date != NULL)
                        <tr>
                            <td>                                
                                {{ date("d-m-Y", strtotime($event->done_date)) }}                                 
                            </td>
                            <td>
                                @if($event->done_work_time_value != null)
                                    ({{ number_format($event->done_work_time_value,0,""," ") }} {{ $object->work_time_unit->short }})
                                @else
                                    --
                                @endif 
                            </div>
                        </tr>   
                        @endif                                     
                        @endforeach
                    </table>
                    @endif
                </td>
            </tr>            
        
        @endforeach
        </table>
    @endif

    @if($insurances != null)
        <table style="width: 100%; border-bottom:double 3px #000;">
            <tr>
                <th style="width: 30%"><span style="font-size: 20px;">>> Ubezpieczenia</span></th> 
                <th style="width: 40%"></th>   
                <th style="width: 30%">
                    @if($h == 1) Wykonane zdarzenia @endif</th> 
            </tr>        
        @foreach($insurances as $item)                    
            <tr>
                <td style="width: 25%" class="align-top">{{ $item->name }}</td>
                <td style="width: 45%" class="align-top">
                    <table>
                        @foreach($item->detail_ownerable as $detail)
                        <tr>
                            <td>
                                {{ $detail->own_name}}: 
                            </td>
                            <td>
                                {{ $detail->value}}
                            </div>
                        </tr>                                        
                        @endforeach
                    </table>
                </td>
                <td style="width: 30%">
                    @if($h == 1)
                    <table>
                        @foreach($item->events as $event)
                        @if($event->done_date != NULL)
                        <tr>
                            <td>                                
                                {{ date("d-m-Y", strtotime($event->done_date)) }}                                 
                            </td>
                            <td>
                                @if($event->done_work_time_value != null)
                                    ({{ number_format($event->done_work_time_value,0,""," ") }} {{ $object->work_time_unit->short }})
                                @else
                                    --
                                @endif 
                            </div>
                        </tr>   
                        @endif                                     
                        @endforeach
                    </table>
                    @endif
                </td>
            </tr>            
        
        @endforeach
        </table>
    @endif

    @if($h == 1 && count($workTimeHistory) > 0)
        <span style="font-size: 20px; font-weight: bold; ; border-bottom:double 3px #000;">>> Historia przebiegu</span>
        <table style="width: 100%">      
        @foreach($workTimeHistory as $item)                    
            <tr>
                <td style="width: 20%">{{ date("d-m-Y", strtotime($item->created_at)) }} </td>
                <td style="width: 45%">({{ number_format($item->value,0,""," ") }} {{ $object->work_time_unit->short }})</td>
            </tr>            
            
        @endforeach
        </table>
    @endif
        
  </body>
</html>