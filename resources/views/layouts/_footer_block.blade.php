@if (isset($data['chapter']) && ($data['chapter']->id == 1 || $data['chapter']->id == 10))
    <div class="container">
        <h2>{{ trans('content.answer_question') }}</h2>
    </div>
    <div id="footer">
        {{ csrf_field() }}
        <div class="container feedback-container">
            <div class="title">{{ trans('content.feedback_form') }}</div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                @include('_input_block',['name' => 'name', 'type' => 'text', 'placeholder' => trans('content.your_name'), 'icon' => 'icon-user', 'useAjax' => true])
                @include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => trans('content.your_email'), 'icon' => 'icon-mail-read', 'useAjax' => true])
                @include('_input_block',['name' => 'phone', 'type' => 'text', 'placeholder' => trans('content.your_phone'), 'icon' => 'icon-iphone', 'useAjax' => true])
                @include('_input_block',['name' => 'city', 'type' => 'text', 'placeholder' => trans('content.your_city'), 'icon' => 'icon-city', 'useAjax' => true])
                @include('_select_block', [
                    'name' => 'type',
                    'values' => [trans('content.salon'),trans('content.clinic')],
                    'selected' => count($errors) ? old('type') : trans('content.salon')
                ])

                @include('_checkbox_block', ['name' => 'i_agree', 'label' => trans('content.i_agree_pd'), 'checked' => false])

            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                @include('_textarea_block', ['name' => 'message', 'placeholder' => trans('content.message'), 'icon' => 'icon-bubble-dots4', 'simple' => true, 'useAjax' => true])
                @include('_button_block', [
                    'type' => 'button',
                    'id' => 'send_message',
                    'text' => trans('content.send'),
                    'addClass' => 'pull-right',
                    'icon' => 'icon-upload',
                    'disabled' => true
                ])
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 20px;">
                @include('_policy_block')
            </div>
        </div>
    </div>
@endif

@if (isset($data['chapter']))
    @include('layouts._all_truth_block', ['invisible' => true])
    @include('layouts._all_truth_block')
@endif

<div id="articles-container">
    @if (count($articles) && !preg_match('/^(articles)/',Request::path()) )
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1>{{ trans('content.recommended_articles') }}</h1>
            </div>
            @if (count($articles) > 3)
                <ul class="col-md-4 col-sm-4 col-xs-12">
                    @for ($i=0;$i<ceil(count($articles)/3);$i++)
                        @include('layouts._articles_line_block',['article' => $articles[$i]])
                    @endfor
                </ul>
                <ul class="col-md-4 col-sm-4 col-xs-12">
                    @for ($i=ceil(count($articles)/3);$i<(ceil(count($articles)/3))*2;$i++)
                        @include('layouts._articles_line_block',['article' => $articles[$i]])
                    @endfor
                </ul>
                <ul class="col-md-4 col-sm-4 col-xs-12">
                    @for ($i=(ceil(count($articles)/3))*2;$i<count($articles);$i++)
                        @include('layouts._articles_line_block',['article' => $articles[$i]])
                    @endfor
                </ul>
            @else
                <ul class="col-md-12 col-sm-12 col-xs-12">
                    @foreach ($articles as $article)
                        @include('layouts._articles_line_block',['article' => $article])
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
</div>

<div id="copyright-line">
    <div class="container">
        <div class="copyright hidden-xs">{{ '© 2011-'.date('Y').trans('content.copyright') }}</div>
        <div class="pull-right">
            <img style="width: 100px; float: left; margin-right: 10px;" src="{{ asset('images/compress_logo.svg') }}" />
            <div class="soc-icon"><a href="https://vk.com/endospherestherapyrussia"><img src="{{ asset('images/vk.png') }}" /></a></div>
            <div class="soc-icon"><a href="https://www.youtube.com/c/EndospheresTherapyRussia"><img src="{{ asset('images/youtube.png') }}" /></a></div>
            <div class="soc-icon"><a href="https://www.facebook.com/EndospheresTherapyRussia"><img src="{{ asset('images/fb.png') }}" /></a></div>
            <div class="soc-icon"><a href="https://www.instagram.com/endospheresrussia_official/"><img src="{{ asset('images/insta.png') }}" /></a></div>
        </div>
    </div>
</div>
