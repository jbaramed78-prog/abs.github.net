<template>
 
    <div class="w-full lg:w-[45%] my-12">
        <select   class="w-full font-medium h-[2rem]" @change="changeFil"  v-model="selectedFil" >
            <option    value="all" selected>Tous les Filieres</option>
            <option  :value="fil.id" v-for="(fil,index) in allFilWithGroupes" :key="fil.id">{{fil.nom_fil}}</option>
        </select>
    </div>



    <nav v-if="selectedFil != 'all'" class="w-full bg-white px-4 py-5">
        <div class="grid-cols-3 bg-slate-100 lg:scale-100 scale-75 rounded-lg grid sm:grid-cols-5 border-4 border-slate-100">
            <a
            v-for="gp in currentGroupe"
            :title="gp.id"
            @click="changeGp" 
            class="p-5 cursor-pointer bg-slate-100 text-center border-b-4 border-transparent" :key="gp.id">{{ gp.nom_gp }}</a>
        </div>
    </nav>




    <div v-if="true" class="relative sm:p-5 scale-75 overflow-x-auto shadow-md sm:scale-90 lg:scale-100 s">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-sky-600">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="text-center">Nom</div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="text-center">Date</div>
                        
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="text-center">Formateur</div>
                        
                    </th>
                    <th  scope="col" class="px-6 py-3">
                        <div class="text-center">Durée</div>
            
                    </th>
                    <th  scope="col" class="px-6 py-3">
                        <div class="text-center">Type</div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="text-center">Etat</div>
                        
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="text-center">Motif</div>
                        
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="text-center">Edit</div>
                       
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="text-center">Delet</div>
                        
                    </th>
                </tr>
            </thead>

            <tbody>
                
                <tr ref="absenceRefs"  class="bg-white border-b select-none"
                :class="index == currentEtat ?'text-black':'' "
                v-for="(abs,index) in currentEtatList" :key="index" >

                    <td class="p-4">
                        <div class="scale-75 w-full">
                            {{ abs.stagiaire.nom_st +" " + abs.stagiaire.prenom_st }}
                        </div>             
                    </td>

                    <td class="p-4" >
                        <div class="scale-90 w-full">
                            <input class="w-full font-medium h-[2rem] shadow-sm shadow-gray-300" ref="date_abs" 
                            :disabled="(index == currentEtat)? false:true" type="date" :value="abs.date_abs"
                            >                   
                        </div> 
                    </td>

                    <td class="p-4">
                        <div class="scale-90">
                            <select class="w-full font-medium h-[2rem] shadow-sm shadow-gray-300" ref="prof" :disabled="(index == currentEtat)? false:true"  >
                                <option  :value=" abs.prof_id" selected>{{ abs.prof.nom_prof }}</option>
                                <option v-show="prof.id != abs.prof_id " :value="prof.id" v-for="prof in currentProfs" :key="prof.id">{{prof.nom_prof}}</option>
                            </select>
                        </div>
                                    
                    </td>


                    <td class="px-6 py-4 text-left font-medium">
                        <div class="w-32 scale-90">
                            <select ref="duration" :disabled="(index == currentEtat)? false:true"
                            name="absenceDuration" class="w-full font-medium h-[2rem] shadow-sm shadow-gray-300">
                            <option   :value="abs.duration_id"  >{{abs.duration.title}}</option>
                            <option :value="duration.id"  v-show="duration.id != abs.duration_id"
                            v-for="duration in allDurations" :key="duration.id"
                            >{{duration.title}}</option>
                        </select>
                        </div>
                        
                    </td>

                    <td class="px-6 py-4 text-left font-medium">
                        <select class="w-28 scale-90  font-medium h-[2rem] shadow-sm shadow-gray-300" ref="seance" :disabled="(index == currentEtat)? false:true"  >
                            <option  class="hidden" selected>{{ abs.seance }}</option>
                            <option value='Presentiel' >Presentiel</option>
                            <option value="distanciel" >Distanciel</option>>
                        </select>
                    </td>


                    <td class="px-6 py-4 text-left font-medium">
                        <select ref="etat_jusitf"
                        class="w-16 scale-75 font-medium h-[2rem] shadow-sm shadow-gray-300"
                        @change="editMotif(index)"
                        :disabled="(index == currentEtat)? false:true"  >
                            <option class="hidden" selected>{{ abs.etat_justif }}</option>
                            <option value='NJ' >NJ</option>
                            <option value="J" >J</option>>
                        </select>
                    </td>


                    <td class="px-6 py-4 text-left font-medium">
                        <input ref="motif"
                        :disabled="abs.etat_justif == 'NJ'" 
                        class="w-full font-medium h-[2rem] shadow-sm shadow-gray-300 bg-transparent px-2 focus:outline-cyan-500" type="text"
                        :value="abs.motif" size="6">
                    </td>

                    <td>
                        <div class="grid grid-cols-1 place-items-center gap-2">

                            <button ref="saveBtn"  class="hidden  cursor-pointer text-green-600 hover:underline " @click="updateEtat(abs.id,index)">Save</button>

                            <button ref="editBtn"    class="w-8 cursor-pointer text-blue-600 hover:underline"
                            @click="getInfo(abs.stagiaire.groupe_id,abs.id,index)">Edit</button>

                        </div>

                    </td>

                    <td class="px-6 py-4 text-left font-medium">
                       <div class="text-red-500 cursor-pointer opacity-[0.7] hover:opacity-[1] hover:scale-110 max-w-max max-h-max">
                                <button @click="deleteEtatBox(abs.id,index)" class=" absolute w-[1.5rem] h-[1.5rem] opacity-0"></button>
                                    <svg ref="deleteBtn" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                        </div>
                    </td>

                </tr>

            </tbody>

        </table>
    </div>

    <template v-if="currentEtatList == null">
        <div class="w-full  flex justify-center items-center h-[17rem]">
            <svg role="status" class="inline w-14 h-14 mr-2 text-transparent animate-spin fill-blue-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
        </div>
    </template>

    
</template>



<script setup>
    import axios from 'axios';
    import {onMounted, ref} from "vue";
    import { useToast } from "vue-toastification";

    const toast = useToast();
    const selectedFil = ref("all")
    /*Start raw data */
    const allFilWithGroupes = ref([])
    const allGroupes = ref([])
    const data = ref([])
    const allAbs = ref([])
    const allDurations = ref([])
    /* End raw data */

    const currentEtatList = ref(null)
    const selectedGroupe = ref("none")
    const currentGroupe = ref([])
    const fillWithAbs =ref([])
    const currentStList = ref([]);
    const currentProfs = ref([])
    const currentEtat = ref(null)


    const absenceRefs = ref([])
    
    const wait = ref(false)
   
    const date_abs = ref([]);
    const prof=ref([]);
    const duration = ref([])
    const seance = ref([]);
    const etat_jusitf = ref([]);
    const motif = ref([]);
    
    const currentAbsInfo =ref({
        id:null,
        prof_id:null,
        duration_id:null,
        date_abs:null,
        seance:null,
        etat_justif:null,
        motif:null

    })
     

    const saveBtn = ref([])
    const editBtn =ref([]);
    const deleteBtn= ref([]);
    /* current Edit */
    
    onMounted(()=>{
        getData()
        
        
    })
    function editMotif(index){
        
        var etat_j = etat_jusitf.value[index]
        var moti = motif.value[index]
        console.log(etat_j.value)
        if(etat_j.value == "NJ"){
            moti.disabled = true
            moti.value = "---"
        }else{
             moti.disabled = false
             moti.value = currentAbsInfo.value.motif
        }
    }
    function updateEtat(abs_id,index){
        
       

        
       
        if(
            date_abs.value[index].value != currentAbsInfo.value.date_abs||
             prof.value[index].value!=currentAbsInfo.value.prof_id||
             duration.value[index].value != currentAbsInfo.value.duration_id||
             seance.value[index].value !=currentAbsInfo.value.seance||
             etat_jusitf.value[index].value != currentAbsInfo.value.etat_justif||
             motif.value[index].value != currentAbsInfo.value.motif   
            ){
                console.log("something has Changed")
                if(motif.value[index].value){
                    allAbs.value[index].motif = motif.value[index].value
                }
                if(date_abs.value[index].value == ""){
                    Swal.fire("You need to select a Proper Date For the Request to be sent ")
                }
                else if( etat_jusitf.value[index].value == "J" && motif.value[index].value==""){
                      
                        Swal.fire("You need to type a Motif")
                }else{
                    sendUpdateRequest(abs_id,
                 prof.value[index].value,duration.value[index].value,
                 date_abs.value[index].value,seance.value[index].value,
                 etat_jusitf.value[index].value,motif.value[index].value,currentAbsInfo.value.duration_id)

                  reset(index)
                }
               
                 
                
            }else{
                console.log("no changes")
                reset(index)

            }
             
    }

    function reset(index){
        editBtn.value.forEach((ele)=>{
            
                ele.disabled = false
            
            })
                    saveBtn.value.forEach((ele)=>{
                        ele.disabled = false
                    })

                    motif.value.forEach((ele)=>{
                        ele.disabled = true
                    })
                    editBtn.value[index].classList.toggle("hidden")
                    saveBtn.value[index].classList.toggle("hidden")
            
                    currentEtat.value = null
    }
        
    async function sendUpdateRequest(abs_id,prof_id,duration_id,date_abs,seance,etat_justif,motif,last_duration_id){
       axios.post("/updateEtat",
        { id:abs_id,
        prof_id:prof_id,
        duration_id:duration_id,
        date_abs:date_abs,
        seance:seance,
        etat_justif:etat_justif,
        motif:motif,
        last_duration_id:last_duration_id
        }).then((response) => {}).catch((e) => { Error() })
    
    }
    async function getData(){

        let response = await axios("/etatFil");

        data.value = response.data
        allFilWithGroupes.value = data.value.allFilWithGroupes
        fillWithAbs.value = data.value.fillWithAbs
        allGroupes.value = data.value.allGroupes
        allAbs.value = data.value.allAbs
        currentEtatList.value = allAbs.value
        allDurations.value = data.value.allDurations
        // gpSelect()
    }
   async function getInfo(groupe_id,abs_id,index){
        
        var etat_j = etat_jusitf.value[index]
        var moti = motif.value[index]

        if(etat_j.value == "NJ"){
            moti.disabled = true
        }else{
            moti.disabled = false
        }  


        editBtn.value.forEach((ele,ind)=>{
            if(index!=ind){
                ele.disabled = true
            }
            
        })
        saveBtn.value.forEach((ele,ind)=>{
            if(index != ind){
                ele.disabled = true
            }
        })

        editBtn.value[index].classList.toggle("hidden")
        saveBtn.value[index].classList.toggle("hidden")

        
        if(currentEtat.value != index){
            currentEtat.value = index
            await axios.post("/getSome",{
                "groupe_id":groupe_id,
                "abs_id":abs_id
            }).then((response)=>{

                currentStList.value  = response.data.Stagiaires
                currentProfs.value = response.data.Profs
                currentAbsInfo.value.id=abs_id
                
                currentAbsInfo.value.prof_id = prof.value[index].value
                currentAbsInfo.value.duration_id = duration.value[index].value
                currentAbsInfo.value.date_abs = date_abs.value[index].value
                currentAbsInfo.value.seance = seance.value[index].value
                currentAbsInfo.value.etat_justif = etat_jusitf.value[index].value
                currentAbsInfo.value.motif = motif.value[index].value
            })
        }else{
            console.log("you can' send a Request ")
        }
        
       
    }

    async function deleteEtat(abs_id,index){
       await axios.post("/deleteEtat",{
            id:abs_id
        }).then((response)=>{
                    absenceRefs.value[index].style.display = "none"
                if(currentEtat.value == index){
                    editBtn.value.forEach((ele)=>{
                    
                        ele.disabled = false
                    })
                    saveBtn.value.forEach((ele,ind)=>{
                  
                        ele.disabled = false
                    
                })

                }
        }).catch(error=>{
            Error()
        })
        
        
        
        
        
    }

    function changeFil(){
        selectedGroupe.value = "none"
        if(selectedFil.value != "all"){
            currentGroupe.value =  allFilWithGroupes.value[selectedFil.value-1].groupes
             currentEtatList.value = allAbs.value.filter((ele)=>{
                return ele.stagiaire.groupe.filiere_id == selectedFil.value
            })
        }else{
           
        }
    }

    function changeGp(event){
        
        document.querySelectorAll("a").forEach(element => {
            element.classList.remove("activeLink")
        });
        event.target.classList.add("activeLink")
        
        currentEtatList.value = allAbs.value.filter((ele)=>{
        return ele.stagiaire.groupe_id == event.target.title
        })
    }
    const errorNet = () => {
        toast.error("Error network" , {
            position: "bottom-right",
            timeout: 3000,
            closeOnClick: true,
            pauseOnFocusLoss: false,
            pauseOnHover: false,
            icon: true,
            hideProgressBar: false,
        });
    }
    const callusers = () =>{
        if (wait.value) {
            return;
        }

        errorNet()
        wait.value  = true;

        setTimeout(function() {
            wait.value = false;
        }, 3000);
    }
    /* Alert to confirme for delete user */
    const deleteEtatBox = (abs_id,index) => {
        if(navigator.onLine ==false){
           callusers()
        }else{
            Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vou ne pourrez pas revenir en arriére!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText:"Annuler",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Supprimer!'
        }).then((result) => {

            if (result.isConfirmed) {
                
               deleteEtat(abs_id,index)
                
                Swal.fire(
                'Suprimé!',
                'Le compte a été supprimé.',
                'success'
                )
            }
            
        })
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

<style scoped>
    .activeLink{
        border-color: rgb(8, 91, 255);
        transition: all .8s ease 0s;
    }
    *{
        box-sizing: border-box;
    }

    .swal2-popup {
    font-size: 1.6rem !important;
    font-family: Georgia, serif;
}
    

</style>

