<?php


include_once dirname(__FILE__) . "\..\connectBDD.php";
require_once(".." . DS . API_DIRNAME . "/API.php");
class InterventionM
{
    private $con;

    function __construct()
    {
        $dbconnect = new DBConnect();
        $this->con = $dbconnect->connect();
        echo "je suis connecté yay 2!";
    }


    public function AddIntervention($numIntervention, $adresse, $commune,$opm,$typeIntervention,$important,$requerant,$dateDeclenchement,$heureDeclenchement,$dateFin,$heureFin,$responsable)
    {   echo "je suis connecté yay 1!";

     /* echo   $numIntervention."<br>".$adresse."<br>".$commune."<br>".$typeIntervention."<br>".$dateDeclenchement."<br>".$heureDeclenchement."<br>";
     
        echo $dateFin."<br>";
        echo $heureFin."<br>";
        echo $responsable."<br>"; */
        $res=explode(" ", $responsable);
      
        $prenom=$res[0];
        $nom=$res[1];
        $datedec=$dateDeclenchement." ".$heureDeclenchement;
        $datef=$dateFin." ".$heureFin;
        //2012-12-02 00:00:00
      $type = API::getCodeTypeIntervention($typeIntervention);
      $idresp = API::getPompierID($prenom,$nom);
      /* echo $idresp;
       echo $type;
       echo "fin";*/ 
       $this->con->query("INSERT INTO  interventions VALUES(0,$numIntervention,$opm,'$commune','$adresse',
       '$type',$important,'$requerant','$datedec','$datef',$idresp,1);");
    }
}