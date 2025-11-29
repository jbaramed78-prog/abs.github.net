

<x-loginLayout>
    <div class="h-screen overflow-hidden login-bg grid place-items-center">
        <div class="p-6 rounded-lg shadow-lg bg-white max-w-md">
            <div class="grid place-items-center my-2">
                <img src="{{ asset('img/logo_ofppt.png') }}" class="rounded-full w-24">
            </div>
            <h1 class="text-xl text-center mb-5">Vérification</h1>
            <form method="POST" action="/check_user">
                @csrf
                <div class="sm:w-[24.5rem] w-[18rem] grid grid-cols-1 gap-4">
                    <x-contents.inpute type='text' value="{{old('cin')}}" class="w-full" name='cin' placeholder="CIN"/>
                    <x-contents.inpute type='text' value="{{old('email')}}" class="w-full mb-5" name='email' placeholder="E-mail"/>
                </div>
                <x-contents.button type='submit'/>
                    @if ($errors->any())
                        <div class="w-full text-center bg-red-100 py-2 mt-3 rounded-md text-md text-red-500">
                            Les donnees sont incorecte         
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-loginLayout>