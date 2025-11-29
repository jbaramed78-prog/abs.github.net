

<x-loginLayout>
    <div class="h-screen overflow-hidden login-bg grid place-items-center">
        <div class="p-6 rounded-lg shadow-lg bg-white max-w-md">
            <div class="grid place-items-center my-2">
                <img src="{{ asset('img/logo_ofppt.png') }}" class="rounded-full w-24">
            </div>
            <h1 class="text-xl text-center mb-5">Récupération de compte</h1>
            <form method="POST" action="/checkCode">
                @csrf
                <p class="text-base text-slate-800 font-medium my-4">
                    Un e-mail contenant un code de validation vient d'être envoyé à 
                    <span class="text-sm text-sky-700 mx-1">{{ session('email') }}</span> 
                </p>
                <div class="sm:w-[24.5rem] w-[18rem] grid grid-cols-1 gap-4">
                    <x-contents.inpute type='number' class="w-full mb-5" name='codeVerification' placeholder="Entrez le code"/>
                </div>
                <x-contents.button type='submit'/>
                    @if (session()->has('error'))
                        <div class="w-full text-center bg-red-100 py-2 mt-3 rounded-md text-md text-red-500">
                            Le code de verification incorecte !      
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-loginLayout>