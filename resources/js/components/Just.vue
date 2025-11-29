
<template>
<section class="h-screen relative">

    <!-- Dropdowns - FIliere - Groupes -->
        <div class=" px-10">
            <div class="w-[100%] lg:flex lg:justify-between">
                <!-- Filieres_Select -->
                <div class="w-full lg:w-[45%] my-12">
                    <select name="filiere" id="filieres_select" v-model="selected" class="w-full font-medium h-[2rem]" v-on:change="getcontents()">
                        <option class="hidden">choose your class</option>
                        <option  :value="fil.id" v-for="fil in filieres" :key="fil.id">{{fil.nom_fil}}</option>
                    </select>
                </div>
                <!-- Groupes_select -->
                <div class="w-full lg:w-[45%] my-12">
                    <select name="groupe" v-if="selected != 'choose your class'" class="w-full font-medium h-[2rem]"
                    v-model="selected_gp"
                    v-on:change="getsts()">
                        <option class="hidden">choose your groupe</option>
                        <option :value="gp.id" v-for="gp in groupes" :key="gp.id">{{gp.nom_gp}}</option>
                    </select>
                </div>
            </div>
        </div>

    <!-- Stagiaire table -->
    <div v-if="close != null" class="antialiased text-gray-600 lg:px-[2rem] xl:px-[6rem] py-[3rem]">
            <div class="flex flex-col justify-center">
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-200 w-full">
                    <h2 class="font-semibold text-gray-800">{{nom_gp}}</h2>
                </header>
                <div class=" w-full">
                <div class="overflow-y-scroll h-[23rem]">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Prenom</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">Nombre d'heures d'absences NJ</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr class=" hover:bg-slate-200 cursor-pointer" v-for="st in stagiaires" :key="st.id"  @click="getJustifTable(st.id)" >
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="font-medium text-gray-800">{{st.nom_st}}</div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{st.prenom_st}}</div>
                                </td>
                                    <td class="p-2 whitespace-nowrap">
                                    <div class="sm:pl-[5rem] pl-[2rem]">
                                       {{ st.Nj+" h" }}
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="stagiaires.length == 0">
                                <th class="h-[10rem] text-center font-semibold text-lg text-sky-800" colspan="3" >Aucune absence pour le justifier</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            </div>
    </div>

    <!-- Justif Table -->
    <div v-if="show_etats == true" class="antialiased text-gray-600 lg:px-[2rem] xl:px-[6rem] py-[3rem]">
            <div class="flex flex-col justify-center">
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b flex justify-between items-center border-gray-200 w-full">
                    <h2 class="font-semibold text-gray-800"><span class="text-gray-400 hover:text-sky-700 cursor-pointer" @click="stepback"><fas size="lg" icon="fa-arrow-left" /></span></h2>
                    <span class="font-semibold text-gray-800 pr-1" >{{nom_gp}}</span>
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
                                    <div class="font-semibold text-left">Prenom</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">date_absence</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Heure debut</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Heure fin</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Formateur</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Seance</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Justifier</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            <tr v-for="(item, index) in list_etats" :key="index">

                                <td class="p-2 whitespace-nowrap">
                                    <div class="font-medium text-gray-800">{{getStName(item.stagiaire_id,true)}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{getStName(item.stagiaire_id,false)}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{item.date_abs}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{item.duration.h_debut}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{item.duration.h_fin}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{item.prof.nom_prof }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{item.seance}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div><input v-on:click="checkStd()" ref="st_inputs" :name="item.id" type="checkbox" class="h-4 w-4"></div>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            </div>
    </div>

    <!-- Motif -->
    <div v-if="show_etats == true"  class="px-8 grid grid-cols-1 sm:flex sm:justify-between sm:items-center md:pr-14 h-28">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <select v-model="selected_motif" class="w-[10rem] h-7 font-medium shadow-lg shadow-gray-300" v-on:change="selected_motif_autre = null">
                <option class="hidden">Motif</option>
                <option>A.....</option>
                <option>B.....</option>
                <option>C.....</option>
                <option value="autre">Autre</option>
            </select>
            <input placeholder="Ecrire Le Motif" class="h-7 px-2 w-[10rem] shadow-lg shadow-gray-300" v-if="selected_motif == 'autre'" type="text" v-model="selected_motif_autre" >
        </div>
    <!-- Button -->
        <div class="grid place-items-end sm:p-5 p-3">
            <button
            :disabled="submitBtn==false"
            v-on:click="addJustifAndReset()" 
            class="text-2xl text-white rounded-full w-[3rem] h-[3rem]"
            :class="submitBtn == true ? 'button-on':'button-off'">
            <fas icon="arrow-right" /></button>
        </div>
    </div>
    
    <!-- Not found -->
<!--     <div v-if="show_error" class="h-screen grid place-content-center top-0 w-full">
        <img class="w-[10rem]" src="./contents/page.png">
    </div> -->

</section>
</template>

<script setup>

    import { ref } from 'vue';
    import useFilieres from '../services/filieres.js'
    import { onMounted, onUpdated} from 'vue';

    /* Variables Help-us */
    const selected = ref("choose your class")
    const close = ref(null)

    const selected_motif = ref("Motif")
    const selected_motif_autre = ref(null)

    const selected_gp = ref("choose your groupe")
    const list_etats = ref(false)
    const show_etats = ref(false)
    const show_error = ref(false)
    var nom_group = ""

    const isStdChecked = ref(false)
    const st_inputs = ref([])
    const student_ids = ref([])
    const submitBtn = ref(false)
    const lista_helper = ref([])
    /* Call Api Groupes */
    const getcontents = () =>  { selected_gp.value = "choose your groupe" , getgroupes(selected.value)}
    /* Return all our functuons and variables from { services/filieres.js } to use here */
    const { getFilieres , filieres , profs , getgroupes , groupes , stagiaires, getstagiaires , nom_gp , addJustif , justif_status } = useFilieres();
    /* On Mounted call Aoi Flieres */
    onMounted(getFilieres())
    const getstContents = () => { 
        getstagiaires(selected_gp.value,true) 
        list_etats.value = false ,show_error.value = false 
    }
    /* This function hide stagiaires table and show Justif table */
    window.scrollTo(0, 0)
    const id_st = ref(0)
    const getJustifTable = (id) => {
        var list = []
        id_st.value = id

        close.value = true
        show_etats.value = true
        stagiaires.value.forEach(st => {
            if(st.id == id) {
                list_etats.value = st.etat
                return true
        }})
        close.value = null

        if(Object.keys(list_etats.value).length === 0){
            /* show_error.value = true */
        }
    }

    const  stepback =  () => {
        show_etats.value = false
        close.value = true
        getsts()
/*         nom_gp.value = nom_group */
       /*  nom_gp.value = null */
    }

    const getsts = async () => {
        
        let result = await getstagiaires(selected_gp.value,true)
        show_etats.value = false
        close.value = true
    }

    onUpdated(()=>{
        buttopCheck()
    })

    const buttopCheck = () => {
        submitBtn.value = formCheck()
    }

    const formCheck = () => {
        if(selected_motif.value == "Motif" || isStdChecked.value == false || selected_motif.value == "autre"){
            if(selected_motif_autre.value == null || selected_motif_autre.value == "") return false
        }
        return true;
    }

    const addJustifAndReset = () => {
        addJustif(student_ids.value,selected_motif.value,selected_motif_autre.value,reset)
    }

    const reset = () => {

            selected_motif.value = "Motif"
            selected_motif_autre.value = null

            show_error.value =false

            isStdChecked.value =false
            
            submitBtn.value =false
            
            lista_helper.value = []
            for(let e in list_etats.value){

                if(!student_ids.value.includes(list_etats.value[e].id)){
                    lista_helper.value.push(list_etats.value[e])
                }
            }



            list_etats.value = lista_helper.value
            student_ids.value =[]

            st_inputs.value.forEach(element => {
                element.checked = false
            });


    }
    
    
    const checkStd = () => {
        isStdChecked.value = false;
        student_ids.value = [];
        st_inputs.value.forEach(e => {
            var id = e.name
            if(e.checked ){ isStdChecked.value = true ; student_ids.value.push( Number(id))}
        });
        buttopCheck()
    }
    
    /* Return name of teacher by id */
    const getProfName = (id) => {
        var name = null
        profs.value.forEach(e => {
            if(e.id == id) name = e.nom_prof })  
        return name
    }
    /* Return firstname or lastname of trainee by id */
    const getStName= (id,nom) => {
        var result = null
        stagiaires.value.forEach(e => {
            if(e.id == id){
                nom ? result = e.nom_st : result = e.prenom_st
                return true}
        })  
        return result
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