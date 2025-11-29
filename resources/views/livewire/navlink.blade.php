
<a x-on:click="activeLink={{$numLink}};open=(window.innerWidth > 768) ? true : false"  class="flex items-end" >
    <span :class="activeLink === {{$numLink}} ? activeClass:inactiveClass">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20"
                        fill="currentColor">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
            </svg>
</span><strong  :class="activeLink==={{$numLink}} ? 'uppercase font-bold  ml-4 text-sm text-green-600': 'uppercase font-bold  ml-4 text-sm text-gray-700'" >{{$name}}
</strong></span>
    
</a>
