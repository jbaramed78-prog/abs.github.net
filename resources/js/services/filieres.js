import { ref } from "vue"; 
import axios from "axios";
import { useToast } from "vue-toastification";
export default function useFilieres(){

    const toast = useToast();
    const filieres = ref([])
    const groupes = ref(null)
    const stagiaires = ref(null)
    const profs = ref([])
    const etats = ref(null)
    const add_status = ref(false)
    const justif_status = ref(false)
    const user = ref()
    const allEtats = ref(null)
    const admin = ref(false)
    const nom_gp = ref(null)
    const prof_id = ref(null)

    const getFilieres = async () => {
        let response = await axios.get("/filieres")
        filieres.value = response.data.data
        response.data.prof_id ? prof_id.value = response.data.prof_id : admin.value = true

    };

    const getgroupes = async (filiere_id) =>{
        let response = await axios.get(`/filieres/${filiere_id}`)
        groupes.value = response.data.data
    };

    const getstagiaires = async (groupe_id,clean) =>{
        let response = await axios.get(`/groupes/${groupe_id}`)
        stagiaires.value = response.data.data
        console.log(clean)

        nom_gp.value = stagiaires.value[0].nom_gp

        if(clean){
            stagiaires.value = stagiaires.value.filter((e) => e.Nj > 0);
        }
        
        if(prof_id.value ==  null ){ getprofs(groupe_id) }
        
    };
    

    const getprofs = async (groupe_id) =>{
        let response = await axios.get(`/profs/${groupe_id}`)
        profs.value = response.data.data

    };

    const getuser = async () =>{
        let response = await axios.get(`/user`)
        user.value = response.data

    };

    const getetats = async (id, period , limitD , limitF) =>{
        let response = await axios.get(`/etats/${id}/${period}/${limitD}/${limitF}`)
        etats.value = response.data.data
        allEtats.value = response.data.data
        console.log(allEtats.value)
    };

    const addAbsence = (st_ids,prof_id,duration_id,seance,date_abs,reset,errorNet) => {
        // send a POST request
        if(date_abs==""){
            Swal.fire("You Need To Choose A Correct Date ")
        }else{
            axios.post('/addAbsence', {
            stagiaire_ids:st_ids,
            prof_id: prof_id,
            duration_id:duration_id,
            seance:seance,
            date_abs:date_abs
            }).then((response) => {
            reset(response.data.message)
            }).catch((error) => { errorNet() });
        }
        
    }

    const addJustif = (abs_ids,motif,manualle_motif,reset) => {
        // send a POST request
        axios.post('/addJustif', {
            absences_ids:abs_ids,
            motif: motif,
            manualle_motif:manualle_motif,})
        .then((response) => {success("justification ajoutée avec succés"), reset()})
        .catch((error) => {  errorNet() });
    }

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
    

    return { filieres , prof_id , admin , groupes , stagiaires, allEtats , getFilieres , profs , getgroupes , justif_status , addJustif,
            getstagiaires , nom_gp , getetats , addAbsence , user , getuser , add_status, etats };

    
}