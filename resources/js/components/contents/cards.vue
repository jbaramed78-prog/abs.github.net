

<template>
<section id="dashboard-cards" class="font-bold text-sm ">
    <!-- --first card -->


        <div class="card">
            <hr class="px-16 my-5 mt-6">
            <h2 class="px-6 mb-4 text-xs uppercase font-bold text-gray-500 ">Admin section</h2>
            <div class="grid gap-5 px-6 text-gray-400">

                <router-link to="/home" @click="$emit('update:modelValue',check())">
                    <fas icon="user" />
                    <span>Dashboard</span>
                </router-link>

                <template v-if="boolean">
                    <router-link to="/add" @click="$emit('update:modelValue',check())">
                        <fas icon="user-graduate" />
                        <span>Ajouter l'absence</span>
                    </router-link>
                
                    <template v-if="adminSection">
                        <router-link to="/just" @click="$emit('update:modelValue',check())">
                            <fas icon="user-graduate" />
                            <span>Justifier l'absence</span>
                        </router-link>
                    </template>
                </template>

                <router-link to="/SearchByDate" @click="$emit('update:modelValue',check())">
                    <fas icon="user-graduate" />
                    <span class="text-center ">Les Absences</span>
                </router-link>
                <router-link to="/detail" @click="$emit('update:modelValue',check())">
                    <fas icon="user-graduate" />
                    <span class="text-center ">Detail Class</span>
                </router-link>
                
            </div>
        </div>


    <!-- --second card -->

        <template v-if="adminSection && boolean">

            <div class="card">
                <hr class="px-16 my-5 mt-7">
                <h2 class="px-6 mb-4 text-gray-500 text-xs uppercase font-bold ">Admin section</h2>
                <div class="grid gap-5 px-6 text-gray-400">

                    <router-link to="/impressions" @click="$emit('update:modelValue',check())">
                        <fas icon="user-graduate" />
                        <span>Impressions</span>
                    </router-link>

                    <router-link to="/User" @click="$emit('update:modelValue',check())">
                        <fas icon="user-graduate" />
                        <span>Update Users</span>
                    </router-link>
                    
                    <router-link to="/editEtat" @click="$emit('update:modelValue',check())">
                        <fas icon="user-graduate" />
                        <span>Update Absence</span>
                    </router-link>

                    <router-link to="/Estg" @click="$emit('update:modelValue',check())">
                        <fas icon="user-graduate" />
                        <span>Update Stagiaiare</span>
                    </router-link>
                        
                    <router-link to="/settings" @click="$emit('update:modelValue',check())">
                        <fas icon="user-graduate" />
                        <span>Settings</span>
                    </router-link>

                </div>
            </div>

        </template>


        
</section>
</template>

<script setup>

    import { ref, onBeforeMount } from 'vue';
    import axios from "axios";

    defineProps(['modelValue'])
    defineEmits(['update:modelValue'])
    
    const adminSection = ref(false)

    const boolean = ref(false);


    const getuser = async () =>{
        let response = await axios.get(`/authUser`)

        if(response.data.role === "admin"){
            adminSection.value = true
        }

    };

    const getyear = async () =>{
        let response = await axios.get(`/absysYear`)
        boolean.value = response.data
    };

    onBeforeMount(() => {
        getyear()
        getuser()
    })

    const check = () => {
        var stmt = null
        window.innerWidth > 767 ? stmt = true : stmt =false
        return stmt
    }

</script>


<style scoped>
    .router-link-active{
        color: rgb(2 132 199);
    }
    span{
        margin-left: 7px;
    }
</style>