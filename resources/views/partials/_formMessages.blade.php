@if(Session::has('error'))
    @php $error = Session::get('error'); @endphp
    <div class="alert alert-danger alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{__('messages.validation_failed')}}</strong>
        @if(isset($error['message']))
            <ul>
                <li>{{ $error['message'] }}</li>
            </ul>
        @endif
        @if(isset($error['summary']))
            <ul>
                @foreach($error['summary'] as $sm)
                    @if(is_array($sm) && isset($sm['message']))
                        <li>{{$sm['message']}}</li>
                    @else
                        <li>{{$sm}}</li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span>{{Session::get('success')['message']}}</span>
    </div>
@endif