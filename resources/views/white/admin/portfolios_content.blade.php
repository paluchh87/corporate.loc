<div id="content-page" class="content group">
    <div class="hentry group">
        @if(isset($portfolios) && $portfolios)
            <h2>{!! Lang::get('ru.portfolios_header') !!}</h2>
            <div class="short-table white">
                <table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="align-left">ID</th>
                        <th>{!! Lang::get('ru.title') !!}</th>
                        <th>{!! Lang::get('ru.text') !!}</th>
                        <th>{!! Lang::get('ru.image') !!}</th>
                        <th>{!! Lang::get('ru.alias') !!}</th>
                        <th>{!! Lang::get('ru.action') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($portfolios as $portfolio)
                        <tr>
                            <td class="align-left">{{$portfolio->id}}</td>
                            <td class="align-left">{!! Html::link(route('portfoliosEdit',['portfolios'=>$portfolio->alias]),$portfolio->title) !!}</td>
                            <td class="align-left">{!! str_limit($portfolio->text,200) !!}</td>
                            <td>
                                @if(isset($portfolio->img->mini))
                                    {!! Html::image(asset(config('settings.theme')).'/images/portfolios/'.$portfolio->img->mini) !!}
                                @endif
                            </td>
                            <td>{{$portfolio->alias}}</td>
                            <td>
                                {!! Form::open(['url' => route('portfoliosDestroy',['portfolios'=>$portfolio->alias]),'class'=>'form-horizontal','method'=>'POST']) !!}
                                {{ method_field('DELETE') }}
                                {!! Form::button(Lang::get('ru.delete'), ['class' => 'btn btn-french-5','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {!! Html::link(route('portfoliosCreate'),Lang::get('ru.add_portfolio'),['class' => 'btn btn-the-salmon-dance-3']) !!}
    </div>
    <!-- START COMMENTS -->
    <div id="comments">
    </div>
    <!-- END COMMENTS -->
</div>
