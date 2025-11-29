


<template>
<section v-if="shallwe" class="h-screen relative">

  <!-- Recherche and lines -->
    <div class="w-full grid grid-col-1 gap-4 sm:flex sm:justify-between mb-3 mt-12 px-2 lg:px-6">

        <div class="relative w-[15rem]">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input @keyup="stagBySearch" v-model="search" type="text" placeholder="Recherche des stagiaire" class=" text-sm rounded-md focus:outline-2 outline-slate-600 block w-full pl-10 p-2.5  ">
        </div>
        

        <div  class="max-w-max max-h-max relative">
            <select  @click="dash=!dash" v-model="stagPerPage" @change="changePage" class="cursor-pointer
             w-24 rounded-sm h-9 text-sm text-slate-700 outline-slate-500 px-2" >
                <option value="15" hidden>Lignes</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        

    </div>


   <!-- Stagiaires Tables -->
    <div class="flex justify-center overflow-x-auto relative px-2 lg:px-6">

        <div class=" w-full mt-10  overflow-x-auto relative shadow-lg shadow-gray-300 rounded-md">
            <table class="bg-white md:p-2 select-none w-full">

                <tr class="border-b-2 border-gray-300 p-0 h-[2.4rem] md:h-[3rem] bg-slate-100">

                        <th class="p-0" >
                            <div data-column="id"  @click="sortTable" class=" 
                            cursor-pointer flex items-center ml-5" >
                             <span class="text-xs font-medium mr-2 md:mr-3
                            sm:text-md lg:text-base md:font-semibold">Matricule</span>
                                <div  class="text-gray-300 flex p-0 text-xs md:text-base">
                                    <fas :class="(sort.type =='id' &&
                                    sort.option =='asc')? 'text-black':''"  size="xs" icon="arrow-up" />
                                    <fas :class="(sort.type =='id' &&
                                    sort.option =='desc')? 'text-black':''" size="xs" icon="arrow-down" />
                                </div>
                            </div> 
                        </th>

                        <th class="p-0">
                            <div data-column="nom_st" @click="sortTable" class="flex cursor-pointer  items-center ml-5" >
                                <span class="text-xs font-medium mr-2 md:mr-3
                            sm:text-md lg:text-base md:font-semibold">Nom</span>

                                <div class="text-gray-300 flex p-0 text-xs md:text-base">
                                    <fas :class="(sort.type =='nom_st' &&
                                    sort.option =='asc')? 'text-black':''"  size="xs" icon="arrow-up" />
                                    <fas :class="(sort.type =='nom_st' &&
                                    sort.option =='desc')? 'text-black':''" size="xs" icon="arrow-down" />
                                </div>
                            </div> 
                        </th>

                        <th class="p-0">
                            <div data-column="prenom_st"  @click="sortTable" class="cursor-pointer flex items-center ml-5" >
                            
                            <span class="text-xs font-medium mr-2 md:mr-3
                            sm:text-md lg:text-base md:font-semibold">Prenom</span>

                                <div class=" flex p-0 text-gray-300 text-xs md:text-base">
                                <fas :class="(sort.type =='prenom_st' &&
                                    sort.option =='asc')? 'text-black':''"  size="xs" icon="arrow-up" />
                                    <fas :class="(sort.type =='prenom_st' &&
                                    sort.option =='desc')? 'text-black':''" size="xs" icon="arrow-down" />
                            </div>
                            </div> 
                        </th>

                        <th class="p-0">
                            <div  @click="sortTable"
                            data-column="groupe" class="cursor-pointer flex items-center ml-5" >
                                <span class="text-xs font-medium mr-2 md:mr-3
                            sm:text-md lg:text-base md:font-semibold">Groupe</span>

                                <div class=" flex p-0  text-gray-300 text-xs md:text-base">
                                    <fas :class="(sort.type =='groupe' &&
                                    sort.option =='asc')? 'text-black':''"  size="xs" icon="arrow-up" />
                                    <fas :class="(sort.type =='groupe' &&
                                    sort.option =='desc')? 'text-black':''" size="xs" icon="arrow-down" />
                                </div>
                            </div> 
                        </th>

                        <th class="p-0">
                            <div  @click="sortTable" 
                            data-column="heure_absence_st" class="cursor-pointer
                             flex items-center ml-5" >
                            <span class="text-xs font-medium mr-2 md:mr-3
                            sm:text-md lg:text-base md:font-semibold">Heures</span>

                                <div class=" flex p-0 text-gray-300 text-xs md:text-base">
                                    <fas :class="(sort.type =='heure_absence_st' &&
                                    sort.option =='asc')? 'text-black':''"  size="xs" icon="arrow-up" />
                                    <fas :class="(sort.type =='heure_absence_st' &&
                                    sort.option =='desc')? 'text-black':''" size="xs" icon="arrow-down" />
                                </div>
                            
                            </div> 
                        </th>

                        <th class="p-0" >
                            <div  @click="sortTable" 
                            data-column="numero_personnelle" class="cursor-pointer flex items-center ml-5" >
                                <span class="text-xs font-medium mr-2 md:mr-3
                            sm:text-md lg:text-base md:font-semibold">Tel N°</span>

                                <div class="flex p-0 text-gray-300 text-xs md:text-base">
                                <fas :class="(sort.type =='numero_personnelle' &&
                                    sort.option =='asc')? 'text-black':''"  size="xs" icon="arrow-up" />
                                    <fas :class="(sort.type =='numero_personnelle' &&
                                    sort.option =='desc')? 'text-black':''" size="xs" icon="arrow-down" />
                            </div>
                            </div> 
                        </th >

                </tr>

                    <!-- Not found -->
                <tr class="p-4 cursor-pointer  border-b hover:bg-slate-500 transition-colors"  v-show="searchFailed">
                    <td colspan="6">
                        <p class="text-center text-red-600 text-lg font-bold"> No Result Found</p>
                    </td>
                </tr>

                <tr @click="studentInfo(st.id)"  v-show="!searchFailed" class="
                cursor-pointer active:bg-slate-300 border-b hover:bg-slate-200 h-10 md:h-14 transition-colors"  
                    v-for="st in stagIntoPages[currentPage]" :key="st.id">
                    <td class="text-xs
                     lg:text-sm opacity-100  font-bold text-left text-slate-900"><div class="ml-5">{{st.matricule_st}}</div></td>
                    <td class="text-xs
                     lg:text-sm opacity-90 font-semibold text-left text-slate-600"><div class="ml-5">{{st.nom_st}}</div></td>
                    <td class="text-xs
                     lg:text-sm opacity-90 font-semibold text-left text-slate-600"><div class="ml-5">{{st.prenom_st}}</div></td>
                    <td class="text-xs 
                 lg:text-sm opacity-90 font-semibold text-left text-slate-600"><div class="ml-5">{{st.groupe.nom_gp}}</div></td>
                    <td class="text-xs 
                 lg:text-sm opacity-90 font-semibold text-left text-slate-600"><div class="ml-5">{{st.heure_absence_st}}</div></td>
                    <td class="text-xs 
                 lg:text-sm opacity-90 font-semibold text-left text-slate-600"><div class="ml-5">{{st.numero_personnelle}}</div></td>
                </tr>

            </table>
        </div>

    </div>

    <!-- Next-Previous btns -->
    <div v-show="!searchFailed" class="flex justify-between xl:px-20 md:px-10 px-6 py-10">
        <!-- previos-btn -->
        <div class="page-item"><a
            :class="currentPage == 0 ? 'opacity-[0.5] cursor-default hover:bg-transparent':'cursor-pointer'"
            class=" select-none page-link text-sm py-2 px-2 hover:bg-gray-200 relative block rounded-md"
            @click="previousPage"><span class="text-lg ml-5">« </span><span class="hidden sm:inline-block">Précédent</span></a>
        </div>

        <div class="flex justify-between" 
        :class="currentPage != 0 ? 'w-[10rem]':''">    
            <!-- Previous -->
            <div class="page-item"><a
                class=" select-none cursor-pointer page-link text-md py-1 px-2 rounded-sm w-[2.5rem] grid place-content-center relative hover:bg-slate-300 transition-all duration-500"
                @click="previousPage" v-show="currentPage != 0">{{currentPage}}</a>
            </div>

            <!-- Current -->
            <div class="page-item active"><a
                class=" select-none cursor-pointer page-link text-md py-1 px-2 rounded-sm w-[2.5rem] grid place-content-center relative border-double border-[3px] border-gray-500 transition-all duration-500"
                href="#">{{currentPage+1}}</a>
            </div>

            <!-- Next -->
            <div class="page-item"><a
                class=" select-none cursor-pointer page-link text-md py-1 px-2 rounded-sm w-[2.5rem] grid place-content-center relative hover:bg-slate-300 transition-all duration-500"
                @click="nextPage"  v-show="currentPage != lastPageNum ">{{currentPage + 2}}</a>
            </div>
        </div>

        <!-- Next-btn -->

        <div class="page-item"><a
            :class="lastPageNum == currentPage ? 'opacity-[0.5] cursor-default hover:bg-transparent':'cursor-pointer'"
            class="select-none page-link text-sm py-2 px-2 hover:bg-gray-200 relative block rounded-md"
            @click="nextPage"><span class="hidden sm:inline-block">Suivant</span> <span class="text-lg">» </span></a>
        </div>


    </div>
    


</section>
</template>

<script setup>
    import { faSortAlphaAsc ,  } from '@fortawesome/free-solid-svg-icons';
    import axios  from 'axios';
    import {ref ,reactive,watch, onMounted,computed , onBeforeMount} from "vue";
    import { useRoute,useRouter } from 'vue-router';

    const stagPerPage = ref(15)
    const stagiaires = ref([])
    const currentPage=ref(0)
    const search = ref("")
    const shallwe = ref(false)
    const dropdown = ref(false)
    const headDrop = ref("Choos Option")
    
    const router = useRouter()
    function studentInfo(id){
        router.push('/stagiaire/'+id)
    }
    const lastPageNum = computed(()=>{ return stagIntoPages.value.length - 1 })
      
    watch(stagPerPage,()=>{ currentPage.value = 0
        stagIntoPages.value= arrayChunk(stagiaires.value,Number(stagPerPage.value),search.value)
    })

    const searchFailed = ref(false)
    const stagIntoPages =ref(0)
    const sort = reactive({ type:"heure_absence_st" , option:"desc" })
        
    onBeforeMount(()=>{ getSt() })

    const handleDrop = (event) => {
        dropdown.value = false
        headDrop.value = event.target.innerHTML
    }
   
    function stagBySearch(){
        
        var searchResult = arrayChunk(stagiaires.value,Number(stagPerPage.value),search.value)
       
        if(searchResult[0].length !== 0){ searchFailed.value = false ,  stagIntoPages.value = searchResult }
 
        else{ searchFailed.value = true }
            
        currentPage.value = 0
    }

    function arrayChunk(arr,len,search){
        var upSearch = search.toUpperCase().split(" ").join("") , result = [] ,  i = 0

        while(i < arr.length){
            var chunk = [], j = 0
            while(j < len && i < arr.length){
                var nom = arr[i]['nom_st'].toUpperCase().split(" ").join("")
                var prenom = arr[i]['prenom_st'].toUpperCase().split(" ").join("")
                var x1 = nom+prenom ,  x2 = prenom+nom

                if(search === "") { chunk.push(arr[i]) ,  j++ }

                else{if(x1.includes(upSearch) || x2.includes(upSearch)){ chunk.push(arr[i]) , j++ }}

                i++;

            }result.push(chunk)
        }return result
    }

    const getSt = async () =>{
        let response = await axios.get("/stagiaires")
        stagiaires.value = response.data
        stagiaires.value.sort((a, b) => (a['heure_absence_st'] < b['heure_absence_st']) ? 1 : -1)
        stagIntoPages.value = arrayChunk(stagiaires.value,Number(stagPerPage.value),search.value)
        shallwe.value= true
    };
    
    function previousPage(){ if( currentPage.value > 0) currentPage.value = currentPage.value - 1  }
      
    function nextPage(){
        if( currentPage.value < stagIntoPages.value.length-1 ) currentPage.value = currentPage.value + 1
    }

    function sortTable(event){
        var parent = event.currentTarget
        var sortType =parent.dataset.column

        event
        
         if(sort.type == sortType)  { sort.option == "asc" ?  sort.option = "desc" :   sort.option = "asc" }
         else { sort.option="desc" ,  sort.type = sortType }
           

         if(sort.option =="asc"){
            if(sortType == "groupe")  { stagiaires.value.sort((a, b) => (a.groupe.nom_gp > b.groupe.nom_gp) ? 1 : -1) }
            else  { stagiaires.value.sort((a, b) => (a[sortType] > b[sortType]) ? 1 : -1) }
        }
        else{
            if(sortType == "groupe") {  stagiaires.value.sort((a, b) => (a.groupe.nom_gp < b.groupe.nom_gp) ? 1 : -1) }
            else  { stagiaires.value.sort((a, b) => (a[sortType] < b[sortType]) ? 1 : -1) }
        }
        currentPage.value = 0
        stagIntoPages.value = arrayChunk(stagiaires.value,Number(stagPerPage.value),search.value)
    }

</script>

<style scoped>
   
</style>