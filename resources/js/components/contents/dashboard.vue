

<template>
<section class="h-auto relative">

    <div id="helper">
        <!-- -- SideBar -- -->
        <div v-if="dash" class="md:block md:h-screen md:w-[14rem] w-[96%] md:mx-0 mt-3 md:mt-0 bg-white md:overflow-y-scroll md:fixed fixed z-50">
            <div id="dashboard-header" class="flex justify-between mt-8 mb-10 mx-6">
                <h1 class=" text-sm uppercase font-bold">{{ fullName }}</h1>
                <span @click="dash=false" class="w-8 h-8 flex justify-center text-lg rounded-sm items-center active:border-[3px] active:border-zinc-900 md:hidden cursor-pointer"><fas icon="xmark" /></span>
            </div>
            <!-- -- Caeds -- -->
            <cards v-model="dash" />

        </div>
    </div>
    <div id="home" :class="dash?'opacity-[0.4] md:opacity-[1]':'opacity-[1]'" class="md:pl-[14rem] bg-blue-50 h-full">
        <!-- --home page -- -->
        <div class="relative h-full">
            <div class="md:h-[20rem] h-[30rem] bg-sky-600">
            <div id="contents" class="absolute top-0 w-full h-full z-30">
                <!-- -- Navbar  -- -->
                <div class="w-full h-20 md:px-14 md:pt-4 bg-blue-50 md:bg-sky-600 flex justify-between px-6 pt-5 ">
                    <span class="hidden md:block mt-3 font-bold text-white uppercase text-sm">{{title}}</span>
                    <span @click="dash=true" class="w-10 h-10 flex justify-center rounded-sm items-center text-xl active:border-[3px] active:border-zinc-900 md:hidden cursor-pointer"><fas icon="bars" /></span>
                    
                    <select  @change="updateActiveYear" 
                    class="p-2 my-3 bg-transparent font-bold text-lg text-zinc-800 w-[13rem] outline-2 focus:outline-sky-500 rounded-sm" v-model="activeYear">
                        <option v-for="year in absysyear" :value=year.id>{{year.year}}</option>
                    </select>

                        <img id="profile"
                        v-if="imageUser"
                        v-on:click="show=!show"
                        @focusout="show=false"
                        class="rounded-full h-12 w-12 cursor-pointer"
                        :src="imageUser"
                        >
                </div>
                <div id="page-contents" class="w-full h-auto">
                <!-- --  contents -- -->
                <router-view @profile="getuser" />
                </div>
            </div>
            </div>
            <!-- -- Profile -- -->
            <div v-show="show" class="w-44 h-35 bg-white shadow-md shadow-slate-400 rounded z-40 absolute top-16 md:right-20 right-10">

                <router-link to="/Profile">
                    <div class="px-4 py-3 hover:text-slate-600 active:bg-slate-300">View profile</div>
                </router-link>

                <div>  <hr> </div>

                <a href="/logout">
                    <div class="px-4 py-3 hover:text-slate-600 active:bg-slate-300">
                        Se déconnecter
                    </div>
                </a>
            </div>
        </div>
    </div>

</section>
</template>

<script setup>

    import { ref, watch, onBeforeMount } from 'vue';
    import { useRoute , useRouter } from 'vue-router';
    
    import axios from "axios";

    const show = ref(false)
    const dash = ref(null)
    const title = ref(null)
    const route = useRoute();
    const router = useRouter();
    const imageUser = ref(false)
    const fullName = ref("")
    const activeYear = ref(null)
    const absysyear = ref([])

    onBeforeMount(()=>{
        getuser()
        updateStatus()
        getAbsysyear()
    })

    const getAbsysyear = async () => {
        let response =  await axios.get('/absysyearss')
        absysyear.value = response.data.data
        activeYear.value = response.data.active
    }

    const updateActiveYear = async () => {
        let response =  await axios.get('/updateyear/'+activeYear.value)
        /*         await route.push('/home') */
        window.location = 'http://127.0.0.1:8000/home'
    }

    


    
    //on resize
    window.innerWidth > 767 ? dash.value = true : dash.value = false
    window.onresize = function(){ window.innerWidth > 767 ? dash.value = true : dash.value = false }
       
   
   //on route changes
    watch(() => route.name, () => {
        title.value = route.name;
    })

    //on click out side the profile
    document.addEventListener('mouseup', function(e) {
    if (!document.getElementById('profile').contains(e.target)) { show.value = false } });
        
    //get user image
    const getuser = async () =>{
        let response = await axios.get(`/authUser`)

        imageUser.value = response.data.image
        fullName.value = response.data.firstname+' '+response.data.lastname

    };


   
    const updateStatus = async () => {
        let response = await axios.get('/updateStatus')
    }

    setInterval( updateStatus, 10000);

    
    

</script>