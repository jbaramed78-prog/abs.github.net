<x-loginLayout>
    <div class="h-screen overflow-hidden login-bg grid place-items-center">
        <div class="p-6 rounded-lg shadow-lg bg-white max-w-md lg:w-[400px]">

            <h2 class="mb-6 mt-3 text-center text-lg font-semibold">Compte 
                <span class="font-semibold">ABSYS OFPPT</span> 
            </h2>

            <div class="grid place-items-center my-2">
                <img src="{{ asset('images/'. session('img') ) }}" class="rounded-full w-24">
            </div>
            <h1 class="text-lg font-semibold text-slate-800 text-center mb-5">{{ session('name') }}</h1>
            {{-- @if(session()->has("user_cin"))
                {{session(['user_cin' => session("user_cin")]);}}
            @endif --}}
            <form method="POST" action="/pwd_reset">
                @csrf
                <p class="px-2 text-sm font-semibold mb-3 mt-8">
                    Créez un mot de passe sécurisé
                </p>
                
                <div  class="grid grid-cols-1 gap-4 mb-5">
                    <x-contents.inpute type='password' name='pwd' placeholder="Nouveau mot de passe" required/>
                    <x-contents.inpute type='password' name='rpwd' placeholder="Confirmer" required/>
                </div>
                <x-contents.button type='submit'/>
                    @if (session()->has('error'))
                        <div class="w-full text-center bg-red-100 py-2 mt-3 rounded-md text-md text-red-500">
                            Mot de passe incorrect         
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-loginLayout>