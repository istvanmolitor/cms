<div {{ $attributes->merge(['class' => 'content-element content-element-' . $type]) }}>
    {{ $slot }}
</div>
