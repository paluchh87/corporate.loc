@foreach($items as $item)
    <tr>
        <td style="text-align: left;">{{ $paddingLeft }} {!! $item->title !!}</td>
        <td>{{ $item->url() }}</td>
        <td>
            {!! Form::open(['url' => route('menus.destroy',['menus'=> $item->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
            {{ method_field('DELETE') }}
            {!! Form::button(Lang::get('ru.delete'), ['class' => 'btn btn-french-5','type'=>'submit']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @if($item->hasChildren())
        @include(config('settings.theme').'.admin.custom-menu-items', array('items' => $item->children(),'paddingLeft' => $paddingLeft.'--'))
    @endif
@endforeach