

<template>
<section class="xl:pt-0 pb-16 pt-10">

    <div class="grid place-content-center mt-5 w-full">

        <div class="bg-white xl:w-[45rem] lg:w-[38rem] md:w-[29rem] w-[85vw] sm:[23rem] px-5 py-10 rounded-lg shadow-md shadow-slate-300">

            <div class=" uppercase text-center mb-8  font-semibold text-lg">Ajouter un utilisateur</div>

            <!-- Add User Form -->
            <form  @submit.prevent >

                <div class="grid xl:grid-cols-2 xl:gap-6">
                    <!-- Firstname -->
                    <div class="relative z-0 w-full mb-8 group">
                        <input
                        :class="newUser.nom.check? 'focus:border-blue-600' : 'focus:border-red-600'"
                        @input="checkinpute" title="first" v-model="newUser.nom.text" type="text" name="floating_first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-400 appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " required>
                        <label
                        :class="newUser.nom.check?'peer-focus:text-blue-600':'peer-focus:text-red-600'"
                        for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nom</label>
                        <span v-if="!newUser.nom.check" class="text-sm text-red-600 font-medium">{{ nomError }}</span>
                    </div>
                    <!-- Lastname -->
                    <div class="relative z-0 w-full mb-8 group">
                        <input
                        :class="newUser.prenom.check? 'focus:border-blue-600' : 'focus:border-red-600'"
                        @input="checkinpute" title="last" v-model="newUser.prenom.text" type="text" name="floating_last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-400 appearance-none -blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                        <label
                        :class="newUser.prenom.check?'peer-focus:text-blue-600':'peer-focus:text-red-600'" 
                        for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Prénom</label>
                        <span v-if="!newUser.prenom.check" class="text-sm text-red-600 font-medium">{{ prenomError }}</span>
                    </div>
                </div>
                <!-- Email -->
                <div class="relative z-0 w-full mb-8 group">
                    <input
                    :class="newUser.email.check? 'focus:border-blue-600' : 'focus:border-red-600'"
                    @input="checkinpute" title="email" v-model="newUser.email.text" type="text" name="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-400 appearance-none -blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                    <label
                    :class="newUser.email.check?'peer-focus:text-blue-600':'peer-focus:text-red-600'"
                    for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">E-mail address</label>
                    <span v-if="!newUser.email.check" class="text-sm text-red-600 font-medium">{{ emailError }}</span>
                </div>
                <!-- CIN -->
                <div class="relative z-0 w-full mb-8 group">
                    <input
                    :class="newUser.cin.check? 'focus:border-blue-600' : 'focus:border-red-600'" 
                    @input="checkinpute" title="cin" v-model="newUser.cin.text" type="text" name="cin" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-400 appearance-none -blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                    <label
                    :class="newUser.cin.check?'peer-focus:text-blue-600':'peer-focus:text-red-600'"
                    for="cin" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">CIN</label>
                    <span v-if="!newUser.cin.check" class="text-sm text-red-600 font-medium">{{ cinError }}</span>
                </div>

                <!-- Password -->
                <div class="relative z-0 w-full mb-8 group">
                    <input
                    :class="newUser.password.check? 'focus:border-blue-600' : 'focus:border-red-600'"
                    @input="checkinpute" title="pwd" v-model="newUser.password.text" type="password" name="pwd" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-400 appearance-none -blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                    <label
                    :class="newUser.password.check?'peer-focus:text-blue-600':'peer-focus:text-red-600'"
                    for="pwd" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mot de pass</label>
                    <span v-if="!newUser.password.check" class="text-sm text-red-600 font-medium">{{ pwdError }}</span>
                </div>
                <!-- Repeate password -->
                <div class="relative z-0 w-full mb-8 group">
                    <input
                    :class="newUser.rpassword.check? 'focus:border-blue-600' : 'focus:border-red-600'"
                    @input="checkinpute" title="rpwd" v-model="newUser.rpassword.text" type="password" name="r-pwd" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-400 appearance-none -blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                    <label
                    :class="newUser.rpassword.check?'peer-focus:text-blue-600':'peer-focus:text-red-600'"
                    for="r-pwd" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Répéter le mot de pass</label>
                    <span v-if="!newUser.rpassword.check" class="text-sm text-red-600 font-medium">{{ rpwdError }}</span>
                </div>

                <div class="mb-5">
                    <select
                    @change="errorFr = false"
                    class=" h-[2rem] w-[10rem] border-b-2 border-gray-400 focus:border-blue-600 outline-none" 
                    v-model="newUser.role.text">
                        <option class="hidden" selected >Role</option>
                        <option value="admin">Admin</option>
                        <option value="Formateur">Formateur</option>
                    </select>

                    <span
                    :class="errorFr?'border-red-500':''"
                    @click="Model" v-if="newUser.role.text == 'Formateur'" type="text" class=" cursor-pointer border-b-2 active:bg-slate-300 mt-2 w-[6rem] hover:bg-gray-200
                    font-medium text-sm px-5 py-2 mx-5 text-center">Changer</span><br>
                    <div v-if="errorFr" class="text-sm text-red-600 font-medium mt-2">{{errrContent}}</div>

                </div>

                <!-- Auth Password -->
                <span class="text-gray-400 mt-[5rem]  text-sm">//Entrez votre mot de passe pour enregistrer les changements</span>
                <div class="relative z-0 w-full mt-[1.8rem] mb-8 group">
                    
                    <input
                    v-on:input="AuthPwd.check = false"
                    :class="AuthPwd.check? 'border-red-600' : 'focus:border-blue-600 peer'"
                    title="currentpwd" v-model="AuthPwd.text" type="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-400 appearance-none -blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " required>
                    <label
                    :class="AuthPwd.check?'text-red-600':'peer-focus:text-blue-600'"
                    class="peer-focus:font-medium absolute text-md text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Mot de Pass</label>
                    <span v-if="AuthPwd.check" class="text-sm text-red-600 font-medium"> {{ AuthPwd.error }} </span>
                </div>
            <!-- Submit btn -->
            <button @click="checkform()" type="submit" class="text-white bg-blue-600 mt-2 w-[6rem] hover:bg-blue-700 active:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Créer</button>
            </form>

        </div>
    </div>

    <div id="Model" class="fixed top-0 w-full hidden h-full z-40 place-content-center rounded-md">
        <div class="absolute bg-slate-300 w-full h-full rounded-md opacity-50 z-10"></div>

            <div class=" lg:w-[40rem] sm:w-[32rem] w-[25rem] pb-5 bg-white absolute z-20 translate-y-[-50%] translate-x-[-50%]  md:translate-x-[-70%] top-[50%] left-[50%] grid place-content-center rounded-md ">
            <form @submit.prevent>
               <div class="lg:w-[40rem] sm:w-[32rem] w-[25rem] flex justify-between px-5 pt-5 pb-3">
                    <span class="text-gray-400 hover:text-sky-700 cursor-pointer"
                    v-show="modelModel == 'module'" @click="modelModel = 'groupe'"><fas size="xl" icon="fa-arrow-left" /></span>

                    <span class="text-gray-400 hover:text-sky-700 cursor-pointer"
                    v-show="modelModel == 'groupeModule'" @click="modelModel = 'module'"><fas size="xl" icon="fa-arrow-left" /></span>

                    <span class="text-gray-400 hover:text-sky-700 cursor-pointer"
                    v-show="modelModel == 'groupe'" @click="modelModel = 'filiere', groupesIds = []"><fas size="xl" icon="fa-arrow-left" /></span>

                    <span 
                    class="hover:text-sky-700 text-gray-400 cursor-pointer" 
                    @click="Model"><fas size="xl" icon="fa-xmark" /></span>
                </div>
                <div class="lg:w-[40rem] sm:w-[32rem] w-[25rem] text-center uppercase lg:text-lg text-slate-800 font-bold sm:text-base py-3">
                    les Groupes et les module de ce Formateur
                </div>
                
                <!-- Filieres Model -->
                <div v-show="modelModel == 'filiere'" class="lg:w-[35rem] flex justify-center items-center sm:w-[28rem] w-[22rem] mt-10 mb-14">
                    
                    <div class="w-[90%] px-2 py-3 rounded-md border-2 border-sky-500">
                    <div class="w-full h-[15rem] overflow-y-scroll overflow-x-hidden">

                        <div v-for="fil in filieres" :key="fil.id"
                            @click="filEvent"
                            :id="fil.id"
                            :class="'fil'+fil.id"
                            class="allFil w-full py-[.8rem] flex items-center justify-center hover:scale-105 ease-in-out duration-100 cursor-pointer text-center text-sm font-semibold">{{fil.nom_fil}}
                        </div>

                    </div>
                    </div>
                    
                </div>

                <div v-show="modelModel == 'filiere'" class="flex justify-between items-center pb-3 px-3 sm:px-5">
                    <span></span>
                    <template v-if="spinloading">
                        <svg role="status" class="inline w-10 h-10 mr-2 text-transparent animate-spin fill-blue-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                    </template>
                    <button
                        type="submit"
                        @click="getGourpesProf"
                        v-if="listIds.length > 0"
                        class="bg-transparent active:bg-blue-500 text-blue-700 font-semibold active:text-white py-2 px-6 border border-blue-500 active:border-transparent rounded">
                            Suivant
                    </button>
                </div>


                <!-- Modules Model -->
                <div v-show="modelModel == 'module'" class="lg:w-[35rem] flex justify-center items-center sm:w-[28rem] w-[22rem] mt-10 mb-14">
                    
                    <div class="w-[90%] px-2 py-3 rounded-md border-2 border-sky-500">
                    <div id="Modulecontent" class="w-full h-[15rem] overflow-y-scroll overflow-x-hidden">

                        <div class="mb-8 px-5">

                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input @keyup="searchModule" v-model="search" type="text" placeholder="Recherche des modules" class=" text-sm font-bold rounded-md focus:outline-2 outline-sky-600 block w-full pl-10 p-2.5  ">
                            </div>


                            <div class="grid grid-cols-1 text-sm font-semibold gap-2 my-5">
                                <div v-for="md in modules" >
                                    <input v-model="modulesIds" :value="md.id" type="checkbox" :id="md.id">
                                    <label class="ml-2" :for="md.id">{{ md.nom_module }}</label>
                                </div>
                                <div
                                @click="Model2"
                                class=" mt-3 bg-sky-400 hover:bg-sky-500 cursor-pointer test-md font-bold text-white text-center py-1">Ajouter un module</div>
                            </div>
                            
                        </div>

                    </div>
                    </div>
                    
                </div>

                <div v-show="modelModel == 'module'" class="flex justify-between items-center pb-3 px-3 sm:px-5">
                    <span></span>
                    <button
                        type="submit"
                        @click="prepareThis"
                        v-if="modulesIds.length > 0"
                        class="bg-transparent active:bg-blue-500 text-blue-700 font-semibold active:text-white py-2 px-6 border border-blue-500 active:border-transparent rounded">
                            Suivant
                    </button>
                </div>
                

                <!-- Groupe Model -->
                <div v-show="modelModel == 'groupe'" class="lg:w-[35rem] flex justify-center items-center sm:w-[28rem] w-[22rem] mt-10 mb-14">
                    
                    <div class="w-[90%] px-2 py-3 rounded-md border-2 border-sky-500">
                    <div class="w-full h-[15rem] overflow-y-scroll overflow-x-hidden">

                        <div class="mb-8 px-5" v-for="fil in listGroupes">
                            <div class="h-10 border-b-2 border-sky-600 text-sky-800 text-sm font-bold px-5">{{ fil.nomFil }}</div>
                            <div class="grid grid-cols-3 text-base font-bold gap-2 my-5">
                                <div v-for="gp in fil.groupes" >
                                    <input v-model="groupesIds" :value="gp.nom_gp" type="checkbox" :id="gp.id">
                                    <label class="ml-2" :for="gp.id">{{ gp.nom_gp }}</label>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                    </div>
                    
                </div>

                <div v-show="modelModel == 'groupe'" class="flex justify-between items-center pb-3 px-3 sm:px-5">
                    <span></span>
                    <button
                        type="submit"
                        @click="FilieresModules"
                        v-if="groupesIds.length > 0"
                        class="bg-transparent active:bg-blue-500 text-blue-700 font-semibold active:text-white py-2 px-6 border border-blue-500 active:border-transparent rounded">
                            Suivant
                    </button>
                </div>

                <!-- GroupeModule Model -->
                <div v-show="modelModel == 'groupeModule'" class="lg:w-[35rem] flex justify-center items-center sm:w-[28rem] w-[22rem] mt-10 mb-14">
                    
                    <div class="w-[90%] px-2 py-3 rounded-md border-2 border-sky-500">
                    <div class="w-full h-[15rem] overflow-y-scroll overflow-x-hidden">

                        <div class="mb-8 px-5" v-for="groupe in selectedGroupes">
                            <div class="h-10 border-b-2 border-sky-600 text-sky-800 text-sm font-bold px-5">{{ groupe }}</div>
                            <div class="grid grid-cols-1 text-sm font-bold gap-2 my-5">
                                <div v-for="md in selectedModules" >
                                    <input v-model="slectedMdIds" :value="md.id+'*$*'+groupe" type="checkbox" :id="md.id">
                                    <label class="ml-2" :for="md.id">{{ md.nom_module }}</label>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                    </div>
                    
                </div>

                <div v-show="modelModel == 'groupeModule'" class="flex justify-between items-center pb-3 px-3 sm:px-5">
                    <span></span>
                    <button
                        type="submit"
                        @click="Model"
                        v-if="showSave"
                        class="bg-transparent active:bg-blue-500 text-blue-700 font-semibold active:text-white py-2 px-6 border border-blue-500 active:border-transparent rounded">
                            Save
                    </button>
                </div>


            </form>
            </div>
    </div>



    <div id="Model2" class="fixed top-0 w-full h-full z-40 hidden place-content-center rounded-md">
        <div class="absolute bg-slate-300 w-full h-full rounded-md opacity-50 z-10"></div>

            <div class=" lg:w-[40rem] sm:w-[32rem] w-[25rem] pb-5 bg-white absolute z-20 translate-y-[-50%] translate-x-[-50%]  md:translate-x-[-70%] top-[50%] left-[50%] grid place-content-center rounded-md ">
            <form @submit.prevent>
               <div class="lg:w-[40rem] sm:w-[32rem] w-[25rem] flex justify-between px-5 pt-5 pb-3">
                    <span></span>
                    <span 
                    class="hover:text-sky-700 text-gray-400 cursor-pointer" 
                    @click="Model2"><fas size="xl" icon="fa-xmark" /></span>
                    
                </div>
                <div class="lg:w-[40rem] sm:w-[32rem] w-[25rem] text-center uppercase text-slate-800 font-bold text-xl py-3">
                    Ajouter un module
                </div>
                
                <!-- Add Model -->
                <div class="lg:w-[35rem] flex justify-center items-center sm:w-[28rem] w-[22rem] mt-10 mb-14">
                    
                    <input v-model="nameModule" type="text" placeholder="Entrez le nom du module" 
                    class="w-[90%] py-2 px-2 shadow-md shadow-slate-300 font-semibold outline-2 focus:outline-sky-500">
                    
                </div>

                <div class="flex justify-center items-center pb-3 px-3 sm:px-5">
                    <button
                        type="submit"
                        @click="addModel"
                        v-if="nameModule.length >= 1"
                        class="bg-transparent active:bg-blue-500 text-blue-700 font-semibold active:text-white py-2 px-6 border border-blue-500 active:border-transparent rounded">
                            Ajouter
                    </button>
                </div>




            </form>
            </div>
    </div>

</section>
</template>

<script setup>

    import { onMounted, reactive, ref, watch } from "vue"
    import axios from "axios";
    import { useToast } from "vue-toastification";
    import useFilieres from '../../services/filieres.js'
    const toast = useToast();


    //new User Object
    const newUser = reactive({
        nom : { text:"", check:true, reg: /^[a-z\s]{3,}$/i },
        prenom : { text:"", check:true, reg: /^[a-z\s]{3,}$/i},
        email : { text:"", check:true, reg: /^[\w\.\-]{5,}@[\w\-]+\.[\w]+$/i },
        cin : { text:"", check:true, reg: /^[A-Z]{1,3}[0-9]{4,6}$/i },
        password : { text:"", check:true },
        role : { text:"Role", check:true },
        rpassword : { text:"", check:true}
    })

    const AuthPwd = reactive({
        text:"", check:false, error:""
    })

    const { getFilieres , filieres } = useFilieres();

    onMounted(()=>{
        getFilieres()
    })

    const nomError = ref("Nom invalide")
    const modelModel = ref('filiere')
    const prenomError = ref("Prenom invalide")
    const emailError = ref("E-mail invalide")
    const cinError = ref("Cin invalide")
    const pwdError = ref("Mot de pass faible !!")
    const rpwdError = ref("Les mots de passe ne correspondent pas")
    const groupesIds = ref([])
    const modulesIds = ref([])
    const errorFr = ref(false)
    const search = ref("")
    const copieModules = ref([])
    const nameModule = ref("")
    const showSave = ref(false)

    const listGroupes = ref([])
    const listIds = ref([])
    const slectedMdIds =ref([])

    const resetEmailError = ref(false)
    const resetCinError = ref(false)
    const selectedGroupes = ref([])
    const selectedModules = ref([])
    
    const modules = ref(null)
    // after submit we start checking on-inpute event
    const start = ref(false)
    const spinloading = ref(false)
    const errrContent = ref("")

    //true if everything good and false if not
    const send = ref(false)


    /* On click we check our form */
    const checkform = () => {

        //si les champs vide
        if(AuthPwd.text == ""){
            return;
        }
        for(let e in newUser){ if(newUser[e].text == ""){ return; } }

        if(newUser.role.text == "Role"){
            errorFr.value = true
            errrContent.value = "Sélectionner le role de ce user"
            return;
        }
        
        if(newUser.role.text == "Formateur"){
            if(groupesIds.value.length == 0 || showSave.value == false){
                errorFr.value = true
                if(groupesIds.value.length == 0 && showSave.value == false){
                    errrContent.value = "Sélectionner les groupes et les modules de ce formateur"
                }else{
                    errrContent.value = "Sélectionner les module de ce formateur"
                }
                return;
            }
        }
        
        newUser.nom.check = newUser.nom.reg.test(newUser.nom.text)
        newUser.prenom.check = newUser.prenom.reg.test(newUser.prenom.text)
        newUser.email.check = newUser.email.reg.test(newUser.email.text)
        newUser.cin.check = newUser.cin.reg.test(newUser.cin.text)

        if( newUser.password.text.length <= 3 ){ newUser.password.check = false
        }else if(newUser.password.text != newUser.rpassword.text){ newUser.rpassword.check = false }

        start.value = true

        checkuser()
    }

    /* On inpute we check this out */
    const checkinpute = (event) => {

        if(start.value){
            if(event.target.title == "first") newUser.nom.check = newUser.nom.reg.test(newUser.nom.text)

            else if(event.target.title == "last") newUser.prenom.check = newUser.prenom.reg.test(newUser.prenom.text)
            
            else if(event.target.title == "email"){

                resetEmailError.value == true ? emailError.value = "E-mail invalide" : ''

                newUser.email.check = newUser.email.reg.test(newUser.email.text)

            } 
            
            else if(event.target.title == "cin"){

                resetCinError.value == true ? cinError.value = "Cin invalide" : ''

                newUser.cin.check = newUser.cin.reg.test(newUser.cin.text)

            } 

            else if(event.target.title == "pwd") {
                newUser.password.text.length <= 4 ? newUser.password.check = false : newUser.password.check = true}

            else if(event.target.title == "rpwd"){
                newUser.password.text != newUser.rpassword.text ? 
                newUser.rpassword.check = false : newUser.rpassword.check = true
            }

        }
    }

    /* If everything right we call addUser Function  */
    const checkuser = () => {

        for(let e in newUser){

            if(newUser[e].check == false){
                send.value = false
                break
            }
            else{  send.value = true }
        }

        if(send.value == true){

            addUser()
        }



    }

    const Model = () => {
        document.getElementById("Model").classList.toggle('hidden')
    }

    const Model2 = () => {
        document.getElementById("Model2").classList.toggle('hidden')
    }

    /* Add new user */
    const addUser = async () =>
    {
        axios.post(`/addNewUser`,{
            first:newUser.nom.text,last:newUser.prenom.text,
            cin:newUser.cin.text, email:newUser.email.text,
            pwd:newUser.password.text,curpwd:AuthPwd.text,
            role:newUser.role.text,modules:slectedMdIds.value,})
        .then((response) => {  

            if(response.data.message !== "user added successe" ){
                if(response.data.champ == "email"){

                    newUser.email.check = false
                    emailError.value = response.data.message
                    resetEmailError.value = true
                    
                }else if (response.data.champ == "cin"){

                    newUser.cin.check = false
                    cinError.value = response.data.message
                    resetCinError.value = true
                }else if (response.data.champ == "password"){
                    
                    AuthPwd.check = true
                    AuthPwd.error = response.data.message
                }

            }else{
                success(response.data.message)
                resetInputes()
            }
        })

        .catch((error) => {  Error() });
    };

    /* Alert successe message */
    const success = (message) => {

        toast.success(message, {
            position: "bottom-right",
            timeout: 3000,
            closeOnClick: true,
            pauseOnFocusLoss: false,
            pauseOnHover: false,
            icon: true,
            hideProgressBar: false,
        });
    }
    
    const resetInputes = () => {

        for(let elem in newUser){

            newUser[elem].text = ""

        }

        selectedGroupes.value = []
        selectedModules.value = []
        slectedMdIds.value = []
        modulesIds.value = []
        showSave.value = false

        newUser.role.text = "Role"
        AuthPwd.text = ""
        groupesIds.value = []



        
        modules.value = null
        copieModules.value = []
        nameModule.value = ""
        modelModel.value = "filiere"
    }
    resetInputes()
    const filEvent = (event) => {

        if(listIds.value.includes(event.target.id)){
            listIds.value = listIds.value.filter((e) => e != event.target.id)
        }else{
            listIds.value.push(event.target.id)
        }


        console.log(listIds.value)
        event.target.classList.toggle("bg-slate-200")
        event.target.classList.toggle("hover:scale-105")
        
    }

    const getGourpesProf = async () => {

        let response = await axios.post("/getFilieresProf", { list: listIds.value })

        listGroupes.value = response.data

        modelModel.value = 'groupe'
    }




    watch(() => modelModel.value, () => {

        for(let x of listIds.value){
            document.querySelector(".fil"+x).classList.add("bg-slate-200")
            document.querySelector(".fil"+x).classList.remove("hover:scale-105")
        }
    })

    watch(() => groupesIds.value, () => {

        if(groupesIds.value.length > 0){
            errorFr.value = false
        }
    })

    

    watch(() => newUser.role.text, () => {

        if(newUser.role.text == "admin"){
            groupesIds.value = []
            listIds.value = []
            modelModel.value = 'filiere'
            errorFr.value = false

            document.querySelectorAll(".allFil").forEach((e) => {
                e.classList.remove("bg-slate-200")
                e.classList.add("hover:scale-105")
            })
        }
    })


    const FilieresModules = async () => {
        let response = await axios.get("getModulesFil")
        modules.value = response.data
        copieModules.value = response.data
        modulesIds.value = []
        modelModel.value = 'module'
    }

    const searchModule = () => {

        modules.value = copieModules.value.filter(function(module){
            if(search.value == "")
                return true
            return module.nom_module.toLowerCase().includes(search.value.toLowerCase())
        });
    }

    const addModel = async () => {
        Model2()
        let response = await axios.get("addModule/"+nameModule.value)
        copieModules.value.push(response.data)
        modulesIds.value.push(response.data.id)
    }

    const prepareThis = () => {

        console.log(listGroupes.value)
        /* console.log(modulesIds.value) */

        /* console.log(groupesIds.value) */

        modelModel.value = "groupeModule";
        selectedGroupes.value = []
        selectedGroupes.value = groupesIds.value

       /*  for(let element of listGroupes.value){
            for(let gp of element.groupes){
                if(groupesIds.value.includes(gp.nom_gp)){
                    selectedGroupes.value.push(gp.nom_gp)
                }
            }
        } */


        /* console.log(selectedGroupes.value) */
        selectedModules.value = []
        for(let id of modulesIds.value){
            for(let md of copieModules.value){
                if(md.id == id){
                    selectedModules.value.push(md)
                }
            }
        }


    }

    watch(() => slectedMdIds.value, () => {
        showSave.value = checkmodules()
    })

    watch(() => showSave.value, () => {
        if(showSave.value == true){
            errorFr.value = false
        }
    })

    const checkmodules = () =>{
        var i = 0
        var length = selectedGroupes.value.length
        if(slectedMdIds.value.length  == 0){
            return false
        }

        for(let gp of selectedGroupes.value)
        {
            for(let md of slectedMdIds.value)
            {
                if(gp == md.split("*$*")[1]){
                    i += 1
                    console.log([i,gp,md.split("*$*")[1]])
                    break
                }
            }
        }

        if(length == i){
            return true
        }else{
            return false
        }

        
    }

    const Error = () => {

         toast.error('Something went wrong', {
            position: "bottom-right",
            timeout: 3000,
            closeOnClick: true,
            pauseOnFocusLoss: false,
            pauseOnHover: false,
            icon: true,
            hideProgressBar: false,
        });
    }

</script>
