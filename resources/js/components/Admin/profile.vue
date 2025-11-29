

<template>
    <section v-cloak>
        <!-- Profile-informations -->
        <div class="w-full grid grid-cols-1 place-items-center xl:flex justify-around gap-8 py-5">

            <div class="row-start-2 row-end-3 xl:my-10 mx-8 lg:w-[40rem] w-[95%] sm:w-[30rem] bg-gray-100 shadow-lg shadow-gray-300 rounded-md relative">
                <!-- header -->
                <div class="bg-white text-xl px-6 py-8 text-gray-700 font-bold w-full rounded-md">
                    My account
                </div>
                <div class="uppercase px-6 pt-6 text-base text-gray-400 font-bold">
                    user information
                </div>
                <!-- Inputes -->
                <div class="grid grid-cols-1 w-full lg:grid-cols-2 gap-5 pb-12 pt-8 px-10 place-items-start">
                    <label class="w-full">
                        <div class="mb-2 text-sm text-slate-600 font-bold">Nom</div>
                        <input
                        v-on:input="checkinpute"
                        :class="!user.first.check ?'inpute-error':''" title="first" v-model="user.first.text" class="shadow-md rounded-md py-6 px-3 outline-2 outline-cyan-500 shadow-gray-300 w-[100%] lg:w-[16rem] h-[2rem]" placeholder="Nom" type="text">
                        <span class="error_message" v-if="!user.first.check">Nom invalide</span>
                    </label>
                    <label class="w-full">
                        <div class="mb-2 text-sm text-slate-600 font-bold">Prenom</div>
                        <input
                        v-on:input="checkinpute"
                        :class="!user.last.check ?'inpute-error':''" title="last"  v-model="user.last.text" class="shadow-md rounded-md py-6 px-3 outline-2 outline-cyan-500 shadow-gray-300 w-[100%] lg:w-[16rem] h-[2rem]" placeholder="Prenom" type="text">
                        <span class="error_message" v-if="!user.last.check">Prenom invalide</span>
                    </label>
                    <label class="w-full">
                        <div class="mb-2 text-sm text-slate-600 font-bold">CIN</div>
                        <input
                        v-on:input="checkinpute"
                        :class="!user.cin.check ? 'inpute-error':''" title="cin"  v-model="user.cin.text" class="shadow-md rounded-md py-6 px-3 outline-2 outline-cyan-500 shadow-gray-300 w-[100%] lg:w-[16rem] h-[2rem]" placeholder="CIN" type="text">
                        <span class="error_message" v-if="!user.cin.check">{{ cinError }}</span>
                    </label>
                    <label class="w-full">
                        <div class="mb-2 text-sm text-slate-600 font-bold">EMAIL</div>
                        <input
                        v-on:input="checkinpute"
                        :class="!user.email.check ? 'inpute-error':''" title="email" v-model="user.email.text" class="shadow-md rounded-md py-6 px-3 outline-2 outline-cyan-500 shadow-gray-300 w-[100%] lg:w-[16rem] h-[2rem]" placeholder="mail@edu-ofppt.ma"  type="email">
                        <span class="error_message" v-if="!user.email.check">{{ emailError }}</span>
                    </label>
                </div>

                <form @submit.prevent>
                    <!-- Password -->
                    <div class="pt-8 px-5 mb-10">
                        <div class="grid grid-cols-1">
                            <label for="pwd" class="mb-2 text-sm text-slate-600 font-bold">PASSWORD</label>
                            <span class="text-sm text-slate-400">// Entrez le mot de pass pour enregistrer les modifications</span>
                            <input id="pwd" v-model="user.pwd.text" type="password" title="pwd"
                            :disabled = "disablePwd"
                            :class="!user.pwd.check ? 'inpute-error':''"
                            v-on:input="checkinpute"
                            class="shadow-md rounded-md py-6 px-3 outline-2 outline-cyan-500 shadow-gray-300 w-[17rem] h-[1.5rem] mt-5" required>
                            <span class="error_message" v-if="!user.pwd.check" >{{ pwdError}}</span>
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="flex justify-between pb-5 px-3 sm:px-5 items-center">
                        <div
                        @click="Model"
                        class=" hover:text-blue-700 text-sm font-semibold cursor-pointer text-blue-600">Changer votre mot de pass ?</div>
                        <button
                        v-on:click="checkuser()"
                        class="bg-transparent active:bg-blue-500 text-blue-700 font-semibold active:text-white py-2 px-6 border border-blue-500 active:border-transparent rounded">
                            Save
                        </button>
                    </div>
                </form>

            </div>

            <!-- Image Profe -->
            <div class="h-[20rem] w-[15rem] relative row-start-1 row-end-2">
                <div class="h-[5rem] w-full bg-transparent"></div>
                <div class="xl:h-[15rem] h-[10rem] w-full bg-gray-100 shadow-lg shadow-gray-300 rounded-md"></div>
                <div
                v-if="user.image.path"
                v-on:mouseover="show = true"
                v-on:mouseout="show = false"
                class="absolute top-0 left[50%] translate-x-[19%] w-[11rem] h-[11rem] rounded-full">
                    <div class=" w-full h-full rounded-full relative overflow-hidden">
                        
                        <img :src="user.image.path" 
                        @click="$refs.fileInpute.click()" 
                        class="w-full h-full rounded-full bg-black cursor-pointer">
                         

                        <div v-show="show" @click="$refs.fileInpute.click()" class="cursor-pointer absolute w-full h-full top-[70%] z-10">
                            <div class="w-full h-full bg-slate-900 opacity-[0.7]"> </div>
                            <div class="w-[2rem] cursor-pointer absolute top-0 z-40 right-[40%] opacity-[0.5] hover:opacity-[1]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M464 96h-88l-12.38-32.88C356.6 44.38 338.8 32 318.8 32h-125.5c-20 0-38 12.38-45 31.12L136 96H48C21.5 96 0 117.5 0 144v288C0 458.5 21.5 480 48 480h416c26.5 0 48-21.5 48-48v-288C512 117.5 490.5 96 464 96zM356.9 366.8C332.4 398.1 295.7 416 256 416c-31.78 0-61.37-11.94-84.58-32.61l-19.28 19.29C143.2 411.6 128 405.3 128 392.7V316.3c0-5.453 4.359-9.838 9.775-9.99h76.98c12.35 .3027 18.47 15.27 9.654 24.09l-19.27 19.28C219.3 361.4 237.1 368 256 368c24.8 0 47.78-11.22 63.08-30.78c8.172-10.44 23.25-12.28 33.69-4.125S365.1 356.3 356.9 366.8zM384 259.7c0 5.453-4.359 9.838-9.775 9.99h-76.98c-12.35-.3027-18.47-15.27-9.654-24.09l19.27-19.28C292.7 214.6 274.9 208 256 208c-24.8 0-47.78 11.22-63.08 30.78C184.8 249.2 169.7 251.1 159.2 242.9C148.8 234.8 146.9 219.7 155.1 209.2C179.6 177.9 216.3 160 256 160c31.78 0 61.37 11.94 84.58 32.61l19.28-19.29C368.8 164.4 384 170.7 384 183.3V259.7z"/></svg>
                            </div>
                        </div>
                        <input @change="inputeload" class="hidden" ref="fileInpute" type="file"/>



                    </div>
                        <div
                        @click="$refs.fileInpute.click()"
                        v-show="show" 
                        class="hover:opacity-[1] opacity-[0.7] cursor-pointer w-8 h-8 border-2 border-black flex justify-center items-center rounded-full absolute z-30 top-[140px] right-[15px]">
                        <span><fas icon="trash" size="lg" /></span>
                        </div>
                        <button ref="deletBtn" class="hidden" @click="deletprofile()">Delet</button>
                   
                </div>
            </div>

        </div>

    <!-- Model update password -->
    <div id="Model" class="fixed top-0 w-full hidden h-full z-40 place-content-center rounded-md">
        <div class="absolute bg-slate-300 w-full h-full rounded-md opacity-50 z-10"></div>

            <div class=" lg:w-[35rem] sm:w-[28rem] w-[22rem] pb-5 bg-white absolute z-20 translate-y-[-50%] translate-x-[-50%]  md:translate-x-[-70%] top-[50%] left-[50%] grid place-content-center rounded-md ">
            <form @submit.prevent>
                <div class="lg:w-[35rem] sm:w-[28rem] w-[22rem] flex justify-between px-5 pt-5 pb-3">
                    <span></span>
                    <span 
                    class="hover:text-sky-700 text-gray-400 cursor-pointer" 
                    @click="Model"><fas size="xl" icon="fa-xmark" /></span>
                </div>
                <div class="lg:w-[35rem] sm:w-[28rem] w-[22rem] text-center uppercase text-slate-800 font-bold text-xl py-3">
                    Changement de mot de passe
                </div>
                <div class="grid gap-6 px-14 py-8 lg:w-[35rem] sm:w-[28rem] w-[22rem]">
                    <label class="w-full">
                        <div class="mb-2 text-sm text-slate-500 font-semibold">votre mot de passe actuelle</div>
                        <input
                        v-on:input="checkPwdInpute"
                        :class="!UpPwd.curPwd.check ?'inpute-error':''" title="curPwd" v-model="UpPwd.curPwd.text" class="shadow-md rounded-md py-6 px-3 outline-2 outline-neutral-400 shadow-gray-300 w-[100%] h-[2rem]" placeholder="Mot de passe" type="password" required>
                        <span class="error_message" v-if="!UpPwd.curPwd.check">Mot de passe incorecte !</span>
                    </label>
                    <label class="w-full">
                        <div class="mb-2 text-sm text-slate-500 font-semibold">Nouveau mot de passe</div>
                        <input
                        v-on:input="checkPwdInpute"
                        :class="!UpPwd.newPwd.check ?'inpute-error':''" title="newPwd" v-model="UpPwd.newPwd.text" class="shadow-md rounded-md py-6 px-3 outline-2 outline-neutral-400 shadow-gray-300 w-[100%] h-[2rem]" placeholder="Nouveau mot de passe" type="password" required>
                        <span class="error_message" v-if="!UpPwd.newPwd.check">Mot de pass faible 5 caractères au minimum !!</span>
                    </label>
                    <label class="w-full">
                        <div class="mb-2 text-sm text-slate-500 font-semibold">Répéter Nouveau mot depass</div>
                        <input
                        v-on:input="checkPwdInpute"
                        :class="!UpPwd.rePwd.check ?'inpute-error':''" title="rePwd" v-model="UpPwd.rePwd.text" class="shadow-md rounded-md py-6 px-3 outline-2 outline-neutral-400 shadow-gray-300 w-[100%] h-[2rem]" placeholder="Répéter Nouveau mot depass" type="password" required>
                        <span class="error_message" v-if="!UpPwd.rePwd.check">Les mots de passe ne correspondent pas</span>
                    </label>
                </div>
                <div class="flex justify-between items-center pb-3 px-3 sm:px-5">
                    <span></span>
                    <button
                        type="submit"
                        v-on:click="checkPwd()"
                        
                        class="bg-transparent active:bg-blue-500 text-blue-700 font-semibold active:text-white py-2 px-6 border border-blue-500 active:border-transparent rounded">
                            Save
                    </button>
                </div>
            </form>
            </div>
    </div>
        
        
    </section>
</template>

    
    

<script setup>
    import { reactive , onBeforeMount, ref, onMounted, onUpdated } from 'vue';
    import axios from "axios";

    import { useToast } from "vue-toastification";

    const emit = defineEmits(['profile'])
    const toast = useToast();

    const done = ref(false)
    const show = ref(false)
    const input = ref(null)
    const start = ref(false)

    const cinError = ref("Cin invalide")
    const emailError = ref("E-mail invalide")
    const pwdError = ref("")
    const old_user = ref(null)

    const resetEmailError = ref(false)
    const resetCinError = ref(false)
    
    const disablePwd = ref(true)

    const user = reactive({
        id : { value : "", check:true },
        first : { text: "", check: true, reg: /^[a-z\s]{3,}$/i },
        last : { text: "", check: true, reg: /^[a-z\s]{3,}$/i },
        cin : { text: "", check: true, reg: /^[A-Z]{1,3}[0-9]{4,6}$/i },
        email : { text: "", check: true, reg: /^[\w\.\-]{5,}@[\w\-]+\.[\w]+$/i },
        pwd : { text: "", check:true},
        image: { path: "", check:true}
    })

    const UpPwd = reactive({
        curPwd : { text : "", check:true },
        newPwd : { text: "", check: true, reg: /^.{5,}$/i },
        rePwd : { text: "", check: true },
    })

    /* On change inpute file : new image */
    function inputeload(event) {
      
        const data = new FormData()
        data.append('image',event.target.files[0])

        getprofile(data)

    }

    /* Get the Auth User */
    const getuser = async () =>{
        let response = await axios.get(`/authUser`)
        user.id.value = response.data.user_id
        user.first.text = response.data.firstname
        user.last.text = response.data.lastname
        user.email.text = response.data.email
        user.cin.text = response.data.cin
        user.image.path = response.data.image
        old_user.value = response.data
        disablePwd.value = true
    };

    onBeforeMount(() => { getuser() })

    onUpdated(()=>{

        if(nochanges()){
            
            disablePwd.value = true
            user.pwd.text = ""

        }else{
             disablePwd.value = false
        }
    })

    const checkinpute = (event) => {

        if(event.target.title == "first") user.first.check = user.first.reg.test(user.first.text)

        else if(event.target.title == "last") user.last.check = user.last.reg.test(user.last.text)

        else if(event.target.title == "email"){

            resetEmailError.value == true ? emailError.value = "E-mail invalide" : ''

            user.email.check = user.email.reg.test(user.email.text)

            } 
            
        else if(event.target.title == "cin"){

            resetCinError.value == true ? cinError.value = "Cin invalide" : ''

            user.cin.check = user.cin.reg.test(user.cin.text)

        }

        else if(event.target.title == "pwd") user.pwd.text == "" ? '' : user.pwd.check = true

    }

    const nochanges = () => {

        if(old_user.value.firstname == user.first.text && old_user.value.lastname == user.last.text
            && old_user.value.email == user.email.text && old_user.value.cin == user.cin.text){
                
            return true
        }
        return false
    }

    const checkuser = () => {

        if(disablePwd.value){
            return
        }
            

        if(user.pwd.text.length == 0){
            return;
        }

        for(let e in user){
            if(!user[e].check){
                done.value = false
                break
            }else done.value = true }
        if(user.pwd.text == ""){
            done.value = false
            user.pwd.check = false
        }
        if(done.value == true )
            sendData()
    }

    const sendData = async () => {

        let response = await axios.post(`/updateUser`,{ 

            id:user.id.value, firstname: user.first.text,  lastname: user.last.text, password:user.pwd.text,
            email: user.email.text == old_user.value.email ? null : user.email.text,
            cin: user.cin.text == old_user.value.cin ? null : user.cin.text,
        
        })

        if(response.data.message != "update_successed"){

            if(response.data.champ == 'cin'){

            cinError.value = response.data.message
            user.cin.check = false
            resetCinError.value = true


            }else if(response.data.champ == 'email'){

                emailError.value = response.data.message
                user.email.check = false
                resetEmailError.value = true


            }else if(response.data.champ == 'password'){

                pwdError.value = response.data.message
                user.pwd.check = false
            
            }

        }else{
            success(response.data.message)
        }
        
    }

    const updateimage = async () => {
        let response = await axios.get(`/authUser`)
        user.image.path = response.data.image
        emit('profile')
    }

    const getprofile = async (data) =>{
        let response = await axios.post(`/profile`,data)
        updateimage()
        console.log(response.data.status)
    };

    const deletprofile = async () => {
        let response = await axios.get(`/deletPicture`)
        updateimage()
        console.log(response.data.status)
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
        user.pwd.text = ""
        getuser()
    }

    const Model = () => {
        document.getElementById("Model").classList.toggle('hidden')
    }

    const checkPwdInpute = (event) => {
        if(start.value){
            if(event.target.title == "curPwd"){
                UpPwd.curPwd.check = true
            }else if(event.target.title == "newPwd"){
                UpPwd.newPwd.check = UpPwd.newPwd.reg.test(UpPwd.newPwd.text)
            }else if(event.target.title == "rePwd"){
                UpPwd.rePwd.check = UpPwd.rePwd.text ==  UpPwd.newPwd.text
            }
        }
    }

    const checkPwd = () => {

        if(UpPwd.newPwd.text.length == 0 || UpPwd.curPwd.text.length == 0 || UpPwd.rePwd.text.length == 0){
            return
        }

        var testThis = false
        if(UpPwd.newPwd.check = UpPwd.newPwd.reg.test(UpPwd.newPwd.text)){
            UpPwd.rePwd.check = UpPwd.rePwd.text ==  UpPwd.newPwd.text
        }
        
        
        for(let e in  UpPwd){
            if(!UpPwd[e].check){
                testThis = false
                break
            }else testThis = true 
        }

        if(testThis){
            sendPwd(UpPwd.curPwd.text, UpPwd.newPwd.text)
        }else{
            start.value = true
        }
    }

    const sendPwd = async (password, newPassword) => {

        let response = await axios.post("/updatePwdProfile", { password: password, newPassword : newPassword})

        if(response.data.check == false){
            UpPwd.curPwd.check = false
            start.value = true
        }else{
            success("Mot de passe modifieé avec successée")
        }
    }
</script>


<style scoped>
    .inpute-error{
        outline: 2px solid rgba(255, 0, 0, 0.761);
    }
    .error_message{
        color: red;
    }
    profile-div{
        background-image: url('https://source.unsplash.com/random/500x500/?face');
    }

</style>