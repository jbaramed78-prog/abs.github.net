<?php

namespace App\Http\Resources;

use App\Models\Groupe;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Absysyear;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use PHPUnit\TextUI\XmlConfiguration\Group;

class FiliereResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $year = explode('-', Absysyear::Find(Auth::user()->year)->year);
        $year =  $year[0].$year[1];
        $model = 'App\Models\Etat'.$year;

        // $timeIn = Carbon::parse('9:30:00');
        // $timeOut = Carbon::parse('12:00:00');



        if($this->nom_st !== null){
            $nom_gp = Groupe::find($this->groupe_id)->nom_gp;

            $etats = $model::Where('stagiaire_id',$this->id)->get()->where('etat_justif','NJ');
            $sum = 0;
            
            foreach($etats as $etat){
                $startTime = Carbon::parse($etat->duration->h_debut);
                $finishTime = Carbon::parse($etat->duration->h_fin);

                $sum += $finishTime->diffInMinutes($startTime)/60;

            }

            return [
                'id' => $this->id,
                'nom_st'=> $this->nom_st,
                'prenom_st'=> $this->prenom_st,
                'nom_gp'=> $nom_gp,
                'num' => $this->numero_personnelle,
                'Nj' => $sum,
                'etat' => $etats,
                'status' => $this->status
            ];
        }

        if($this->picture_path !== null){


            if($this->status >= time()){
                $status = true;
            }else{
                $status = false;
            }

            return [
                'id' => $this->id,
                'cin'=> $this->cin,
                'firstname'=> $this->firstname,
                'lastname'=> $this->lastname,
                'email' => $this->email,
                'active' =>$this->active,
                "picture_path" => asset('/images/'.$this->picture_path),
                "status" => $status
            ];
        }

        return parent::toArray($request);

    }
}
/* About carbon */
    // 'etat' => Stagiaire::find($this->id)->absences->where('etat_justif','NJ'),
    // 'start last week' => Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d'),
    // 'end last week' => Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d'),

    // 'start current week' => Carbon::now()->startOfWeek()->format('Y-m-d'),
    // 'end current week' => Carbon::now()->endOfWeek()->format('Y-m-d'),
    // 'timediff' => $timeOut->diffInMinutes($timeIn) / 60