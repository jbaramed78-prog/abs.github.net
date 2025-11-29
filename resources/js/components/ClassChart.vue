<template>
<section class="relative">

    <div class=" sm:scale-100 scale-75 flex flex-col  w-[90%] md:w-[500px] lg:w-[800px] cursor-pointer   bg-[#FFFFFF]
         shadow-lg rounded mx-auto mb-5 h-[430px]">      
                 

        <div class="flex flex-row justify-between p-2 uppercase text-xs font-semibold">
            <span class=" text-blue-900 m-2 select-none"><fas icon="fa-arrow-right" /> Tous les Heures : {{data.total_h}} h </span>
            <span @click="Model('open')" class="mt-2 text-gray-300 hover:text-sky-700"><fas size="xl" icon="fa-chart-pie"/> </span>          
            <span class=" text-blue-900 m-2 select-none">Non justifiées : {{data.nj_h}} h <fas icon="fa-arrow-left" /></span>          
        </div>

        <div class="w-full h-[380px]  mx-auto  ">   
            <canvas :id="data.groupe.nom_gp"></canvas>
        </div>      
  
    </div>

    <div :id="'Model'+data.groupe.nom_gp" class="fixed top-0 w-full h-full z-40 hidden place-content-center rounded-md">
        <div class="absolute bg-slate-300 w-full h-full rounded-md opacity-50 z-10"></div>

            <div class="  lg:w-[35rem] sm:w-[30rem] md:w-[28rem] scale-75 sm:scale-100 w-[29rem] pb-5 bg-white absolute z-20 translate-y-[-50%] translate-x-[-50%]  md:translate-x-[-70%] top-[50%] left-[50%] grid place-content-center rounded-md ">
                <div class="lg:w-[32rem] sm:w-[26rem]  w-[27rem] flex justify-between px-5 pt-5 pb-3">

                    <span
                    @click="mostAbs(data.groupe.id)" 
                    class="text-sm text-gray-400 hover:text-cyan-600 cursor-pointer">
                    <fas icon="fa-arrow-right" /> Most stagiaire absences</span>
                        
                    <span class="hover:text-sky-700 text-gray-400 cursor-pointer" @click="Model('close')"><fas size="xl" icon="fa-xmark" /></span>
                    
                </div>
                <div class="flex">
                    <a
                    @click="active = 'pieT'"
                    :class="active =='pieT' ? 'bg-slate-200 text-xs border-blue-700 text-blue-700 font-bold':'font-semibold hover:bg-slate-50 text-sm'"
                    class="w-[50%] flex items-center duration-200 ease-in-out py-2 rounded-md px-2 uppercase cursor-pointer border-b-2 ">par tous filieres</a>
                    <a
                    @click="active = 'pieF'"
                    :class="active == 'pieF'? 'bg-slate-200 text-xs border-blue-700 text-blue-700 font-bold':'font-semibold hover:bg-slate-50 text-sm'"
                    class="w-[50%] flex items-center duration-200 ease-in-out py-2 rounded-md  px-2 uppercase cursor-pointer border-b-2 ">par son filieres</a>
                    <a
                    @click="active = 'pieFF'"
                    :class="active == 'pieFF' ? 'bg-slate-200 text-xs border-blue-700 text-blue-700 font-bold':'font-semibold hover:bg-slate-50 text-sm'"
                    class="w-[50%] flex items-center duration-200 ease-in-out py-2 rounded-md  px-2 uppercase cursor-pointer border-b-2 ">Fil par tous</a>
                </div>

                <div v-if="active == 'pieT'" class="w-full flex justify-between px-2 mt-2 font-bold text-base">
                    <span class="text-[#00CED1]"><fas icon="fa-arrow-right" /> {{ Pourcentage(data.total_h/(hoursTotal)*100)+'%' }}</span>
                    <span class="text-[#4169E1]">{{ (100 - Pourcentage(data.total_h/(hoursTotal)*100))+'%' }} <fas icon="fa-arrow-left" /></span>
                </div>

                <div v-else-if="active == 'pieF'" class="w-full flex justify-between px-2 mt-2 font-bold text-base">
                    <span class="text-[#00CED1]"><fas icon="fa-arrow-right" /> {{ Pourcentage(data.total_h/(hoursFil)*100)+'%' }}</span>
                    <span class="text-[#4169E1]">{{ (100 - Pourcentage(data.total_h/(hoursFil)*100))+'%' }} <fas icon="fa-arrow-left" /></span>
                </div>
                <div v-if="active == 'pieFF'" class="w-full flex justify-between px-2 mt-2 font-bold text-base">
                    <span class="text-[#00CED1]"><fas icon="fa-arrow-right" /> {{ Pourcentage(hoursFil/(hoursTotal)*100)+'%' }}</span>
                    <span class="text-[#4169E1]">{{ (100 - Pourcentage(hoursFil/(hoursTotal)*100))+'%' }} <fas icon="fa-arrow-left" /></span>
                </div>
                
                <div class="w-full flex justify-center">
                    <div :id="'canvasone'+data.groupe.nom_gp" class="w-[23rem] hidden">
                    <canvas class="relateive z-20" :id="'pieF'+data.groupe.nom_gp"></canvas>
                    </div>
                    <div :id="'canvastwo'+data.groupe.nom_gp" class="w-[23rem]">
                        <canvas class="relateive z-20" :id="'pieT'+data.groupe.nom_gp"></canvas>
                    </div>

                    <div :id="'canvasthree'+data.groupe.nom_gp" class="w-[23rem] hidden">
                        <canvas class="relateive z-20" :id="'pieFF'+data.groupe.nom_gp"></canvas>
                    </div>
                </div>

            </div>
    </div>


</section>        
</template>


<script setup>
    import {ref, onMounted, watch} from "vue";
    import Chart from 'chart.js/auto';
    import { useRouter } from 'vue-router';
    import axios  from 'axios';
    const active = ref('pieT')
    const props = defineProps(['data','hours'])
    const router = useRouter()
    const hoursTotal = ref(0)
    const hoursFil = ref(0)
    const noCanvaYet = ref(true)




    var monthlyChart = {}
    var pieChart = {}

    onMounted(()=>{
            var monthlyOptions = {
                barThickness:10,
                interaction: {
                intersect: false,
                mode: 'index',
                },
                    maintainAspectRatio:false,
                    responsive:true,
                    plugins: 
                    {
                    
                        title: 
                        {
                            position:"top",
                            align:"top",
                            color:"#696969",
                            display: true,
                            text: props.data.groupe.nom_gp,
                            font: {
                                size: 16,
                                family:"sans-serif"
                                }    
                        },
                        legend: 
                        {
                            position:"bottom",
                            align:"end",
                            labels: {
                                font: {
                                    size: 12,
                                    weight:"bold"
                                },
                            },
                        },
                        tooltip:{
                            callbacks:{
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    return label + ": "+ context.parsed.y + " h";
                            }
                            }
                            
                        }
                    },
                    scales: {
                        y:{ 
                            ticks: {
                                callback: function(value, index, ticks) {return value + " h";},
                                color:"gray",
                                font:{
                                    size:10,
                                    weight:"bolder"
                                }
                                },
                          
                        },
                        x:{
                            ticks: {
                                
                                color:"#AAB0B8",
                                font:{
                                    size:10,
                                    weight:"bolder"
                                }
                                },
                            grid:{
                                display: false,
                             
                            }
                        }
                    }                                   
                    
                }
                
            var monthlyData = 
            {
                    labels: ['Septembre', 'Octobre', 'Novembre', 'Décembre',
                    'Janvier', 'Février', 'Mars', 'Avril', 
                    'Mai', 'Juin', 
                    'Juillet', 'Aout'],
                    datasets: 
                    [
                        {
                        label: 'Heures justifiées',
                        data: props.data.just_abs ,
                        backgroundColor: "#00CED1",
                        borderColor: "#00CED1",
                        fill: false,     
                        borderWidth: 1,
                        barThickness:17
                        },
                        { 
                        label: 'Heures Non justifiées',
                        data:props.data.nj_abs,
                        backgroundColor: "#4169E1",
                        borderColor: "#4169E1",
                        borderWidth: 4,
                        barThickness:17
                        }
                    ],
            }
            var monthlyConfig=
            {
                type:"bar",
                data: monthlyData,
                options: monthlyOptions
            }
            /* Pie Context */
            const monthlyCtx = document.getElementById(props.data.groupe.nom_gp);
                    monthlyChart = new Chart(monthlyCtx,monthlyConfig)

            showPie("TT")

            hoursTotal.value =  props.hours

      })
    

    const showPie = (type) =>{
        var id = ""
        var nom = ""
        var hours = 0

        if(type == 'TT') 
        { 
            id = 'pieT'+props.data.groupe.nom_gp
            nom = "Tous"
            hours = props.hours
            
        }
        else if(type == 'FL') 
        { 
            id = 'pieF'+props.data.groupe.nom_gp
            nom = "Filiere"
            hours = hoursFil.value
        }
        else if(type == 'FF'){
            id = 'pieFF'+props.data.groupe.nom_gp
            nom = "Tous"
            hours = hoursFil.value
        }
            var pieOptions =  
            {
                layout: {
                    padding: 5
                  },
                plugins: 
                    {
                        legend: 
                        {
                            labels: {
                                font: {
                                    size: 12,
                                    weight:"bold"
                                    },
                                color:"#696969",
                                align:"end",
                                position:"end"
                            },
                        },
                    }
            }

            if(type != 'FF'){
                var pieData =
            {
                    labels: [nom, props.data.groupe.nom_gp],
                    datasets: 
                    [{
                      
                        data: [hours-props.data.total_h,props.data.total_h],
                        backgroundColor: ['#4c51bf','#26d0ce'],
                        hoverOffset: 4,
                    }]
                }
            }else{
                var pieData =
            {
                    labels: [nom, "Filiere"],
                    datasets: 
                    [{
                      /*  */
                        data: [hoursTotal.value-hours,hoursFil.value],
                        backgroundColor: ['#4c51bf','#26d0ce'],
                        hoverOffset: 4,
                    }]
                }
            }
            

            /* Configuration Object  */
            var pieConfig = {
            type:"doughnut",
            data:pieData,//object
            options:pieOptions,//object
       //array
        }
        /* Pie Context */
        

            const pieCtx = document.getElementById(id);
                    pieChart = new Chart(pieCtx,pieConfig);
    }


    const Model = (about) => {
        
        if(about == 'close'){
            document.getElementById("Model"+props.data.groupe.nom_gp).classList.add("hidden")
            active.value = "pieT"
        }else{
            if(noCanvaYet.value){
                getFilHours(props.data.groupe.id)
                noCanvaYet.value = false
            }
            document.getElementById("Model"+props.data.groupe.nom_gp).classList.remove("hidden")
        }
    }

    const mostAbs = async (groupe_id) => {
        let response = await axios.post("/getMostStAbs", {id: groupe_id})
        router.push('/stagiaire/'+response.data.id)
    }

    watch(() => active.value, () => {

        if(active.value == 'pieF'){
            document.getElementById('canvastwo'+props.data.groupe.nom_gp).classList.add('hidden')
            document.getElementById('canvasthree'+props.data.groupe.nom_gp).classList.add('hidden')
            document.getElementById('canvasone'+props.data.groupe.nom_gp).classList.remove('hidden')
        }else if(active.value == 'pieT'){
            document.getElementById('canvasthree'+props.data.groupe.nom_gp).classList.add('hidden')
            document.getElementById('canvasone'+props.data.groupe.nom_gp).classList.add('hidden')
            document.getElementById('canvastwo'+props.data.groupe.nom_gp).classList.remove('hidden')
        }else if (active.value == 'pieFF'){
            document.getElementById('canvastwo'+props.data.groupe.nom_gp).classList.add('hidden')
            document.getElementById('canvasone'+props.data.groupe.nom_gp).classList.add('hidden')
            document.getElementById('canvasthree'+props.data.groupe.nom_gp).classList.remove('hidden')
        }
    })

    const Pourcentage = (nombre) => {
        
        return Math.round(nombre)
    }

    const  getFilHours = async (id) => {

        let response = await axios.get('getFilHours/'+id)

        hoursFil.value  = response.data.Hours
        console.log(hoursFil.value)
        showPie("FL")
        showPie("FF")
    }
   
</script>