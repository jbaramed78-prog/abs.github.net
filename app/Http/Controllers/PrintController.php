<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

use App\Http\Controllers\Api\FiliereController;
use App\Models\Absysyear;
use App\Models\Groupe;
use App\Models\Relation;
use App\Models\Stagiaire;
use PHPUnit\TextUI\XmlConfiguration\Group;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Settings;
class PrintController extends Controller
{
    public function loadStagPdf(Request $request, FiliereController $fil)
    {

  
        $dataa = [
            "info" => $request->info,
        ];
        $pdf = Pdf::loadView('pdfs.stagPdf',compact("dataa"));
        // return $pdf->stream($data["stFullName"].rand(1,50).'.pdf');
        return Response($pdf->output(),200,[
            'Content-Type' => 'application/pdf',
        ]);        
       
    }
    public function loadSearchPdf(Request $request)
    {   
        
        $absences = $request->absence;
        $nom_fil = $request->fil;
        $groupe = $request->groupe;
        $houreType = $request->houreType;
        $period = $request->period;
        $data = [
            "nom_fil" => $nom_fil,
            "absences"=>$absences,
            "groupe"=>$groupe,
            "period"=>$period,
            "houreType"=>$houreType
        ];
        $pdf = Pdf::loadView('pdfs.datePdf',compact("data"));
        return Response($pdf->output(),200,[
            'Content-Type' => 'application/pdf',
        ]);
       
    }
    public function loadPresencePdf(Request $request){
        $groupe_id_arr = $request->groupes;
        $type= $request->type;
        $DR = "DRCS";
        $anneeScolaire = Absysyear::where("current",1)->get("year")[0]["year"];
        $complexe = "CF ANFA";
        $institut = "ISTA EL HANK CASABLANCA";
        $data = [];
        foreach($groupe_id_arr as $groupe_id){
            $groupe = Groupe::with('filiere')->where('id',$groupe_id)->get()[0];
            $niveau = $groupe->filiere->niveau;
            $nom_fil = $groupe->filiere->nom_fil;
            $nom_gp = $groupe->nom_gp;
           
            $stagiaires = Groupe::find($groupe_id)->stagiaires->map(function($item){
                return $item->only("id","matricule_st","nom_st","prenom_st");
            });
            $nbre=$stagiaires->count();
            array_push($data,[
                "anneeScolaire"=>$anneeScolaire,
                "type"=>$type,
                "dr"=>$DR,
                "complexe"=>$complexe,
                "institut"=>$institut,
                "niveau"=>$niveau,
                "filiere"=>$nom_fil,
                "groupe"=>$nom_gp,
                "nbre"=>$nbre,
                "stagiaires"=>$stagiaires
            ]);
        }
    
       
        // $tempPath= public_path("temps/Feuille_de_Presence.docx");
        // $templateProcessor = new TemplateProcessor($tempPath);
        
        // $templateProcessor->cloneRowAndSetValues('id', $stagiaires);

        // $pathToSave = public_path("/prints/anas.docx");
        // $templateProcessor->saveAs($pathToSave);
        // return "done";
        
        $pdf = Pdf::loadView('pdfs.presence',compact("data"));
        return Response($pdf->output(),200,[
            'Content-Type' => 'application/pdf',
        ]);
    }
    public function envParModule(Request $request)
    {
        $selected_modules = $request->modules;
        

    
        
        $data = Relation::whereIn("module_id",$selected_modules)->get();
        
        
    
    
        $pdf = Pdf::loadView('pdfs.env',compact("data"));
        return Response($pdf->output(),200,[
            'Content-Type' => 'application/pdf',
        ]);
    }
    public function envParProf(Request $request)
    {
        $profs = $request->profs;
        $data = Relation::whereIn("prof_id",$profs)->get();
        
        // return $data;
        $pdf = Pdf::loadView('pdfs.env',compact("data"));
        return Response($pdf->output(),200,[
            'Content-Type' => 'application/pdf',
        ]);
    }
}
