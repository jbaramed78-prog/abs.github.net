
<template>

<section>
    <div class="w-full px-5 my-12">
        <select name="filiere" id="filieres_select" v-model="selected" class="w-full font-medium h-[2rem]" v-on:change="getgroupes(selected)">
            <option class="hidden">Choisis la classe</option>
            <option  :value="fil.id" v-for="fil in filieres" :key="fil.id">{{fil.nom_fil}}</option>
        </select>

    </div>

    <nav v-if="groupes" class="w-full bg-white px-4 py-5">
        <div class="grid-cols-3 bg-slate-100 lg:scale-100 scale-75 rounded-lg grid sm:grid-cols-5 border-4 border-slate-100">
            <a
            v-for="gp in groupes"
            :title="gp.id"
            @click="check" 
            class="p-5 cursor-pointer bg-slate-100 text-center border-b-4 border-transparent" :key="gp.id">{{ gp.nom_gp }}</a>
        </div>
    </nav>

    <div v-if="stagiaires" class="mt-4 flex w-full relative h-12 sm:scale-x-90 lg:scale-x-100 scale-x-75" >
        <router-link to="/addStag">
            <div class="inline-flex items-center px-5 py-3  text-base font-semibold text-white absolute right-5
                justify-around select-none bg-blue-600 rounded-md cursor-pointer w-[10rem] hover:bg-blue-700">
                Add stagiaire
                <fas icon="plus" />
            </div>
        </router-link>

    </div>
    

    <div v-if="stagiaires" class="relative sm:p-5 scale-x-75 overflow-x-auto shadow-md sm:scale-x-90 lg:scale-x-100">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-sky-600">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prenom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Numero personnelle
                    </th>
                    <th  scope="col" class="px-6 py-3">
                        Etat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Edit
                    </th>
                </tr>
            </thead>

            <tbody>
                
                <tr v-for="st in stagiaires" :key="st.id" class="bg-white border-b select-none"
                :class="st.status != 'Active'?' bg-red-100':''"
                >
                    <td  class="px-6 py-4">
                        <input :disabled = "true" class="bg-transparent px-2 h-9 focus:outline-cyan-500" type="text" :value="st.nom_st">
                    </td>
                    <td class="px-6 py-4">
                        <input :disabled = "true" class="bg-transparent px-2 h-9 focus:outline-cyan-500" type="text" :value="st.prenom_st ">
                    </td>
                    <td class="px-6 py-4">
                        <input :disabled = "true" class="bg-transparent px-2 h-9 focus:outline-cyan-500" type="text" :value=" st.num">
                    </td>
                    <td class="px-6 py-4 text-left font-medium">
                        <select :disabled = "true" :class="st.status != 'Active'?' bg-red-100':''" class="py-2 px-1">
                            <option class="hidden" selected>{{ st.status }}</option>
                            <option>Active</option>
                            <option>Abondonné</option>

                        </select>
                    </td>
                    <td class="px-6 py-4 text-left font-medium">
                        <div @click="editThis" class="w-8 cursor-pointer text-blue-600 hover:underline">Edit</div>
                        <div :id="st.id" @click="saveThis" class="w-8 cursor-pointer text-green-600 hover:underline hidden">Save</div>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

</section>

</template>

<script setup>

    import { ref } from 'vue';
    import axios from 'axios';
    import { useToast } from "vue-toastification";

    import useFilieres from '../../services/filieres.js'
    import { onMounted } from 'vue';

    const idFill = ref("")
    const stagiaires = ref(false)
    const toast = useToast();
    

    const getstags = async (groupe_id) =>{
        let response = await axios.get(`/stagsGroupe/${groupe_id}`)
        stagiaires.value = response.data.data
    };

    
    const { getFilieres , filieres , getgroupes , groupes } = useFilieres();

    onMounted(getFilieres())

    const selected = ref("Choisis la classe")

    const check = (event) =>{

        document.querySelectorAll("a").forEach(element => {
            element.classList.remove("activeLink")
        });
        event.target.classList.add("activeLink")
        getstags(event.target.title)
        idFill.value = event.target.title
    }

    const editThis = (event) => {

        event.currentTarget.classList.add("hidden")
        event.currentTarget.nextSibling.classList.remove("hidden")

        
        var tds = event.currentTarget.parentNode.parentNode.childNodes

        tds.forEach(element => {
            element.childNodes[0].disabled = false
            element.childNodes[0].classList.add('text-black')
        });

    }

    const saveThis = async (event) => {

        var keep = true
        var tds = event.currentTarget.parentNode.parentNode.childNodes

         tds.forEach(element => {

            if(element.childNodes[0].nodeName == "INPUT"){
                if(element.childNodes[0].value.length == 0){
                    keep = false
                    element.childNodes[0].focus()
                    return
                }
            } 

        });

        if(!keep){

            return
        }



        await saveSt(
            event.target.id,
            tds[0].childNodes[0].value, 
            tds[1].childNodes[0].value,
            tds[2].childNodes[0].value,
            tds[3].childNodes[0].value
        )

        tds.forEach(element => {
            element.childNodes[0].disabled = true
            element.childNodes[0].classList.remove('text-black')
        });

        event.currentTarget.classList.add("hidden")
        event.currentTarget.previousSibling.classList.remove("hidden")
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

    const saveSt = async (id, first, last, num, status) =>  {
        axios.post('updateStagiaire',{ id: id, first : first , last: last , num : num , status: status})
        .then((response) => {
            getstags(idFill.value) 
        }).catch((error) => {  Error() });

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
    

</style>