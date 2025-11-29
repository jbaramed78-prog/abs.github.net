

<template>
<section class="h-auto relative">

    <!-- Dropdowns-Fileres- -->
        <div class=" px-10">
            <div class="w-[100%] lg:flex lg:justify-between">
                <!-- Filieres_Select -->
                <div class="w-full lg:w-[45%] my-12">
                    <select name="filiere" id="filieres_select" v-model="selected" class="w-full font-medium h-[2rem]" v-on:change="getcontents()">
                        <option class="hidden">Filière</option>
                        <option  :value="fil.id" v-for="fil in filieres" :key="fil.id">{{fil.nom_fil}}</option>
                    </select>
                </div>
                <!-- Groupes_select -->
                <div class="w-full lg:w-[45%] my-12">
                    <select name="groupe" v-if="selected != 'choose your class'" class="w-full font-medium h-[2rem]"
                    v-model="selected_gp"
                    v-on:change="getstagiaires(selected_gp)">
                        <option class="hidden">Groupe</option>
                        <option :value="gp.id" v-for="gp in groupes" :key="gp.id">{{gp.nom_gp}}</option>
                    </select>
                </div>
            </div>
        </div>

    <!-- Table -->
        <div v-if="nom_gp != null" class="antialiased text-gray-600 lg:px-[2rem] xl:px-[6rem] py-[3rem]">
            <div class="flex flex-col justify-center">
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-200 w-full">
                    <h2 class="font-semibold text-gray-800">{{nom_gp}}</h2>
                </header>
                <div class="p-3 w-full">
                <div class="overflow-y-scroll h-[23rem]">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Nom</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Prénom</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Absence</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr v-for="st in stagiaires" :key="st.id" >
                                <td class="p-2 whitespace-nowrap">
                                    <div class="font-medium text-gray-800">{{st.nom_st}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{st.prenom_st}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div><input @change="checkStd()" ref="st_inputs"  :name="st.id" value='absent' type="checkbox" class="h-4 w-4"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            </div>
        </div>       

    <!-- Aboute absence -->
        <div v-if="nom_gp != null"
        :class="admin?'lg:grid-cols-4':'lg:grid-cols-3'"
        class="w-full grid grid-cols-1 md:grid-cols-2 place-items-center gap-y-8">
       
            <select v-if="admin"
            v-model="prof_id" name="prof" class="w-[70%] md:w-[15rem] lg:w-[70%] font-medium h-[2rem] shadow-lg shadow-gray-300">
                <option class="hidden" :value="null" selected >Le formateur</option>
                <option :value="prof.id" v-for="prof in profs" :key="prof.id">{{prof.nom_prof}}</option>
            </select>
                <select v-model="duration_id" name="duration_id" class="w-[70%] md:w-[15rem] lg:w-[70%] font-medium h-[2rem] shadow-lg shadow-gray-300">
                    <option class="hidden" :value='null'  selected>La période d'absence</option>
                    <template v-for="duration in durations" :key="duration.id">

                        <option :value="duration.id" >{{duration.title}}</option>

                    </template>
                    
                </select>
            <select  v-model="seance" name="seanceType" class="w-[70%] md:w-[15rem] lg:w-[70%] font-medium h-[2rem] shadow-lg shadow-gray-300">
                <option class="hidden" selected :value="null" >La seance</option>
                <option value='Presentiel' >Présentiel</option>
                <option value="distanciel" >Distanciel</option>
            </select>
            <input @change="getDuration(selected_gp)" v-model="date_abs"   class="w-[70%] md:w-[15rem] lg:w-[70%] font-medium h-[2rem] shadow-lg shadow-gray-300"
            type="date"  name="date_abs" />
        </div>
        
    <!-- Button -->
        <div v-if="nom_gp != null" class="w-full md:pl-[90%] pl-[85%] h-[6rem] flex items-center">
            <button :disabled="submitBtn==false"
            @click="addAbsence(student_ids,prof_id,duration_id,seance,date_abs,reset,errorNet)" 
            :class="submitBtn == true ? 'button-on':'button-off'" 
            class="text-2xl text-white rounded-full w-[3rem] h-[3rem] cursor-pointer" 
            ><fas icon="arrow-right" /></button>
            
        </div>
        
</section>
</template>


<script setup>
    import { useToast } from "vue-toastification";
    import { ref, watch } from 'vue';
    import useFilieres from '../services/filieres.js'
    import { onMounted,onUpdated } from 'vue';
    import axios from 'axios';
    /* some Logic Variables */
    const st_inputs = ref([])
    /* Inputs to send  */

    const seance = ref(null);
    const date_abs = ref(new Date().toISOString().slice(0, 19).split('T')[0])/* return the date of today  */
    const isStdChecked = ref(false)/* return true if a student is selected False if not */
    const duration_id = ref(null);
    const student_ids = ref([]);/* an Array that contain all of the student ids selected */
    const submitBtn = ref(false);
    const toast = useToast();
    
    const durations = ref([])
    window.scrollTo(0, 0)

    async function getDuration(gp){
        let response = await axios.post("/getDurations",{ date : date_abs.value, gp: gp})
        durations.value = response.data;
        duration_id.value = null;
        console.log(durations.value)
    }

    const checkStd = () => {
        isStdChecked.value = false
        student_ids.value = [];
        st_inputs.value.forEach(e => {
            var id = e.name
            if(e.checked ){ isStdChecked.value = true ; student_ids.value.push( Number(id))}   
        });
        buttopCheck()
    }

/* fomateur , seance ,student */
    onUpdated(()=>{
        buttopCheck()
    })

    const buttopCheck = () => {
        submitBtn.value = formCheck()
    }

    const formCheck = () => {
        if(isStdChecked.value == false || seance.value == null ||duration_id.value == null )
        {
            return false;
        }
        if(admin.value && prof_id.value == null)
        {
            return false;
        }
         
        return true;
    }

    const reset = (message) => {
        if(admin.value){
            prof_id.value = null
        }
        seance.value = duration_id.value = null;
        date_abs.value = new Date().toISOString().slice(0, 19).split('T')[0]
        isStdChecked.value = false 
        st_inputs.value.forEach(e => e.checked = false);
        getDuration(selected_gp.value)
        success(message)
    }

    /* Variables Help-us */
    const selected = ref("Filière")
    const selected_gp = ref("Groupe")

    /* Call Api Groupes */
    const getcontents = () =>  { selected_gp.value = "Groupe" , getgroupes(selected.value)}
    /* Return all our functuons and variables from { services/filieres.js } to use here */
    const { getFilieres, prof_id , admin , filieres , profs , getgroupes , groupes , addAbsence ,stagiaires, getstagiaires , nom_gp } = useFilieres();
    /* On Mounted call Aoi Flieres */
    onMounted(()=>{
        getFilieres()

    })

    watch(() => selected_gp.value, () => {
        getDuration(selected_gp.value);
    })

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

    const errorNet = () => {
        toast.error("Something went wrong" , {
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
    button{
        background-color: rgb(0, 143, 255);
        border: 1px solid rgb(0, 143, 255);
    }
    .button-on:hover{
        background-color: rgb(0, 120, 255);
        border: 1px solid rgb(0, 120, 255);
    }
    .button-on:active{
        background-color: rgb(0, 100, 255);
        border: 1px solid rgb(0, 100, 255);
    }
    .button-off{
        opacity: 0.4;
        cursor: default;
    }

</style>
