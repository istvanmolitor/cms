@if(!empty($settings['url']))
    <div class="content-element content-element-iframe my-8">
        <div style="width: {{ $settings['width'] }}; height: {{ $settings['height'] }};">
            <iframe src="{{ $settings['url'] }}"
                    title="{{ $settings['title'] }}"
                    frameborder="0"
                    @if($settings['allowFullscreen']) allowfullscreen @endif
                    class="w-full h-full"></iframe>
        </div>
    </div>
@endif

