<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>stagPdf</title>
</head>
<style>

    h3,h4,h2,h5{
        text-align: center
       
    }
    table{
        border-collapse: collapse;
        width:max-content;  
        margin:auto
    }
    table ,th,td{
        border:1px solid black;
        text-align: center
    }
    td,th{
        padding:2px;
    }
</style>
<body>
    <h2>{{$data["houreType"]}}</h2>
    <h3>{{$data["nom_fil"]}}</h3>
    @if($data["period"] != null)
        <h4>{{$data["period"]}}</h4>
    @endif
    @if($data["groupe"] != null)
        <h5>{{$data["groupe"]}}</h5>
    @endif
    <table>
        <tr>
            <th>Nom</th>
            <th>Date</th>
            <th>Debut</th>
            <th>Fin</th>
            <th>Formateur</th>
            <th>Etat</th>
            <th>Motif</th>
            <th>Seance</th>
        </tr>
    @if($data["absences"] != [])
        @foreach($data["absences"] as $abs)
        <tr>
            <td>{{ $abs["stagiaire"]["nom_st"]." ".$abs["stagiaire"]["prenom_st"]}}</td>
            <td>{{$abs["date_abs"]}}</td>
            <td>{{$abs["duration"]["h_debut"]}}</td>
            <td>{{$abs["duration"]["h_fin"]}}</td>
            <td>{{$abs["prof"]["nom_prof"]}}</td>
            <td>{{$abs["etat_justif"]}}</td>
            <td>{{$abs["motif"]}}</td>
            <td>{{$abs["seance"]}}</td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8">Aucune Absence</td>
        </tr>
    @endif
    </table>
</body>
</html>