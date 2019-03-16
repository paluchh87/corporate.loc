<div id="content-page" class="content group">
    <div class="hentry group">
        @if(isset($portfolio) || (Route::currentRouteName() ==  'portfoliosCreate') )
            {!! Form::open(['url' => (isset($portfolio->id)) ? route('portfoliosUpdate',['portfolios'=>$portfolio->alias]) : route('portfoliosStore'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
            <ul>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">{!! Lang::get('ru.title') !!}:</span>
                        <br/>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        {!! Form::text('title',isset($portfolio->title) ? $portfolio->title  : old('title'), ['placeholder'=>'']) !!}
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">{!! Lang::get('ru.keywords') !!}:</span>
                        <br/>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        {!! Form::text('keywords', isset($portfolio->keywords) ? $portfolio->keywords  : old('keywords'), ['placeholder'=>'']) !!}
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">{!! Lang::get('ru.meta_description') !!}:</span>
                        <br/>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        {!! Form::text('meta_desc', isset($portfolio->meta_desc) ? $portfolio->meta_desc  : old('meta_desc'), ['placeholder'=>'']) !!}
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">{!! Lang::get('ru.alias') !!}:</span>
                        <br/>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        {!! Form::text('alias', isset($portfolio->alias) ? $portfolio->alias  : old('alias'), ['placeholder'=>'']) !!}
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Customer:</span>
                        <br/>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        {!! Form::text('customer', isset($portfolio->customer) ? $portfolio->customer  : old('customer'), ['placeholder'=>'']) !!}
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">{!! Lang::get('ru.filter') !!}:</span>
                        <br/>
                    </label>
                    <div class="input-prepend">
                        {!! Form::select('filter_alias', $filters, isset($portfolio->filter_alias) ? $portfolio->filter_alias  : '') !!}
                    </div>
                </li>
                <li class="textarea-field">
                    <label for="message-contact-us">
                        <span class="label">{!! Lang::get('ru.description') !!}:</span>
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
                        {!! Form::textarea('text', isset($portfolio->text) ? $portfolio->text  : old('text'), ['id'=>'editor','class' => 'form-control','placeholder'=>'']) !!}
                    </div>
                    <div class="msg-error"></div>
                </li>
                @if(isset($portfolio->img->path))
                    <li class="textarea-field">
                        <label>
                            <span class="label">{!! Lang::get('ru.image') !!}:</span>
                        </label>
                        {{ Html::image(asset(config('settings.theme')).'/images/portfolios/'.$portfolio->img->path,'',['style'=>'width:400px']) }}
                        {!! Form::hidden('old_image',$portfolio->img->path) !!}
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
                @if(isset($portfolio->id))
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <li class="submit-button">
                    {!! Form::button(Lang::get('ru.save'), ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}
                </li>
            </ul>
            {!! Form::close() !!}
            <script>
                CKEDITOR.replace('editor');
            </script>
        @endif
    </div>
</div>