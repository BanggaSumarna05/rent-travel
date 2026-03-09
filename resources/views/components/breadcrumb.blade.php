@props(['items' => []])

<nav class="flex mb-8 overflow-x-auto no-scrollbar whitespace-nowrap" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('home') }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-gold transition-colors">
                <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                Beranda
            </a>
        </li>
        @foreach($items as $item)
        <li>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-300 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                @if(isset($item['url']))
                <a href="{{ $item['url'] }}" class="ml-1 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-gold transition-colors md:ml-2">{{ $item['label'] }}</a>
                @else
                <span class="ml-1 text-[10px] font-black uppercase tracking-widest text-gold md:ml-2">{{ $item['label'] }}</span>
                @endif
            </div>
        </li>
        @endforeach
    </ol>
</nav>
