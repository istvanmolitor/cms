@php
    $data = json_decode($content, true) ?? [];
    $url = $data['url'] ?? $content;
    $width = $data['width'] ?? '300px';
    $height = $data['height'] ?? '450px';

    // YouTube embed URL conversion
    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches)) {
        $url = "https://www.youtube.com/embed/" . $matches[1];
    }
@endphp
<div class="content-element content-element-video my-8">
    <div class="relative overflow-hidden rounded-lg shadow-md" style="width: {{ $width }}; height: {{ $height }};">
        <iframe src="{{ $url }}"
                frameborder="0"
                allowfullscreen
                class="w-full h-full"></iframe>
    </div>
</div>

