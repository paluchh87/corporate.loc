<div id="content-page" class="content group">
    <div class="hentry group">
        @if(isset($article) || (Route::currentRouteName() ==  'articlesCreate'))
            {!! Form::open(['url' => (isset($article->id)) ? route('articlesUpdate',['articles'=>$article->alias]) : route('articlesStore'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
            <ul>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">{!! Lang::get('ru.title') !!}:</span>
                        <br/>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        {!! Form::text('title',isset($article->title) ? $article->title  : old('title'), ['placeholder'=>'']) !!}
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">{!! Lang::get('ru.keywords') !!}:</span>
                        <br/>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        {!! Form::text('keywords', isset($article->keywords) ? $article->keywords  : old('keywords'), ['placeholder'=>'']) !!}
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">{!! Lang::get('ru.meta_description') !!}:</span>
                        <br/>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        {!! Form::text('meta_desc', isset($article->meta_desc) ? $article->meta_desc  : old('meta_desc'), ['placeholder'=>'']) !!}
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">{!! Lang::get('ru.alias') !!}:</span>
                        <br/>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        {!! Form::text('alias', isset($article->alias) ? $article->alias  : old('alias'), ['placeholder'=>'']) !!}
                    </div>
                </li>
                <li class="textarea-field">
                    <label for="message-contact-us">
                        <span class="label">{!! Lang::get('ru.small_description') !!}:</span>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
                        {!! Form::textarea('desc', isset($article->desc) ? $article->desc  : old('desc'), ['id'=>'editor','class' => 'form-control','placeholder'=>'']) !!}
                    </div>
                    <div class="msg-error"></div>
                </li>
                <li class="textarea-field">
                    <label for="message-contact-us">
                        <span class="label">{!! Lang::get('ru.description') !!}:</span>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
                        {!! Form::textarea('text', isset($article->text) ? $article->text  : old('text'), ['id'=>'editor2','class' => 'form-control','placeholder'=>'']) !!}
                    </div>
                    <div class="msg-error"></div>
                </li>
                @if(isset($article->img->path))
                    <li class="textarea-field">
                        <label>
                            <span class="label">{!! Lang::get('ru.image') !!}:</span>
                        </label>
                        {{ Html::image(asset(config('settings.theme')).'/images/articles/'.$article->img->path,'',['style'=>'width:400px']) }}
                        {!! Form::hidden('old_image',$article->img->path) !!}
                    </li>
                @endif
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">{!! Lang::get('ru.image') !!}:</span>
                        <br/>
                    </label>
                    <div class="input-prepend">
                        {!! Form::file('image', ['class' => 'filestyle','data-buttonText'=>Lang::get('ru.file_choose_image'),'data-buttonName'=>"btn-primary",'data-placeholder'=>Lang::get('ru.file_image')]) !!}
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">{!! Lang::get('ru.category') !!}:</span>
                        <br/>
                    </label>
                    <div class="input-prepend">
                        {!! Form::select('category_id', $categories,isset($article->category_id) ? $article->category_id  : '') !!}
                    </div>
                </li>
                @if(isset($article->id))
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <li class="submit-button">
                    {!! Form::button(Lang::get('ru.save'), ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}
                </li>
            </ul>
            {!! Form::close() !!}
            <script>
                CKEDITOR.replace('editor');
                CKEDITOR.replace('editor2');
            </script>
        @else
            {!! Lang::get('ru.articles_no') !!}
        @endif
    </div>
</div>