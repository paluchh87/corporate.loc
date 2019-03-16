<div id="content-page" class="content group">
    <div class="hentry group">
        @if(isset($articles) && $articles)
            <h2>{!! Lang::get('ru.articles_header') !!}</h2>
            <div class="short-table white">
                <table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="align-left">ID</th>
                        <th>{!! Lang::get('ru.title') !!}</th>
                        <th>{!! Lang::get('ru.text') !!}</th>
                        <th>{!! Lang::get('ru.image') !!}</th>
                        <th>{!! Lang::get('ru.category') !!}</th>
                        <th>{!! Lang::get('ru.alias') !!}</th>
                        <th>{!! Lang::get('ru.action') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td class="align-left">{{$article->id}}</td>
                            <td class="align-left">{!! Html::link(route('articlesEdit',['articles'=>$article->alias]),$article->title) !!}</td>
                            <td class="align-left">{!! str_limit($article->text,200) !!}</td>
                            <td>
                                @if(isset($article->img->mini))
                                    {!! Html::image(asset(config('settings.theme')).'/images/articles/'.$article->img->mini) !!}
                                @endif
                            </td>
                            <td>{{$article->category->title}}</td>
                            <td>{{$article->alias}}</td>
                            <td>
                                {!! Form::open(['url' => route('articlesDestroy',['articles'=>$article->alias]),'class'=>'form-horizontal','method'=>'POST']) !!}
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
        {!! Html::link(route('articlesCreate'),Lang::get('ru.add_article'),['class' => 'btn btn-the-salmon-dance-3']) !!}
    </div>
    <!-- START COMMENTS -->
    <div id="comments">
    </div>
    <!-- END COMMENTS -->
</div>