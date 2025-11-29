

<template>


<div class="grid place-items-center mt-[2rem] scale-75 md:scale-100">

    <div class="bg-white p-5 grid grid-cols-1 gap-4 place-items-center w-[40rem] rounded-sm shadow-md shadow-slate-300" >

        <!-- Choose school year -->
        <template v-if="readyPlates">

            <form 
                class="bg-white p-5 grid grid-cols-1 gap-4 place-items-center w-[40rem] rounded-sm"
                @submit.prevent="sweetalert">
                <div class="uppercase font-bold ">Changer les fichiers excel</div>
                <div class="grid place-items-center gap-5 w-[33rem]">
                    <div class="relative w-full">
                        <span class="font-semibold text-xs ml-2">Entrez la baseplate</span>
                        <input id="custome_inpute" @change="handleBase" required class="form-control
                        w-full text-lg font-normal text-gray-700 border border-solid border-gray-300 rounded
                        focus:text-gray-700 focus:border-blue-600 focus:outline-none px-2 py-1.5" type="file">
                        <span v-if="bwrong" class="absolute top-4 right-5 text-red-500">Wrong baseplate !!</span>
                    </div>
                    <div class="relative w-full">
                        <span class="font-semibold text-xs ml-2">Entrez l'avancement</span>
                        <input id="custome_inpute" required  @change="handleAvant" class="form-control
                        w-full text-lg font-normal text-gray-700 border border-solid border-gray-300 rounded
                        focus:text-gray-700 focus:border-blue-600 focus:outline-none px-2 py-1.5" type="file">
                        <span v-if="awrong" class="absolute top-4 right-5 text-red-500">Wrong avant !!</span>
                    </div>
                </div>
                <button type="submit" class="rounded text-md px-5 py-2.5 mr-2 inline-flex items-center w-[8rem]"
                :class="loading? 'text-white bg-blue-700': 
                'hover:bg-blue-600  text-blue-700 hover:text-white border border-blue-500 hover:border-transparent'">
                    <span v-if="loading">
                        <svg role="status" class="inline w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                    </span>
                    <span v-if="loading" class="text-center">Loading...</span>
                    <div v-if="!loading"  class="text-center w-full">Upload</div>
                </button>
            </form>

        </template>

        <!-- Upload base plates -->
        <template v-else>
            <div class="text-xl font-bold uppercase text-black text-center mb-10">Nouvelle Anneé</div>
            <div  class="flex justify-around w-[40rem] px-[2rem]">
                <span class=" text-xl font-semibold text-blue-700">
                    <fas icon="user-graduate" /> Année scolaire : </span>
                <input v-model="dyear"
                @input="Error = ''"
                class="py-1 w-32 px-2 shadow-md shadow-gray-300 rounded-sm outline-2 outline-sky-700" placeholder="Debut anneé" type="number" min="2021">
                <span class=" text-sky-700"><fas size="lg" icon="fa-arrow-right" /></span>
                <input readonly :value="fyear"
                class="py-1 px-2 w-32 shadow-md shadow-gray-300 rounded-sm outline-2 outline-sky-700" placeholder="Fin anneé" type="number" min="2022">
            </div>
            <div class=" text-md font-semibold text-red-500">{{ Error }}</div>
            <div @click="checkyearinpute" 
            class="text-white rounded-md bg-sky-500 hover:bg-blue-500 active:bg-sky-600 mt-1 cursor-pointer font-bold px-6 py-2 shadow-sm shadow-slate-100">Suivant</div>
        </template>
        
    </div>

    <div class="mt-10 rounded-sm shadow-md shadow-slate-300">
        <form @submit.prevent="downloadExcel" class="bg-white p-5 grid grid-cols-1 gap-4 place-items-center w-[40rem] rounded-sm">
            <div class="uppercase font-bold ">Download Stagiaire Absences</div>

            <select class="p-2 my-3 shadow-md shadow-slate-300 text-sm font-semibold text-slate-700 w-[13rem] outline-2 focus:outline-sky-500 rounded-sm" v-model="etatYear" required>
                    <option class="hidden" :value = null >Choisie l'anneé scolaire</option>
                    <option v-for="year in absysyear" :value=year.year>{{year.year}}</option>
            </select>
                
            <button type="submit" class="text-white rounded-md bg-sky-500 hover:bg-blue-500 active:bg-sky-600 mt-1 cursor-pointer font-bold px-6 py-2 shadow-sm shadow-slate-100">
                    <div class="text-center w-full">Download</div>
            </button>
        </form>
    </div>


</div>     
                    
    
</template>

<script setup>

    import { ref, watch, onMounted } from "vue";
    import axios from "axios";
    import { useToast } from "vue-toastification";
    import {useRouter} from "vue-router"
    const toast = useToast();

    const baseExcel = ref("");
    const readyPlates = ref(false)
    const avantExcel = ref("");
    const awrong = ref(false)
    const dyear = ref()
    const fyear = ref()
    const absysyear = ref([])
    const bwrong = ref(false)
    const loading = ref(false)
    const etatYear = ref(null)
    const Error = ref("")
    const router = useRouter();
    function handleBase(event){ baseExcel.value = event.target.files[0] }

    
    function handleAvant(event){ avantExcel.value = event.target.files[0] }
    

    const checkyearinpute =  () => {
        if(dyear.value != "" && dyear.value > 2020){
            checkyear()
        }
        
    }
    
    onMounted(()=>{
        getAbsysyear()
    })

    const downloadExcel = async () => {
        if(etatYear.value == null){
            warning("choose année scolaire")
            return;
        }
        var year = etatYear.value.split("-")
        year = year[0]+year[1]
        location.href = location.href+'/download/'+year
    }

    const getAbsysyear = async () => {
        let response =  await axios.get('/absysyears')
        absysyear.value = response.data
    }

    watch(() => dyear.value, () => {

        if(dyear.value > 2020){
            fyear.value = dyear.value + 1
        }else{
            fyear.value = ""
        }
    })


    const checkyear = async () => {
        axios.post('/checkNewYear',{debut:dyear.value,fin:dyear.value+1})
        .then((response) => {
            if(response.data.message == true){
            readyPlates.value = true
            }else{
                Error.value = "On a déja une version avec cet année"
            }
        }).catch((e) => {  error(`Something went wrong`)  });

    }


    const sweetalert = () => {

        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: `Une nouvelle anneé va commencer ${dyear.value}-${fyear.value} !`,
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText:"Annuler",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Valider!'
        }).then((result) => {
            if (result.isConfirmed) {
                handleSubmit()
            }
        })
    }

    function handleSubmit(){

        loading.value = true
        storeExcel()
        
    }

    function storeExcel()
    {  
        let data = new FormData();
        data.append('base',baseExcel.value)
        data.append('avant',avantExcel.value)
        data.append('dyear', dyear.value)
        data.append('fyear', fyear.value)

        axios.post('/storeExcel',data)
        .then((response)=>{
            if(response.data.message == "success"){
                loading.value = false
                success("successeful")
                //here type ur shit
                router.go({ path: '/home' })
            }else if(response.data.message == "error"){
                loading.value = false
                warning(response.data.text)
            }
        })
        .catch((erro) => { 
            loading.value = false
            error(`Something went wrong`) 
        })
    }

            
       

    const warning = (message) => {

        toast.warning(message, {
            position: "bottom-right",
            timeout: 3000,
            closeOnClick: true,
            pauseOnFocusLoss: false,
            pauseOnHover: false,
            icon: true,
            hideProgressBar: false,
        });
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
    const error = (message) => {

         toast.error(message, {
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