

<template>
    <section class="h-screen">


    <div class="flex flex-col mt-24 xl:px-16 md:px-0 sm:px-10 select-none">
           
        <div class="w-full flex justify-between xl:p-0 px-10 md:px-10 sm:p-0">

        <!-- Refresh btn -->
            <div @click="callusers()" class="py-2 px-3 mb-3 active:bg-slate-200 bg-white max-w-max max-h-max rounded-md shadow-md shadow-cyan-700 cursor-pointer hover:bg-slate-100">                
                <span class="text-cyan-600 text-3xl"><fas icon="arrow-rotate-right"/></span>
            </div>

                <!-- Add user btn -->
            <router-link  to="/addUser">
                <div class="inline-flex items-center px-5 py-3  text-base font-semibold text-white 
                    justify-around select-none bg-blue-600 rounded-md cursor-pointer w-[8.5rem] hover:bg-blue-700">
                    Add User
                    <fas icon="plus" />
                </div>
            </router-link>

        </div>

            
        <!-- Table -->
        <div class="flex flex-col justify-center  rounded-md">

            <div class="w-full mx-auto bg-white shadow-lg rounded-md border border-gray-200">
                <div class="p-3 w-full  rounded-md">
                <div class="overflow-y-scroll h-[23rem]  rounded-md">
                    <table class="table-auto w-full  rounded-md">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50 rounded-md">

                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Name</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Email</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Status</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Edit</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Delet</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold">Active</div>
                                </th>
                            </tr>

                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                             <tr v-for="user in users" :key="user.id">
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 flex items-center mr-4">
                                        <img class="w-10 h-10 lg:mr-6 mr-3 rounded-full" :src="user.picture_path">
                                        {{user.firstname}} {{user.lastname}}
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap text-sm text-gray-500">
                                    <div class="ml-4">{{user.email}}</div>
                                </td>

                                <td class="p-2 whitespace-nowrap">
                                    <div>
                                        <span v-if="user.status"
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                            Online
                                        </span>
                                        <span v-if="!user.status"
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-400 bg-gray-200 rounded-full">
                                            Offline
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <!-- Edit btn -->
                                    <router-link :to='"/editUser/"+user.id'>
                                        <div class="cursor-pointer opacity-[0.7] hover:opacity-[1] hover:scale-110 max-w-max max-h-max">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                    </router-link>
                                </td>
                                <td>
                                    <!-- Delet btn -->
                                    <div class="text-red-500 cursor-pointer opacity-[0.7] hover:opacity-[1] hover:scale-110 max-w-max max-h-max">
                                        <button @click="deleteThis" :title="user.id" class=" absolute w-[1.5rem] h-[1.5rem] opacity-0"></button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </td>
                                <td>
                                    <!-- active btn -->
                                    <div class="relative flex justify-center items-center">
                                        <div class="checkPrent flex justify-center items-center">
                                            <input :checked="user.active" :value="user.id" @click="activeEvent" type="checkbox" class="checkbox">
                                        </div>  
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>

        </div>
  
    </div>


</section>
</template>

<script setup>
    import { ref, onMounted } from "vue"
    import axios from "axios";
    import { useToast } from "vue-toastification";

    const users = ref(null)
    const wait =ref(false)
    const toast = useToast();

    

    onMounted(()=>{
        getusers()
    })

    /* Get all useres we have in database */
    const getusers = async () =>{
        let response = await axios.get(`/allUsers`)

        var data = response.data.data
        var online = []
        var offline = []


        /* TRie */
        for(let i = 0 ; i< data.length ;i++){

            if(data[i].status == true){

                online.push(data[i])

            }else{
                offline.push(data[i])
            }
        }

        users.value = online.concat(offline)

    };

    /* Get id of user on event and call our functions to delet him  */
    const deleteThis = (event) => {

        sweetalert(event.target.title)
        getusers()
    }

    const updateActive = async (id,element) => 
    {
        axios.post('/updateActive',{ id: id , active: !element.checked})
        .then((response) => {
            element.checked = !element.checked
            Swal.fire(
                'Suprimé!',
                'Le compte a été supprimé.',
                'success'
            )
            
        }).catch((error) => {  Error() });

        
    }

    const deletUserById = async (id) =>{
        
        let response = await axios.get(`/allUsers/${id}`)
        console.log(response.data)
 
    };

    const activeEvent = (event) => {
        event.target.checked = !event.target.checked

        var id = event.target.value
        /* var active = event.target.checked */
        sweetactive(id,event.target)
    }


    /* For refresh btn and we set timout for spam click :D */
    const callusers = () =>{
        if (wait.value) {
            return;
        }

        getusers()
        wait.value  = true;

        setTimeout(function() {
            wait.value = false;
        }, 500);
    }

    /* Alert to confirme for delete user */
    const sweetalert = (id) => {
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
                deletUserById(id)
                getusers()
                Swal.fire(
                'Suprimé!',
                'Le compte a été supprimé.',
                'success'
                )
            }
        })
    }
    const sweetactive = (id,element) => {
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
                updateActive(id,element)
            }
        })
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