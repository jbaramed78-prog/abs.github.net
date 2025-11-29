

<template>
<section class="xl:pt-0 pb-16 pt-10">

    <div class="grid place-content-center mt-5 w-full">

        <div class="bg-white xl:w-[45rem] lg:w-[38rem] md:w-[29rem] w-[85vw] sm:[23rem] px-5 py-10 rounded-lg shadow-md shadow-slate-300">

            <div class=" uppercase text-center mb-8  font-semibold text-lg">Ajouter un stagiaire</div>

            <!-- Add User Form -->
            <form  @submit.prevent >
                <!-- Matricule -->
                <div class="relative z-0 w-full mb-8 group">
                    <input
                    :class="newUser.mat.check? 'focus:border-blue-600' : 'focus:border-red-600'"
                    @input="checkinpute" title="mat" v-model="newUser.mat.text" type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-400 appearance-none -blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                    <label
                    :class="newUser.mat.check?'peer-focus:text-blue-600':'peer-focus:text-red-600'"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Matricule</label>
                    <span v-if="!newUser.mat.check" class=" text-red-600">{{ matError }}</span>
                </div>
                <div class="grid xl:grid-cols-2 xl:gap-6">
                    <!-- Firstname -->
                    <div class="relative z-0 w-full mb-8 group">
                        <input
                        :class="newUser.nom.check? 'focus:border-blue-600' : 'focus:border-red-600'"
                        @input="checkinpute" title="first" v-model="newUser.nom.text" type="text" name="floating_first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-400 appearance-none focus:outline-none focus:ring-0 peer" placeholder=" " required>
                        <label
                        :class="newUser.nom.check?'peer-focus:text-blue-600':'peer-focus:text-red-600'"
                        for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nom</label>
                        <span v-if="!newUser.nom.check" class=" text-red-600">{{ nomError }}</span>
                    </div>
                    <!-- Lastname -->
                    <div class="relative z-0 w-full mb-8 group">
                        <input
                        :class="newUser.prenom.check? 'focus:border-blue-600' : 'focus:border-red-600'"
                        @input="checkinpute" title="last" v-model="newUser.prenom.text" type="text" name="floating_last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-400 appearance-none -blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                        <label
                        :class="newUser.prenom.check?'peer-focus:text-blue-600':'peer-focus:text-red-600'" 
                        for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Prénom</label>
                        <span v-if="!newUser.prenom.check" class=" text-red-600">{{ prenomError }}</span>
                    </div>
                </div>
                
                <!-- Numero -->
                <div class="relative z-0 w-full mb-8 group">
                    <input
                    :class="newUser.num.check? 'focus:border-blue-600' : 'focus:border-red-600'" 
                    @input="checkinpute" title="num" v-model="newUser.num.text" type="text" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-400 appearance-none -blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                    <label
                    :class="newUser.num.check?'peer-focus:text-blue-600':'peer-focus:text-red-600'"
                    for="num" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-1 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Numero Personnelle</label>
                    <span v-if="!newUser.num.check" class=" text-red-600">{{ numError }}</span>
                </div>

                <div @click="gpFieldErr = false" id="groupesDropdown" class="relative w-full mb-8 group z-20">
                   <div class="relative w-full mb-8 group ">
                        <div @click="dropdownFil = !dropdownFil" 
                        class="dropdown-head border-b-2"
                        :class="gpFieldErr ? 'border-red-600':'border-gray-400'"
                        >
                            <span>{{newUser.fil.text}}</span>
                            <fas v-if="!dropdownFil" icon="angle-down" />
                            <fas v-if="dropdownFil" icon="angle-up" />
                        </div>
                        <div class="relative">
                            <ul v-show="dropdownFil" class="dropdown-body h-[10rem] overflow-y-auto">
                                <li 
                                @click="handleDropFil" 
                                :value="fil.id" v-for="fil in filieres" :key="fil.id">{{fil.nom_fil}}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div @click="gpFieldErr = false" v-show="newUser.fil.text != 'choose your class'"  class="relative w-full mb-8 group z-10">
                   <div class="relative w-full mb-8 group z-10">
                        <div @click="dropdownGp = !dropdownGp" 
                        class="dropdown-head border-b-2"
                        :class="gpFieldErr ? 'border-red-600':'border-gray-400'"
                        >
                            <span>{{newUser.gp.text}}</span>
                            <fas v-if="!dropdownGp" icon="angle-down" />
                            <fas v-if="dropdownGp" icon="angle-up" />
                        </div>
                        <div class="relative">
                            <ul v-show="dropdownGp" class="dropdown-body h-[8rem] overflow-y-auto">
                                <li 
                                @click="handleDropGp" 
                                :value="gp.id" v-for="gp in groupes" :key="gp.id">{{gp.nom_gp}}</li>
                            </ul>
                        </div>
                    </div>
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
                    <span v-if="AuthPwd.check" class=" text-red-600"> {{ AuthPwd.error }} </span>
                </div>
            <!-- Submit btn -->
            <button @click="checkform()" type="submit" class="text-white bg-blue-600 mt-2 w-[6rem] hover:bg-blue-700 active:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Créer</button>
            </form>

        </div>
    </div>

</section>
</template>

<script setup>

    import { reactive, ref, onMounted } from "vue"
    import axios from "axios";
    import { useToast } from "vue-toastification";
    import useFilieres from '../../services/filieres.js'
    const toast = useToast();
    const dropdownFil = ref(false)
    const dropdownGp = ref(false)

    //new User Object
    const newUser = reactive({
        nom : { text:"", check:true, reg: /^[a-z\s]{3,}$/i },
        prenom : { text:"", check:true, reg: /^[a-z\s]{3,}$/i},
        mat : { text:"", check:true, reg: /^[\d\\]{6,}$/i },
        num : { text:"", check:true, reg: /^[0-9]{10}$/i },
        fil : { text:"choose your class", check:true },
        gp : { text:"choose your groupe", check:true, value:null }
    })

    const AuthPwd = reactive({
        text:"", check:false, error:""
    })


    const nomError = ref("Nom invalide")
    const prenomError = ref("Prenom invalide")
    const matError = ref("Matricule invalide")
    const numError = ref("Numero invalide")
    const gpFieldErr = ref(false)

    const resetmatError = ref(false)

    // after submit we start checking on-inpute event
    const start = ref(false)


    //true if everything good and false if not
    const send = ref(false)

    onMounted(()=>{
        getFilieres()
    })
    const { getFilieres , filieres , getgroupes , groupes } = useFilieres();


    /* On click we check our form */
    const checkform = () => {

        //si les champs vide
        if(AuthPwd.text == ""){
            return;
        }
        for(let e in newUser){ if(newUser[e].text == ""){ return; } }
        if(newUser.gp.value == null){
            gpFieldErr.value = true
            return
        }
        
        newUser.nom.check = newUser.nom.reg.test(newUser.nom.text)
        newUser.prenom.check = newUser.prenom.reg.test(newUser.prenom.text)
        newUser.mat.check = newUser.mat.reg.test(newUser.mat.text)
        newUser.num.check = newUser.num.reg.test(newUser.num.text)

        start.value = true

        checkuser()
    }

    /* On inpute we check this out */
    const checkinpute = (event) => {

        if(start.value){
            if(event.target.title == "first") newUser.nom.check = newUser.nom.reg.test(newUser.nom.text)

            else if(event.target.title == "last") newUser.prenom.check = newUser.prenom.reg.test(newUser.prenom.text)
            
            else if(event.target.title == "mat"){

                resetmatError.value == true ? matError.value = "Matricule invalide" : ''
                newUser.mat.check = newUser.mat.reg.test(newUser.mat.text)
            } 
            
            else if(event.target.title == "num") newUser.num.check = newUser.num.reg.test(newUser.num.text)

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

    /* Add new user */
    const addUser = async () =>
    {
        let response = await axios.post(`/addNewStag`,{
            first:newUser.nom.text,last:newUser.prenom.text,
            num:newUser.num.text, mat:newUser.mat.text,
            gp:newUser.gp.value, curpwd:AuthPwd.text
            
        })

        console.log(response.data.message)


        if(response.data.message !== "stagiaire added successe" ){
            if(response.data.champ == "mat"){

                newUser.mat.check = false
                matError.value = response.data.message
                resetmatError.value = true
                
            }else if (response.data.champ == "password"){
                
                AuthPwd.check = true
                AuthPwd.error = response.data.message
            }

        }else{
            success(response.data.message)
            resetInputes()
        }
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
        newUser.gp.text= "choose your class"
        newUser.fil.text= "choose your groupe"
        newUser.gp.value = null
        AuthPwd.text = ""
    }

    const handleDropFil = (event) => {
        dropdownFil.value = false
        newUser.fil.text = event.target.innerHTML
        newUser.gp.text = "choose your groupe"
        getgroupes(event.target.value)
    }
    const handleDropGp = (event) => {
        dropdownGp.value = false
        newUser.gp.text = event.target.innerHTML
        newUser.gp.value = event.target.value
    }


</script>
