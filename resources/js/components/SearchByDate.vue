

<template>

    <section>

        <!-- Filieres_Select -->
        <div class=" px-10">
                <div class="w-[100%] lg:flex lg:justify-between">
                    <div class="w-full lg:w-[45%] my-12">
                        <select name="filiere" id="filieres_select" v-model="selected_fil" class="w-full font-medium h-[2rem]"
                        @change="getcontents()">
                            <option value="Tous" selected>Tous Filieres</option>
                            <option  :value="fil.id" v-for="fil in filieres" :key="fil.id">{{fil.nom_fil}}</option>
                        </select>            
                    </div>
                </div>
        </div>

        <!-- Period_Select -->
        <div class="w-full px-10 grid grid-cols-1 gap-6 lg:flex md:justify-between">
            <select v-on:change="periodChanged" class=" w-full sm:w-[50%] md:w-[15rem] h-7" v-model="selected_period">
                <option value="year" selected>L'annee entiere</option>
                <option value="week">Cette semaine</option>
                <option value="subweek">La semain precedent</option>
                <option value="month">Ce mois</option>
                <option value="submonth">Le mois precedent</option>
                <option value="limit">Limitation</option>
            </select>
            <div v-if="selected_period == 'limit'" class="sm:w-[28rem] w-[100%] place-items-center gap-4 grid grid-cols-1 sm:flex justify-between items-center">
                <input @change="inputeDate" v-model="period_debut" class="sm:w-[12rem] w-[60%] px-2" type="date" required>
                <fas class="hidden sm:block" icon="angles-right"/><fas class="block sm:hidden" icon="angles-down"/>
                <input @change="inputeDate" v-model="period_fin" class="sm:w-[12rem] w-[60%] px-2" type="date" required>
            </div>
        </div>

        <!-- Groupe_Select -->
        <nav v-if="groupes != null && etats != null" class="w-full bg-white px-4 py-5 mt-6">
            <div class="grid-cols-3 bg-slate-100 lg:scale-100 scale-75 rounded-lg grid sm:grid-cols-5 border-4 border-slate-100">
                <a
                v-for="gp in groupes"
                :title="gp.id"
                @click="changeGp" 
                class="p-5 cursor-pointer bg-slate-100 text-center border-b-4 border-transparent" :key="gp.id">{{ gp.nom_gp }}</a>
            </div>
        </nav>

        <!-- Les Heures -->
        <div class="sm:flex sm:justify-center px-10 sm:px-0 mt-10 lg:scale-100 md:scale-90 sm:scale-75 gap-5 place-content-center grid grid-cols-1 scale-90">
            <a
                @click="activeHoure = 'NJ'"
                class="px-6 py-2.5 text-white sm:w-auto w-[100%]  font-medium text-xs uppercase rounded flex select-none
                items-center whitespace-nowrap  cursor-pointer active:bg-blue-800 active:shadow-lg"
                :class="activeHoure == 'NJ'?'bg-blue-800 shadow-lg':'bg-blue-600 shadow-md hover:bg-blue-700'"
                >
                Les Heures non justifier
            </a>
            <a
                @click="activeHoure = 'TT'"
                class="px-6 py-2.5 text-white sm:w-auto w-[100%]  font-medium text-xs uppercase rounded flex select-none
                items-center whitespace-nowrap  cursor-pointer active:bg-blue-800 active:shadow-lg sm:mx-2 lg:mx-8"
                :class="activeHoure == 'TT'?'bg-blue-800 shadow-lg':'bg-blue-600 shadow-md hover:bg-blue-700'"
                >
                Tous les Heures
            </a>
            <a
                @click="activeHoure = 'J'"
                class="px-6 py-2.5 sm:w-auto w-[100%] text-white font-medium text-xs uppercase rounded flex select-none
                items-center whitespace-nowrap cursor-pointer active:bg-blue-800 active:shadow-lg"
                :class="activeHoure == 'J'?'bg-blue-800 shadow-lg':'bg-blue-600 shadow-md hover:bg-blue-700'"
                >
                Les Heures justifier
            </a>
        </div>

        <!-- Table Etats -->
        <div v-if="etats != null" class="relative mt-7 sm:mt-0 sm:p-5 scale-x-75 overflow-x-auto shadow-md sm:scale-x-90 lg:scale-x-100">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-white uppercase bg-cyan-500">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="text-center">Nom</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="text-center">Date</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="text-center">Debut</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="text-center">Fin</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="text-center">Formateur</div>
                        </th>
                        <th>
                            <div class="text-center">Groupe</div>
                        </th>
                        <th  scope="col" class="px-6 py-3">
                            <div class="text-center">Jutife</div>
                
                        </th>
                        <th  scope="col" class="px-6 py-3">
                            <div class="text-center">Motif</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="text-center">Seance</div>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    
                    <tr ref="absenceRefs"  class="bg-white border-b select-none"
                    v-for="(e,index) in etats" :key="index" >

                        <td class="p-4">
                            <div class="scale-90 w-full font-medium"
                            :class="e.etat_justif =='NJ'?'text-red-600':'text-green-700'">
                                {{ e.stagiaire.nom_st +" " + e.stagiaire.prenom_st}}
                            </div>             
                        </td>

                        <td class="p-4" >
                            <div class="scale-90 w-full font-medium"
                            :class="e.etat_justif =='NJ'?'text-red-600':'text-green-700'">
                                {{e.date_abs}}
                            </div> 
                        </td>

                        <td class="p-4">
                            <div class="scale-90 font-medium"
                            :class="e.etat_justif =='NJ'?'text-red-600':'text-green-700'">
                                {{e.duration.h_debut}}
                            </div>          
                        </td>

                        <td class="px-6 py-4 text-left font-medium"
                        :class="e.etat_justif =='NJ'?'text-red-600':'text-green-700'">
                            <div class="scale-90">
                                {{e.duration.h_fin}}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-left scale-90 font-medium"
                        :class="e.etat_justif =='NJ'?'text-red-600':'text-green-700'">
                            {{e.prof.nom_prof}}
                        </td>

                        <td class="px-6 py-4 text-left scale-90 font-medium"
                        :class="e.etat_justif =='NJ'?'text-red-600':'text-green-700'">
                            {{e.stagiaire.groupe.nom_gp}}
                        </td>

                        <td class=" scale-90 font-medium"
                        :class="e.etat_justif =='NJ'?'text-red-600':'text-green-700'">
                            <div class="text-center">{{e.etat_justif}}</div>
                        </td>


                        <td class="px-6 py-4 text-left scale-90 font-medium"
                        :class="e.etat_justif =='NJ'?'text-red-600':'text-green-700'">
                            {{e.motif}}
                        </td>

                        <td>
                            <div class="grid grid-cols-1 place-items-center gap-2 scale-90 font-medium"
                            :class="e.etat_justif =='NJ'?'text-red-600':'text-green-700'">
                                {{e.seance}}
                            </div>
                        </td>

                    </tr>

                </tbody>

            </table>
        </div>

        <template v-if="etats == null">
            <div class="w-full  flex justify-center items-center h-[17rem]">
                <svg role="status" class="inline w-14 h-14 mr-2 text-transparent animate-spin fill-blue-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
            </div>
        </template>

    </section>

</template>

<script setup>
    import { ref, watch } from 'vue';
    import useFilieres from '../services/filieres.js'
    import { onMounted } from 'vue';

    /* Variables Help-us */
    const selected_fil = ref("Tous")
    const selected_period = ref("year")
    const period_debut = ref(null)
    const period_fin = ref(null)
    const activeHoure = ref('TT')
    const gpId = ref(null)



    const periodChanged = () => {
        period_debut.value = null , period_fin.value = null
        getetats(selected_fil.value,selected_period.value,period_debut.value,period_fin.value)
        activeHoure.value = 'TT'
    }
    const inputeDate = () => {
        if(period_debut.value != null && period_fin.value != null){
            getetats(selected_fil.value,selected_period.value,period_debut.value,period_fin.value)
            activeHoure.value = 'TT'
        }
    }

    
    const changeGp = (event) => {
        
        document.querySelectorAll("a").forEach(element => {
            element.classList.remove("activeLink")
        });
        event.target.classList.add("activeLink")
        gpId.value = event.target.title
        activeHoure.value == 'TT' ? filterEtat() : filterEtat(activeHoure.value)
        
        
    }

    const filterEtat = (hour = null) => {

        if(gpId.value != null){
            if(hour == null){
                etats.value = allEtats.value.filter((e)=>{
                    return e.stagiaire.groupe_id == gpId.value
                })
            }else{
                etats.value = allEtats.value.filter((e)=>{
                    return e.stagiaire.groupe_id == gpId.value && e.etat_justif == hour
                });
            }
        }else{
            if(hour == null){
                etats.value = allEtats.value.filter((e)=>{
                    return true
                })
            }else{
                console.log("yo")
                etats.value = allEtats.value.filter((e)=>{
                    return e.etat_justif == hour
                });
            }
        }
    }

    watch(() => activeHoure.value, () => {
        if(activeHoure.value == 'NJ') filterEtat('NJ')
        else if(activeHoure.value == 'J') filterEtat('J')
        else if(activeHoure.value == 'TT') filterEtat()
    })

    /* Call Api Groupes */
    const getcontents = () =>  {  selected_fil.value !== "Tous" ? getgroupes(selected_fil.value) : groupes.value = null,
    getetats(selected_fil.value,selected_period.value,period_debut.value,period_fin.value), activeHoure.value = 'TT'}
    /* Return all our functuons and variables from { services/filieres.js } to use here */
    const { getFilieres , filieres , getgroupes , groupes , allEtats , getetats, etats } = useFilieres();
    /* On Mounted call Aoi Flieres */
    onMounted(getFilieres(),getetats(selected_fil.value,selected_period.value,period_debut.value,period_fin.value))
    
</script>
<style scoped>
    button{
        background-color: rgb(0, 143, 255);
        border: 1px solid rgb(0, 143, 255);
    }
    button:hover{
        background-color: rgb(0, 120, 255);
        border: 1px solid rgb(0, 120, 255);
    }
    button:active{
        background-color: rgb(0, 100, 255);
        border: 1px solid rgb(0, 100, 255);
    }
    .activeLink{
        border-color: rgb(8, 91, 255);
        transition: all .8s ease 0s;
    }
    *{
        box-sizing: border-box;
    }
</style>