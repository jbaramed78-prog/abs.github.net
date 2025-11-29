

<x-loginLayout>

<div class="h-screen overflow-hidden login-bg grid justify-center">
  <div class="sm:w-[400px]">

    {{-- img --}}
    <div class="grid place-items-center my-10">
      <img src="{{ asset('img/logo_ofppt.png') }}" class="rounded-full w-24">
    </div>

    {{-- form --}}
    <div class="block p-6 rounded-lg shadow-lg bg-white w-full">
      <h1 class="text-2xl text-center mb-3">Connexion</h1>
        <form method="POST" action="/login" >
          @csrf
          <div class="form-group mb-6">
            <label for="username" class="form-label inline-block mb-2 text-gray-700">Identifiant</label>
            <x-contents.inpute placeholder="Matricule / Email" type='text' name='cin_email' value="{{old('cin_email')}}"/>
          </div>

          <div class="form-group mb-6">



        <label for="Password" class="form-label inline-block mb-2 text-gray-700">Mot de passe</label>

        <div id="login" class="relative" >

          <input class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700
          bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-ou
            tm-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
           :type="open ? 'password':'text'" name='password' autocomplete="on"/>
            <fas :icon="open ? 'eye-slash':'eye'" 
            class="cursor-pointer absolute top-2 right-2 pointer h-5 w-5" 
            @click="open = !open"/>

    
        </div>


          </div>
          <div class="flex justify-between items-center mb-6">
            <div class="form-group form-check">
              <input type="checkbox" name="check" id="Check">
              <label class="form-check-label inline-block text-gray-800" for="Check">Remember me</label>
            </div>
            <a href="/user_info"
              class="text-blue-600 hover:text-blue-800 focus:text-blue-700 transition duration-200 ease-in-out">Mot de passe oublié ?</a>
          </div>
          <x-contents.button type='submit'/>
        </form>
        <span>
          @if(session()->has('suspended'))
              <div class="w-full text-center bg-red-100 py-2 mt-3 rounded-md text-md text-red-500">
                {{session('suspended')}}
              </div>
          @endif
        </span>

        <span>
          @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="w-full text-center bg-red-100 py-2 mt-3 rounded-md text-md text-red-500">
                 {{$error}}            
               </div>
            @endforeach
          @endif
        </span>
      </div>
    </div>
  </div>
</x-loginLayout>