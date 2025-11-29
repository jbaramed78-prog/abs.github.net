<div id="dashboard-cards" class="px-6">
    {{-- -->first card --}}
        <div class="card">
            <hr class="px-16 my-5 mt-6">
            <h2 class="mb-4 text-gray-400 text-xs uppercase font-bold ">Admin section</h2>
            <ul>
                <li id="test" class="flex" data-link="dashboard">
                    <x-contents.svg :name="'edu'"/>
                    <a @click="window.innerWidth < 768 ? show = false : show = true" href="#">Dashboard</a>
                </li>
                <li class="flex" data-link="ajt">
                    <x-contents.svg :name="'edu'"/>
                    <a @click="window.innerWidth < 768 ? show = false : show = true" href="#">Ajouter l'absence</a>
                </li>
                <li class="flex" data-link="justif">
                    <x-contents.svg :name="'edu'"/>
                    <a @click="window.innerWidth < 768 ? show = false : show = true" href="#">Justifier l'absence</a>
                </li>
                <li class="flex">
                    <x-contents.svg :name="'edu'"/>
                    <a @click="window.innerWidth < 768 ? show = false : show = true" href="#">Detail par Class</a>
                </li>

            </ul>
        </div>
    {{-- -->second card --}}
        <div class="card">
            <hr class="px-16 my-5 mt-7">
            <h2 class="mb-4 text-gray-400 text-xs uppercase font-bold ">Admin section</h2>
            <ul>
                <li class="flex">
                    <x-contents.svg :name="'edu'"/>
                    <a @click="window.innerWidth < 768 ? show = false : show = true" href="#">ABORT EDU</a>
                </li>
                <li class="flex">
                    <x-contents.svg :name="'edu'"/>
                    <a @click="window.innerWidth < 768 ? show = false : show = true" href="#">ABORT EDU</a>
                </li>
                <li class="flex">
                    <x-contents.svg :name="'edu'"/>
                    <a @click="window.innerWidth < 768 ? show = false : show = true" href="#">ABORT EDU</a>
                </li>
                <li class="flex">
                    <x-contents.svg :name="'edu'"/>
                    <a @click="window.innerWidth < 768 ? show = false : show = true" href="#">ABORT EDU</a>
                </li>

            </ul>
        </div>
        
    </div>