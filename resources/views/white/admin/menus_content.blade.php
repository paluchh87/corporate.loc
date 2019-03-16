<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">{!! Lang::get('ru.menus_header') !!}</h3>
        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                <th>Name</th>
                <th>Link</th>
                <th>{!! Lang::get('ru.action') !!}</th>
                </thead>
                @if(isset($menus) && $menus)
                    @include(config('settings.theme').'.admin.custom-menu-items', array('items' => $menus->roots(),'paddingLeft' => ''))
                @endif
            </table>
        </div>
    </div>
</div>