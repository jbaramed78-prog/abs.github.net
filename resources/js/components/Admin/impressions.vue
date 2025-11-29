<template>
<section>

    <select v-model="type">
        <option class="hidden" value="null" selected>Choisir le type d'impression</option>
        <option value="feuille_de_presence">Feuille de présence</option>
        <option value="pv_de_notes">Pv de notes</option>
        <option value="grille_de_notation">Grille de notation</option>
        <option value="enveloppe_cc_efm">Enveloppe CC et EFM</option>
    </select>
    <div v-show="type =='feuille_de_presence' || type == 'pv_de_notes' || type == 'grille_de_notation'" class="w-full lg:w-[45%] my-12">
            <select name="filiere" id="filieres_select" v-model="selected_fil" @change="changeFil"  class="w-full font-medium h-[2rem]" >
                <option class="hidden" :value="null">Choisir une filiere</option>
                <option  :value="fil.id" v-for="fil in filieres" :key="fil.id">{{fil.nom_fil}}</option>
            </select>
    </div>

    <div v-show="type =='enveloppe_cc_efm'" class="w-full lg:w-[45%] my-12">
        <select v-model="selected_type"  class="w-full font-medium h-[2rem]" >
                <option value="par_formateur">Par Formateur</option>
                <option value="par_module">Par module</option>
        </select>   
    </div>

    <!-- formateut selection -->
    <div v-show="selected_type == 'par_formateur' && type == 'enveloppe_cc_efm'" class="w-full bg-white px-4 py-5">
        <div class="grid-cols-3 bg-slate-100 lg:scale-100 scale-75 rounded-lg grid sm:grid-cols-5 border-4 border-slate-100">
            <template v-for="pr in profs" :key="pr.id">
            <div class="grid items-center">
                <label :title="pr.id" :for="'pr_'+pr.id"   class="p-5 cursor-pointer select-none bg-slate-100 text-center border-b-4 border-transparent " 
                    @click="add_remove_pr($event,pr.id)">{{ pr.nom_prof }}</label>
                <input  type="checkbox" class="w-9 mx-auto" :id="'pr_'+pr.id" :value="pr.id" v-model="selected_profs">
            </div>
                    
            </template>
            
        </div>
    </div>
    <!-- Modules selection -->
    <div v-show="selected_type == 'par_module' && type == 'enveloppe_cc_efm'" class="w-full bg-white px-4 py-5">
        <div class="grid-cols-3 bg-slate-100 lg:scale-100 scale-75 rounded-lg grid sm:grid-cols-5 border-4 border-slate-100">
            <template v-for="md in modules" :key="md.id">

                    <div class="grid items-center">
                        <label :title="md.id" :for="'md_'+md.id"   class="p-5 cursor-pointer select-none bg-slate-100 text-center border-b-4 border-transparent " 
                    @click="add_remove_md($event,md.id)">{{ md.nom_module }}</label>
                    <input class="w-9 mx-auto" type="checkbox"  :id="'md_'+md.id" :value="md.id" v-model="selected_modules">
                    </div>
                    
            </template>
            
        </div>
    </div>

    <div v-show="selected_fil != null && (type == 'feuille_de_presence' || type == 'pv_de_notes' || type == 'grille_de_notation')" class="w-full bg-white px-4 py-5">
        <div class="grid-cols-3 bg-slate-100 lg:scale-100 scale-75 rounded-lg grid sm:grid-cols-5 border-4 border-slate-100">
            <template v-for="gp in currentGroupes" :key="gp.id">
                    <label :title="gp.id" :for="'gp_'+gp.id"   class="p-5 cursor-pointer bg-slate-100 text-center border-b-4 border-transparent " 
                    @click="add_remove_gp($event,gp.id)">{{ gp.nom_gp }}</label>
                    <input type="checkbox" class="hidden"  :id="'gp_'+gp.id" :value="gp.id" v-model="selected_groupes">
            </template>
            
        </div>
    </div>
    <div v-show="selected_fil != null && (type == 'feuille_de_presence' || type == 'pv_de_notes' || type == 'grille_de_notation')" class="w-full  grid place-items-center">
        <button @click="loadPresencePdf" :disabled="(selected_groupes.length == 0 || type == null)" class="bg-green-500 p-2 rounded-sm"
        :class="(selected_groupes.length == 0 || type == null)? 'opacity-50':'opacity-100'">Imprimer</button>
    </div>
    
    <div v-show="type == 'enveloppe_cc_efm' && selected_type == 'par_formateur'" class="w-full  grid place-items-center">
        <button @click="envParProf" :disabled="(selected_profs.length == 0 && selected_type == 'par_formateur')" class="bg-green-500 p-2 rounded-sm"
        :class="(selected_profs.length == 0 && selected_type == 'par_formateur')? 'opacity-50':'opacity-100'">Imprimer</button>
    </div>
    
    <div v-show="type == 'enveloppe_cc_efm' && selected_type == 'par_module'" class="w-full  grid place-items-center">
        <button @click="envParModule" :disabled="(selected_modules.length == 0 && selected_type == 'par_module')" class="bg-green-500 p-2 rounded-sm"
        :class="(selected_modules.length == 0 && selected_type == 'par_module')? 'opacity-50':'opacity-100'">Imprimer</button>
    </div>

   
   
</section>
</template>



<script setup>
    import {ref,onMounted} from "vue";
    import axios from "axios";
   
    const selected_groupes = ref([])
    const currentGroupes = ref([]);
    const type = ref("null")
    const selected_fil = ref(null)
     const selected_type = ref('par_formateur')
    const selected_profs = ref([])
    const selected_modules = ref([])
    const modules = ref([])
    const filieres = ref([])
    
    const profs = ref([]);
    const allProfs = async () =>{
        let response = await axios.get(`/getProfs`)
        profs.value = response.data

    };
    const allModules = async () =>{
        let response = await axios.get(`/getModules`)
        modules.value = response.data
        console.log(modules.value)
    };
    onMounted(()=>{
        allModules()
        allProfs()
        getFilieres()
    })
    function add_remove_gp(event,groupe_id){
        if(selected_groupes.value.includes(groupe_id)){
            event.target.classList.remove("activeLink")
        }
        else{
            event.target.classList.add("activeLink")
        }
    }
    function add_remove_pr(event,prof_id){
        if(selected_profs.value.includes(prof_id)){
            event.target.classList.remove("activeLink")
        }
        else{
            event.target.classList.add("activeLink")
        }
    }

    function add_remove_md(event,module_id){
        if(selected_modules.value.includes(module_id)){
            event.target.classList.remove("activeLink")
        }
        else{
            event.target.classList.add("activeLink")
        }
    }
    async function loadPresencePdf(){
        await axios("/loadPresencePdf",{
            method:"POST",
            responseType: 'blob',
            data:{
                // anneeScolaire:anneeScolaire.value,
                // dr:dr.value,
                // complexe:complexe.value,
                // institut:institut.value,
                type:type.value,
                groupes:selected_groupes.value
            }
            
        }).then((response)=>{
            const file = new Blob([response.data],{type:"application/pdf"})
            const fileURL = URL.createObjectURL(file);
            window.open(fileURL);
            // console.log(response.data)
        })
    }

    async function envParModule(){
            await axios("/envParModule",{
            method:"POST",
            responseType: 'blob',
            data:{
                // anneeScolaire:anneeScolaire.value,
                // dr:dr.value,
                // complexe:complexe.value,
                // institut:institut.value,
                
                modules:selected_modules.value
            }
            
        }).then((response)=>{
            const file = new Blob([response.data],{type:"application/pdf"})
            const fileURL = URL.createObjectURL(file);
            window.open(fileURL);
            console.log(response.data)
        })
    }
    async function envParProf(){
            await axios("/envParProf",{
            method:"POST",
            responseType: 'blob',
            data:{
                // anneeScolaire:anneeScolaire.value,
                // dr:dr.value,
                // complexe:complexe.value,
                // institut:institut.value,
                
                profs:selected_profs.value
            }
            
        }).then((response)=>{
            const file = new Blob([response.data],{type:"application/pdf"})
            const fileURL = URL.createObjectURL(file);
            window.open(fileURL);
            // console.log(response.data)
        })
    }
    const getFilieres = async () => {
        let response = await axios.get("/filieres")
        filieres.value = response.data.data
    };

    const getgroupes = async (filiere_id) =>{
        let response = await axios.get(`/filieres/${filiere_id}`)
        currentGroupes.value = response.data.data
    };

    async function changeFil(){
        selected_groupes.value = [];
        if(selected_fil.value != null){
            await getgroupes(Number(selected_fil.value))
            
        }
    }

</script>

<style scoped>
    .activeLink{
        border-color: rgb(8, 91, 255);
        transition: all .8s ease 0s;
    }
</style>