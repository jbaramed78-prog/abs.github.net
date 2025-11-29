
<template>
<section class="xl:h-auto xl:pt-0 pb-16 pt-10">

    <div class="grid place-content-center mt-12 xl:mt-0 xl:p-0 px-4 ">
        <div class="grid rounded-md shadow-md shadow-slate-300 xl:w-[50rem] py-10 gap-10 bg-white px-10 ">
            
            <!-- Page : Edit User -->
            <template v-if="editpage">
                <div class=" uppercase text-lg font-bold text-center">éditer L'utilisateur</div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 ">
                    <!-- Firstname -->
                    <div>
                        <div class="mb-2"><label class=" font-semibold px-2" for="nom">Nom</label></div>
                        <input
                        @input="checkinpute"
                        :class="user.nom.check?'outline-blue-500':'outline-red-500'"
                        v-model="user.nom.text" title="first" id="nom" class=" outline-2 focus:bg-white px-3 h-[2.8rem] rounded-md bg-slate-200 w-full lg:w-[100%]" placeholder="Nom" type="text">
                        <div class="mt-1"><span v-if="!user.nom.check" class="text-sm text-red-600 font-medium ml-2">{{nomError}}</span></div>
                    </div>
                    <!-- Lastname -->
                    <div>
                        <div class="mb-2"><label class=" font-semibold px-2" for="prenom">Prenom</label></div>
                        <input
                        @input="checkinpute"
                        :class="user.prenom.check?'outline-blue-500':'outline-red-500'"
                        v-model="user.prenom.text" title="last" id="prenom" class=" outline-2 focus:bg-white px-3 h-[2.8rem] rounded-md bg-slate-200 w-full lg:w-[100%]" placeholder="Prenom" type="text">
                        <div class="mt-1"><span v-if="!user.prenom.check" class="text-sm text-red-600 font-medium ml-2">{{prenomError}}</span></div>
                    </div>
                    
                </div>
                <!-- Email -->
                <div class="grid grid-cols-1 gap-1">
                    <label class="mb-1 font-semibold px-2" for="email">E-mail adresse</label>
                    <input
                    @input="checkinpute"
                    :class="user.email.check?'outline-blue-500':'outline-red-500'"
                    v-model="user.email.text" title="email" id="email" class=" outline-2 focus:bg-white px-3 h-[2.8rem] rounded-md bg-slate-200 w-full" placeholder="mail@edu-ofppt.ma" type="text">
                    <span v-if="!user.email.check" class="text-sm text-red-600 font-medium ml-2">{{emailError}}</span>
                </div>
                <!-- Cin -->
                <div class="grid grid-cols-1 gap-1">
                    <label class="mb-1 font-semibold px-2" for="cin">Cin</label>
                    <input
                    @input="checkinpute"
                    :class="user.cin.check?'outline-blue-500':'outline-red-500'"
                    v-model="user.cin.text" title="cin" id="cin" class=" outline-2 focus:bg-white px-3 h-[2.8rem] rounded-md bg-slate-200 w-full" placeholder="Cin" type="text">
                    <span v-if="!user.cin.check" class="text-sm text-red-600 font-medium ml-2">{{cinError}}</span>
                </div>


                <div class="mb-2" v-if="user.role.text == 'Formateur'">

                    <span class=" text-blue-700">
                        <span><fas size="lg" icon="fa-arrow-right" /></span>
                        <span class="mx-2 text-lg font-semibold">Formateur</span>
                    </span>

                    <span
                    :class="errorFr?'border-red-500':''"
                    @click="Model" type="text" class=" cursor-pointer outline-2 hover:bg-white border-2 hover:border-blue-500 px-3  bg-slate-200
                    font-normal text-base py-[4.5px] mx-5 text-center">Changer</span><br>
                    <div v-if="errorFr" class="text-sm text-red-600 font-medium mt-2">{{errorContent}}</div>

                </div>

                <div v-if="user.role.text == 'admin'" class=" text-blue-700">
                    <span><fas size="lg" icon="fa-arrow-right" /></span>
                    <span class="mx-2 text-lg font-semibold">Admin</span>
                </div>

                <form @submit.prevent >
                    <!-- Auth Password -->
                    <div class="grid grid-cols-1 gap-1 mb-6">
                        <span class="text-gray-400  text-sm mb-2">//Entrez votre mot de passe pour enregistrer les changements</span>
                        <label class="mb-1 font-semibold px-2" for="currpwd">Mot de passe</label>
                        <input
                        ref="inputePwd_one"
                        @input="AuthPwd_one.check = false"
                        :class="AuthPwd_one.check?'outline-red-500':'outline-blue-500'"
                        v-model="AuthPwd_one.text" title="currentpwd" id="currpwd" class=" outline-2 focus:bg-white px-3 h-[2.8rem] rounded-md bg-slate-200 w-full" placeholder="Mot de passe" required type="password">
                        <span v-if="AuthPwd_one.check" class="text-sm text-red-600 font-medium ml-2">{{AuthPwd_one.error}}</span>
                    </div>

                    <div class="sm:flex sm:justify-between sm:items-center grid grid-cols-1 gap-3">
                        <!-- Submit Btn -->
                        <button @click="checkform()" type="submit" class="text-white bg-blue-600 mt-2 w-[8rem] hover:bg-blue-700 active:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Enregistrer</button>
                        <!-- For change password -->
                        <span v-on:click="editpage = false" class="text-blue-700 cursor-pointer hover:text-blue-800 active:text-sky-900">Changer le mot de pass ?</span>
                    </div>
                </form>



            </template>

            <!-- Page : Update Password -->
            <template v-else>
                <form @submit.prevent class="mt-5" >
                    <div class=" uppercase font-bold text-lg text-center mb-10">Changer le mot de passe</div>
                    <!-- Password -->
                    <div class="grid grid-cols-1 gap-1">
                        <label class="mb-1 font-semibold px-2" for="email">Mot de passe</label>
                        <input
                        @input="checkinpute"
                        :class="user.pwd.check?'outline-blue-500':'outline-red-500'"
                        v-model="user.pwd.text" title="pwd" id="email" class=" outline-2 focus:bg-white px-3 h-[2.8rem] rounded-md bg-slate-200 w-full" placeholder="Mot de passe" required type="password">
                        <span v-if="!user.pwd.check" class=" text-orange-600 ml-2">{{ pwdError }}</span>
                    </div>
                    <!-- Repeate Password -->
                    <div class="grid grid-cols-1 gap-1">
                        <label class="mb-1 font-semibold px-2" for="cin">Répète le mot de pass</label>
                        <input
                        @input="checkinpute"
                        :class="user.pwd.check?'outline-blue-500':'outline-red-500'"
                        v-model="user.rpwd.text" title="rpwd" id="cin" class=" outline-2 focus:bg-white px-3 h-[2.8rem] rounded-md bg-slate-200 w-full" placeholder="Repeter le mot de passs" required type="password">
                        <span v-if="!user.rpwd.check" class=" text-red-600 ml-2">{{ rpwdError }}</span>
                    </div>
                    <!-- Auth Password -->
                    <div class="grid grid-cols-1 gap-1 mt-10 mb-5">
                            <span class="text-gray-400  text-sm mb-1">//Entrez votre mot de passe pour enregistrer les changements</span>
                            <label class="mb-1 font-semibold px-2" for="currpwd">Mot de passe</label>
                            <input
                            ref="inputePwd_two"
                            @input="AuthPwd_two.check = false"
                            :class="AuthPwd_two.check?'outline-red-500':'outline-blue-500'"
                            v-model="AuthPwd_two.text" title="currentpwd" id="currpwd" class=" outline-2 focus:bg-white px-3 h-[2.8rem] rounded-md bg-slate-200 w-full" placeholder="Mot de passe" required type="password">
                            <span v-if="AuthPwd_two.check" class=" text-red-600 ml-2">{{AuthPwd_two.error}}</span>
                    </div>

                    <button @click="checkPwdform()" type="submit" class="text-white bg-blue-600 mt-2 w-[8rem] hover:bg-blue-700 active:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Enregistrer</button>
                
                </form>
            </template>

        </div>
    </div>

            <div id="Model" class="fixed top-0 w-full hidden h-full z-40 place-content-center rounded-md">
                    <div class="absolute bg-slate-300 w-full h-full rounded-md opacity-50 z-10"></div>

                        <div class=" lg:w-[40rem] sm:w-[32rem] w-[25rem] pb-5 bg-white absolute z-20 translate-y-[-50%] translate-x-[-50%]  md:translate-x-[-70%] top-[50%] left-[50%] grid place-content-center rounded-md ">
                        <form @submit.prevent>
                        <div class="lg:w-[40rem] sm:w-[32rem] w-[25rem] flex justify-between px-5 pt-5 pb-3">
                                <span class="text-gray-400 hover:text-sky-700 cursor-pointer"
                                v-show="FiliereModel == false" @click="FiliereModel = true"><fas size="xl" icon="fa-arrow-left" /></span>
                                <span class="text-gray-400 hover:text-sky-700 cursor-pointer"
                                v-show="FiliereModel == true" @click="FiliereModel = null"><fas size="xl" icon="fa-arrow-left" /></span>
                                <span class="text-gray-400 hover:text-sky-700 cursor-pointer"
                                v-show="FiliereModel == 'Module'" @click="FiliereModel = null"><fas size="xl" icon="fa-arrow-left" /></span>
                                <span></span>
                                <span 
                                class="hover:text-sky-700 text-gray-400 cursor-pointer" 
                                @click="ModelX"><fas size="xl" icon="fa-xmark" /></span>
                            </div>
                            <div class="lg:w-[40rem] sm:w-[32rem] w-[25rem] text-center uppercase text-slate-800 font-bold text-xl py-3">
                                Goupes du Formateur
                            </div>
                            


                            <!-- GroupeModule Model -->
                            <div v-show="FiliereModel == null" class="lg:w-[40rem] flex justify-center items-40nter sm:w-[32rem] w-[25rem] mt-10 mb-14">
                                
                                <div class="w-[90%] px-2 py-3 rounded-md border-2 border-sky-500">
                                <div class="w-full h-[15rem] overflow-y-scroll overflow-x-hidden">

                                    <div class="mb-8 px-5" v-for="(groupe,index) in groupesUser">
                                        <div class="h-10 border-b-2 border-sky-600 text-sky-800 text-base font-bold px-5">
                                            <span class="hover:text-sky-700 mx-2 text-gray-400 cursor-pointer" @click="deletGp(index,groupe.nom_gp)">
                                                <fas size="lg" icon="fa-xmark" />
                                            </span>
                                            {{ groupe.nom_gp }}
                                        </div>
                                        <div class="grid grid-cols-1 text-sm font-semibold gap-2 my-5">
                                            <div v-for="(md,indx) in groupe.modules" >
                                                <div :for="md.id">
                                                    <span class="hover:text-gray-800 mx-2 text-gray-400 cursor-pointer" @click="deletMd(index+'*'+indx)">
                                                        <fas size="lg" icon="fa-xmark" />
                                                    </span>
                                                    {{ md.nom_module }}
                                                </div>
                                            </div>
                                            <button
                                        @click="FilieresModules(index)"
                                        class="text-md font-bold
                                        bg-cyan-400 text-2xl text-white rounded-3xl cursor-pointer
                                        hover:bg-cyan-500 w-12 flex justify-center items-center pb-1">+</button>
                                        </div>
                                        
                                    </div>
                                <div
                                 @click="FiliereModel = true"
                                class=" mt-3 bg-sky-400 hover:bg-sky-500 cursor-pointer test-md font-bold 
                                text-white text-center py-1">Ajouter un groupe</div>

                                </div>
                                </div>
                                
                            </div>



                            <!-- Modules Model -->
                            <div v-show="FiliereModel == 'Module'" class="lg:w-[35rem] flex justify-center items-40nter sm:w-[32rem] w-[25rem] mt-10 mb-14">
                                
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
                                                <div @click="addModuleUser(md.id,md.nom_module)" class="ml-2 cursor-pointer hover:bg-slate-100 py-1 px-2 my-1" :for="md.id">{{ md.nom_module }}</div>
                                            </div>
                                            <div
                                            @click="Model2"
                                            class=" mt-3 bg-sky-400 hover:bg-sky-500 cursor-pointer test-md font-bold text-white text-center py-1">Ajouter un module</div>
                                        </div>
                                        
                                    </div>

                                </div>
                                </div>
                                
                            </div>

                
                            
                            <!-- Filieres Model -->
                            <div v-show="FiliereModel == true" class="lg:w-[35rem] flex justify-center items-40nter sm:w-[32rem] w-[25rem] mt-10 mb-14">
                                
                                <div class="w-[90%] px-2 py-3 rounded-md border-2 border-sky-500">
                                <div class="w-full h-[15rem] overflow-y-scroll overflow-x-hidden">

                                    <div v-for="fil in filieres" :key="fil.id"
                                        @click="getGourpesProf(fil.id)"
                                        class="allLi w-full py-[.8rem] flex items-center justify-center hover:scale-105 ease-in-out duration-100 cursor-pointer text-center text-sm font-semibold">{{fil.nom_fil}}
                                    </div>

                                </div>
                                </div>
                                
                            </div>

                            <div v-show="FiliereModel == true" class="flex justify-between items-center pb-3 px-3 sm:px-5">
                                <span></span>
                                <template v-if="spinloading">
                                    <svg role="status" class="inline w-10 h-10 mr-2 text-transparent animate-spin fill-blue-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                </template>
                                <span></span>
                            </div>
                            

                            <!-- Groupe Model -->
                            <div v-show="FiliereModel == false" class="lg:w-[35rem] flex justify-center items-40nter sm:w-[32rem] w-[25rem] mt-10 mb-14">
                                
                                <div class="w-[90%] px-2 py-3 rounded-md border-2 border-sky-500">
                                    <div class="w-full h-[15rem] overflow-y-scroll overflow-x-hidden">

                                        <div class="mb-8 px-5 w-full">
                                            <div class="h-10 border-b-2 border-sky-600 text-sky-800 text-sm font-bold px-5">{{ listGroupes.nomFil }}</div>
                                            <div class="grid grid-cols-3 text-base font-bold gap-2 my-5 w-full">
                                                <div v-for="gp in listGroupes.groupes" >
                                                    <span>
                                                        <div  @click="addGp(gp.nom_gp)" class="ml-2 hover:bg-slate-100 cursor-pointer" :for="gp.id">{{ gp.nom_gp }}</div>
                                                    </span>
                                                </div>
                                                <div v-if="listGroupes.groupes == 0" 
                                                class="lg:w-[28rem] sm:w-[20rem] w-[15rem] mt-5 text-base font-semibold text-sky-700 text-center">
                                                    Vide
                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                                
                            </div>


                        </form>
                </div>
            </div>

            <div id="Model2" class="fixed top-0 w-full h-full z-40 hidden place-content-center rounded-md">
                <div class="absolute bg-slate-300 w-full h-full rounded-md opacity-50 z-10"></div>

                    <div class=" lg:w-[35rem] sm:w-[28rem] w-[22rem] pb-5 bg-white absolute z-20 translate-y-[-50%] translate-x-[-50%]  md:translate-x-[-70%] top-[50%] left-[50%] grid place-content-center rounded-md ">
                    <form @submit.prevent>
                    <div class="lg:w-[35rem] sm:w-[28rem] w-[22rem] flex justify-between px-5 pt-5 pb-3">
                            <span></span>
                            <span 
                            class="hover:text-sky-700 text-gray-400 cursor-pointer" 
                            @click="Model2"><fas size="xl" icon="fa-xmark" /></span>
                            
                        </div>
                        <div class="lg:w-[35rem] sm:w-[28rem] w-[22rem] text-center uppercase text-slate-800 font-bold text-xl py-3">
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

    import { reactive, onMounted, ref,  onBeforeMount, watch } from "vue"
    import { useRoute } from "vue-router";
    import axios from "axios";
    import { useToast } from "vue-toastification";
    import useFilieres from '../../services/filieres.js'

    const { getFilieres , filieres } = useFilieres();

     onMounted(()=>{
        getFilieres()
    })

    const toast = useToast();

    const editpage = ref(true)
    const route = useRoute()
     const search = ref("")

    const user = reactive({
        id: { value:"", check:true },
        nom : { text:"", check:true, reg: /^[a-z\s]{3,}$/i },
        prenom : { text:"", check:true, reg: /^[a-z\s]{3,}$/i},
        email : { text:"", check:true, reg: /^[\w\.\-]{5,}@[\w\-]+\.[\w]+$/i },
        cin : { text:"", check:true, reg: /^[A-Z]{1,3}[0-9]{4,6}$/i },
        pwd : { text:"", check:true },
        role: { text:"", check:true },
        rpwd : { text:"", check:true },
    })

    const AuthPwd_one = reactive({
        text:"", check:false, error:""
    })
    const inputePwd_one = ref(null)


    const AuthPwd_two = reactive({
        text:"", check:"", error:""
    })
    const inputePwd_two = ref(null)

    const UserId = ref(null)

    const errorContent = ref("")
    const send = ref(false)
    const nameModule = ref("")
    const errorFr = ref(false)
    const nomError = ref("Nom invalide")
    const prenomError = ref("Prenom invalide")
    const emailError = ref("E-mail invalide")
    const cinError = ref("Cin invalide")
    const pwdError = ref("Mot de pass faible 5 caractères au minimum !!")
    const rpwdError = ref("Les mots de passe ne correspondent pas")

    const resetEmailError = ref(false)
    const resetCinError = ref(false)
    const startCheck = ref(false)
    const currentEmail = ref(null)
    const currentCin = ref(null)
    const spinloading = ref(false)
    const GroupeIndex = ref(null)

    const AllgroupesUser = ref([])

    const FiliereModel = ref(null)

    const listGroupes = ref([])

    const modules = ref([])
    const copieModules = ref([])

    const groupesUser = ref([])
    const groupeUserCopie = ref([])

    onBeforeMount(()=>{
        
        getThisUser(route.params.id)

    })

    const checkinpute = (event) => {


            if(event.target.title == "first") user.nom.check = user.nom.reg.test(user.nom.text)

            else if(event.target.title == "last") user.prenom.check = user.prenom.reg.test(user.prenom.text)
            
            else if(event.target.title == "email"){

                resetEmailError.value == true ? emailError.value = "E-mail invalide" : ''

                user.email.check = user.email.reg.test(user.email.text)

            } 
            
            else if(event.target.title == "cin"){

                resetCinError.value == true ? cinError.value = "Cin invalide" : ''

                user.cin.check = user.cin.reg.test(user.cin.text)

            }
            else if(event.target.title == "pwd"){

                if(startCheck.value == true){
                    user.pwd.check = user.pwd.text.length >= 4
                }
                
            }
            
            else if(event.target.title == "rpwd"){

                if(startCheck.value == true){
                    user.rpwd.check = user.pwd.text == user.rpwd.text
                }   

            }


    }

    const Model2 = () => {
        document.getElementById("Model2").classList.toggle('hidden')
    }
    const addModel = async () => {
        let response = await axios.get("/addModule/"+nameModule.value)
        copieModules.value.push(response.data)
        modules.value = copieModules.value
        search.value = ""
        Model2()
    }


    const getUserGroupes = async (userId) => {
        let response = await axios.get("/getUserGroupes/"+userId)
        console.log(response.data)
        groupesUser.value = response.data
        groupeUserCopie.value = response.data 
        groupesUser.value.forEach(groupe => {
            AllgroupesUser.value.push(groupe.nom_gp)
        });
    }

    const deletMd = (indexs) => {
        const index = indexs.split("*")
        groupesUser.value[index[0]].modules.splice(index[1], 1);
    }
    const deletGp = (index,nom) => {
        groupesUser.value.splice(index, 1);
        var index = null
        for(let x in AllgroupesUser.value){
            if(AllgroupesUser.value[x] == nom){
                AllgroupesUser.value.splice(x, 1);
                return
            }
        }
    }

    const addGp = (nom_groupe) =>{

        groupesUser.value.push({nom_gp: nom_groupe, modules:[]})
        FiliereModel.value = null
        AllgroupesUser.value.push(nom_groupe)
    }
    
    const getGourpesProf = async (FiliereId) => {
        
        spinloading.value = true
        let response = await axios.post("/getGroupesProf", { id: FiliereId })
        listGroupes.value = response.data

        checkIfexist()
        FiliereModel.value = false
    }

    const checkIfexist = () => 
    {
        for (let i = 0; i < listGroupes.value.groupes.length; i++)
        {
            if(AllgroupesUser.value.includes(listGroupes.value.groupes[i].nom_gp)){
                listGroupes.value.groupes.splice(i, 1);
                checkIfexist()
            }
        }
        spinloading.value = false
    }

    const addModuleUser = (id,nom) => {
        var  newModule = {id:Number(id), nom_module:nom};
        var boolean = false

        groupesUser.value[GroupeIndex.value].modules.forEach(function(element){
            if(element.id == newModule.id){
                boolean = true
                return
            }
        })

        if(boolean == false){
            groupesUser.value[GroupeIndex.value].modules.push(newModule)
        }

        FiliereModel.value = null
        search.value = ""
    }


    const FilieresModules = async (index) => {
        let response = await axios.get("/getModules")
        modules.value = response.data
        copieModules.value = response.data
        FiliereModel.value = 'Module'
        GroupeIndex.value = index
    }

    const searchModule = () => {

        modules.value = copieModules.value.filter(function(module){
            if(search.value == "")
                return true
            return module.nom_module.toLowerCase().includes(search.value.toLowerCase())
        });
    }
    
    /* Get The User we want to update */
    const getThisUser = async (id) =>{

        let response = await axios.post(`/userById`,{ id : id })
        user.id.value = response.data.user_id
        user.nom.text = response.data.firstname
        user.prenom.text = response.data.lastname
        user.email.text = response.data.email
        user.cin.text = response.data.cin
        user.role.text = response.data.role
        currentCin.value = response.data.cin
        currentEmail.value = response.data.email

        if(response.data.formateur_id != -1){
            getUserGroupes(UserId.value = response.data.formateur_id)
        }
    };


    const checkform = () => {


 
        if(AuthPwd_one.text.length == 0){
            return;
        }

        
       
        
        
        if(user.role.text == "Formateur"){
            errorFr.value = false
            if(groupesUser.value.length == 0){
                errorContent.value = "Sélectionner les groupes et les modules de ce formateur"
                errorFr.value = true
                return
            }else{
                groupesUser.value.forEach(element => {
                    if(element.modules.length == 0){
                        errorContent.value = "Il y a des groupes qui n'ont pas de modules !!"
                        errorFr.value = true
                        return
                    }
                });
            }
            if(errorFr.value){
                return
            }
        }

        for(let e in user){

            if(user[e].check == false){
                send.value = false
                break
            }
            else{  send.value = true }
        }

        
        if(send.value == true){

            editUser()
        }
    }


    const editUser = async () => {

        axios.post(`/editThisUser`,{
            id: user.id.value ,first:user.nom.text,last:user.prenom.text,
            cin: user.cin.text.toLowerCase() == currentCin.value.toLowerCase() ?  null : user.cin.text , 
            email: user.email.text.toLowerCase() == currentEmail.value.toLowerCase() ?  null : user.email.text ,
            password:AuthPwd_one.text,groupes:groupesUser.value,})
        .then((response) => { 

            if(response.data.message !== "user edited successe" ){

                if(response.data.champ == "password"){

                    AuthPwd_one.check = true
                    AuthPwd_one.error = response.data.message
                    inputePwd_one.value.focus()
                }

                else if(response.data.champ == "email"){

                    user.email.check = false
                    emailError.value = response.data.message
                    resetEmailError.value = true
                    
                }else if (response.data.champ == "cin"){

                    user.cin.check = false
                    cinError.value = response.data.message
                    resetCinError.value = true
                }
            }else{
                success(response.data.message)
                AuthPwd_one.text = ""
            }
        })
        .catch((error) => {  Error() });

    }

    /* Change password Form */
    const checkPwdform = () => {

        if(AuthPwd_two.text.length == 0 || user.pwd.text.length == 0 || user.rpwd.text == 0 ){
            return;
        }

        startCheck.value = true

        if(user.pwd.text.length >= 4){
            user.rpwd.check = user.pwd.text == user.rpwd.text
        }else{
            user.pwd.check = user.pwd.text.length >= 4
        }


        if(user.pwd.check == true && user.rpwd.check == true){
            updatePwd()
        }
    }

    const updatePwd = async () => {
        let response = await axios.post(`/updatePwdUser`,
        { id: user.id.value , password : user.pwd.text , authPwd :  AuthPwd_two.text})

         if(response.data.champ == "password"){

                AuthPwd_two.check = true
                AuthPwd_two.error = response.data.message
                inputePwd_two.value.focus()
        }else{
            success(response.data.message)
            user.pwd.text = ""
            user.rpwd.text = ""
            AuthPwd_two.text = ""
        }

    }

    const Model = () => {
        document.getElementById("Model").classList.toggle('hidden')
    }
    const ModelX = () => {
        document.getElementById("Model").classList.toggle('hidden')
        FiliereModel.value = null
    }
    
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