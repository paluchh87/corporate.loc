<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">{!! Lang::get('ru.permissions') !!}</h3>
        <form action="{{ route('permissions.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="short-table white">
                <table style="width:100%">
                    <thead>
                    <th>{!! Lang::get('ru.permissions') !!}</th>
                    @if(isset($roles) && $roles)
                        @foreach($roles as $item)
                            <th>{{ $item->name}}</th>
                        @endforeach
                    @endif
                    </thead>
                    <tbody>
                    @if(isset($permissions) && $permissions)
                        @foreach($permissions as $val)
                            <tr>
                                <td>{{ $val->name }}</td>
                                @foreach($roles as $role)
                                    <td>
                                        @if($role->hasPermission($val->name))
                                            <input checked name="{{ $role->id }}[]" type="checkbox"
                                                   value="{{ $val->id }}">
                                        @else
                                            <input name=" {{ $role->id }}[]" type="checkbox" value="{{ $val->id }}">
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <input class="btn btn-the-salmon-dance-3" type="submit" value="{!! Lang::get('ru.update')!!}"/>
        </form>
    </div>
</div>