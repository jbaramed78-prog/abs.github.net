<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feuille de presence</title>
    <style>
            *{
                padding:0;
                margin:0;
                box-sizing: border-box;
            }
        body{
            font-family: "dejavu sans", serif!important;
        }
       .header{
            margin-top: 10px;
        
            width:100vw;
            height: 60px;
            display: flex;
            justify-content: space-evenly
            

       }
       .logo{
       
            position: relative;
            top:10px;
            left:10px

       }

        .h{
           
            position: relative;
            top:10px;
            left:115px
        }
            .stTable, .stTable  td , .stTable th {
                border: 1px solid black;
            }
      
            .stTable{
               
                width:100%;
                border:1px solid black;
                border-collapse: collapse;
                margin-bottom: 5px;
            }
            .stTable tr th{
                font-weight:500;
                padding: 5px;
                padding-bottom:10px; 
            }

            .stTable tr td{
                font-size: 10px;
                padding: 2px;
                text-align: left;
               
            }
           
            .groupeInfo{
                border:none;
                font-size: 11px;
                
            }
            .classInfo{
                border:none;
                font-size: 11px;
                float: right;
            }
            .underline{
                text-decoration: underline;
            }
            .text-center{
                text-align:center
            }
            .text-semibold{
                font-weight: 700;
            }
            .clearfix::after {
                content: "";
                clear: both;
                display: table;
            }
            th{
                word-wrap: break-word
            }
            
    </style>
</head>
<body>
    @foreach($data as $d)
    
    <section style="max-height: 1090px;height:1090px;border:1px solid transparent">
        <div style="text-align: center;margin-top:100px">
            <h1 style="border:3px solid black;display:inline-block;padding:5px 100px">Enveloppe Examen</h1>
        </div>
        <h2 style="margin-top:45px;padding-left: 100px">L'enveloppe contient :</h2>
        <ul style="font-weight: bolder;font-size:25px;margin-top:15px;padding-left:150px;list-style-image:url('{{public_path("/img/listStyle.png")}}')">
            <li >Copies examen</li>
            <li >Enoncé Epreuve </li>
            <li >PV de note</li>
            <li >Détail notes</li>
            <li >Feuille de présence</li>
        </ul>
      
            <h2 style="font-weight:bolder;text-align: center;margin-top:35px;font-size:22px;margin-bottom:50px">EXAMEN DE FIN DE MODULE - LOCAL</h2>

        <table style="margin:0 auto;font-size:18px;width: 500px">
            <tr>
                <th style="text-align: left"><p style="padding-right: 50px">Etablissement</p></th>
                <th style="text-align: left">:&nbsp;ISTA EL HANK CASABLANCA</th>
            </tr>
            <tr>
                <th style="text-align: left">Niveau</th>
                <th style="text-align: left">:&nbsp;{{$d['groupe']['filiere']['niveau']}}</th>
            </tr>
            <tr>
                <th style="text-align: left">Filière</th>
                <th style="text-align: left">:&nbsp;{{$d['groupe']['filiere']['nom_fil']}}</th>
            </tr>
            <tr>
                <th style="text-align: left"> Module</th>
                <th style="text-align: left">:&nbsp;{{$d['module']['nom_module']}}</th>
            </tr>
            <tr>
                <th style="text-align: left">Groupe</th>
                <th style="text-align: left">:&nbsp;{{$d['groupe']['nom_gp']}}</th>
            </tr>
            <tr>
                <th style="text-align: left">Type examen</th>
                <th style="text-align: left">:&nbsp;</th>
            </tr>
        </table>


        <h3 style="margin-left:100px; margin-top:100px">Formateur responsable:<strong>{{$d['prof']['nom_prof']}}</strong></h3>
        
    </section>
    <section style="max-height: 1090px;height:1090px;border:1px solid transparent">
        <div style="text-align: center;margin-top:100px">
            <h1 style="border:3px solid black;display:inline-block;padding:5px 100px">Enveloppe Examen</h1>
        </div>
        <h2 style="margin-top:45px;padding-left: 100px">L'enveloppe contient :</h2>
        <ul style="font-weight: bolder;font-size:25px;margin-top:15px;padding-left:150px;list-style-image:url('{{public_path("/img/listStyle.png")}}')">
            <li >Copies examen</li>
            <li >Enoncé Epreuve </li>
            <li >PV de note</li>
            <li >Détail notes</li>
            <li >Feuille de présence</li>
        </ul>
      
            <h2 style="font-weight:bolder;text-align: center;margin-top:35px;font-size:22px;margin-bottom:50px">CONTROLE CONTINU N°1</h2>

        <table style="margin:0 auto;font-size:18px;width: 500px">
            <tr>
                <th style="text-align: left"><p style="padding-right: 50px">Etablissement</p></th>
                <th style="text-align: left">:&nbsp;ISTA EL HANK CASABLANCA</th>
            </tr>
            <tr>
                <th style="text-align: left">Niveaux</th>
                <th style="text-align: left">:&nbsp;{{$d['groupe']['filiere']['niveau']}}</th>
            </tr>
            <tr>
                <th style="text-align: left">Filière</th>
                <th style="text-align: left">:&nbsp;{{$d['groupe']['filiere']['nom_fil']}}</th>
            </tr>
            <tr>
                <th style="text-align: left"> Module</th>
                <th style="text-align: left">:&nbsp;{{$d['module']['nom_module']}}</th>
            </tr>
            <tr>
                <th style="text-align: left">Groupe</th>
                <th style="text-align: left">:&nbsp;{{$d['groupe']['nom_gp']}}</th>
            </tr>
            <tr>
                <th style="text-align: left">Type examen</th>
                <th style="text-align: left">:&nbsp;</th>
            </tr>
        </table>


        <h3 style="margin-left:100px; margin-top:100px">Formateur responsable:<strong>{{$d['prof']['nom_prof']}}</strong></h3>
        
    </section>
    <section style="max-height: 1090px;height:1090px;border:1px solid transparent">
        <div style="text-align: center;margin-top:100px">
            <h1 style="border:3px solid black;display:inline-block;padding:5px 100px">Enveloppe Examen</h1>
        </div>
        <h2 style="margin-top:45px;padding-left: 100px">L'enveloppe contient :</h2>
        <ul style="font-weight: bolder;font-size:25px;margin-top:15px;padding-left:150px;list-style-image:url('{{public_path("/img/listStyle.png")}}')">
            <li >Copies examen</li>
            <li >Enoncé Epreuve </li>
            <li >PV de note</li>
            <li >Détail notes</li>
            <li >Feuille de présence</li>
        </ul>
      
            <h2 style="font-weight:bolder;text-align: center;margin-top:35px;font-size:22px;margin-bottom:50px">CONTROLE CONTINU N°2</h2>

        <table style="margin:0 auto;font-size:18px;width: 500px">
            <tr>
                <th style="text-align: left"><p style="padding-right: 50px">Etablissement</p></th>
                <th style="text-align: left">:&nbsp;ISTA EL HANK CASABLANCA</th>
            </tr>
            <tr>
                <th style="text-align: left">Niveau</th>
                <th style="text-align: left">:&nbsp;{{$d['groupe']['filiere']['niveau']}}</th>
            </tr>
            <tr>
                <th style="text-align: left">Filière</th>
                <th style="text-align: left">:&nbsp;{{$d['groupe']['filiere']['nom_fil']}}</th>
            </tr>
            <tr>
                <th style="text-align: left"> Module</th>
                <th style="text-align: left">:&nbsp;{{$d['module']['nom_module']}}</th>
            </tr>
            <tr>
                <th style="text-align: left">Groupe</th>
                <th style="text-align: left">:&nbsp;{{$d['groupe']['nom_gp']}}</th>
            </tr>
            <tr>
                <th style="text-align: left">Type examen</th>
                <th style="text-align: left">:</th>
            </tr>
        </table>


        <h3 style="margin-left:100px; margin-top:100px">Formateur responsable:<strong>{{$d['prof']['nom_prof']}}</strong></h3>
        
    </section>
    @endforeach
</body>
</html>