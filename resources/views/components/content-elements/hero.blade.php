@if(!empty($settings['image_src']))
    <div class="relative overflow-hidden rounded-xl shadow-lg min-h-96">
        <img src="{{ $settings['image_src'] }}" alt="{{ $settings['title'] ?? '' }}" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        <div class="relative z-10 flex flex-col justify-end h-full min-h-96 p-8">
            @if(!empty($settings['title']))
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">
                    {{ $settings['title'] }}
                </h1>
            @endif
            @if(!empty($settings['lead']))
                <p class="text-lg text-gray-200 max-w-3xl">{{ $settings['lead'] }}</p>
            @endif
        </div>
    </div>
@else
    <div class="bg-gray-50 rounded-xl p-8 md:p-12">
        @if(!empty($settings['title']))
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                {{ $settings['title'] }}
            </h1>
        @endif
        @if(!empty($settings['lead']))
            <p class="text-lg text-gray-600 max-w-3xl">{{ $settings['lead'] }}</p>
        @endif
    </div>
@endif
