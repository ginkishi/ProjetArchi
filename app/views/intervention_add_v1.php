<!--version 1 -->
<?php
require_once(".." . DS . API_DIRNAME . "/API.php");
$typeList = API::getTypeInterventionList();
$typeVehicule = API::getAllVehiculesIndicatif();
?>
<div class="form-container">
    <h1>Compte-rendu d'intervention</h1>
    <div class="formulaire">
        <form action="../intervention/addinterventiontobdd" method="post">
            <h3>INTERVENTION</h3>
            <div class="section">
                <label>Num&eacute;ro d'intervention <span class="important">*</span>: <input type="text" name="numIntervention"></label>
                <label>OPM : <input type="checkbox" name="opm"></label>
                <label for="">Adresse <span class="important">*</span>: <input type="text" name="adresse"></label>
                <label for="">Commune <span class="important">*</span>: <input type="text" name="commune"></label>
                <label for="">Type d'intervention <span class="important">*</span>: <select name="typeIntervention" id="typeIntervention">
                <option value="">Selectionner un type d'intervention</option>
            <?php
                while ($donnees = $typeList->fetch())
                {
                ?>
               <option value="<?php
                    
                 $output = htmlentities($donnees['TI_DESCRIPTION'], 0, "UTF-8");
                    if ($output == "") 
                    {
                     $output = htmlentities(utf8_encode($donnees['TI_DESCRIPTION']), 0, "UTF-8"); 
                    }
                    echo $output;
                 ?>"> 
                  <?php 
                  $output = htmlentities($donnees['TI_DESCRIPTION'], 0, "UTF-8");
                    if ($output == "")
                     {
                    $output = htmlentities(utf8_encode($donnees['TI_DESCRIPTION']), 0, "UTF-8"); 
                     }
                     echo $output;
                     ?> 
                 </option>
                    <?php
                    }
                    ?>   
                </select></label> 

               
                <label for="">Important : <input type="checkbox" name="important"></label>
                <label for="">Requ&eacute;rant <span class="important">*</span>: <select name="requerant" id="requerant">
                        <option value="CODIS">CODIS</option>
                        <option value="Alerte Locale">Alerte locale</option>
                    </select></label>
                <label for=""></label>
                <label for="">Date de déclenchement <span class="important">*</span>: <input type="date" name="dateDeclenchement" value="<?php echo date('Y-m-d'); ?>"></label>
                <label for="">Heure de déclenchement <span class="important">*</span>: <input type="time" name="heureDeclenchement" value="<?php echo  date('H:i'); ?>"></label>
                <label for="">Date de fin <span class="important">*</span>: <input type="date" name="dateFin" value="<?php echo date('Y-m-d'); ?>"></label>
                <label for="">Heure de fin <span class="important">*</span>: <input type="time" name="heureFin" value="<?php echo  date('H:i'); ?>"></label>
            </div>
            <h3>ENGINS ET PERSONNEL</h3>
            <div class="section">
                <label for="">Nom de l'engin : <select name="typeEngin" id="nomEngin">
                        <option value="">Selectionner un v&eacute;hicule</option>
                    

                        <?php
                while ($vehicule = $typeVehicule->fetch())
                {
                ?>
               <option value="<?php
                    
                 $output = htmlentities($vehicule['V_INDICATIF'], 0, "UTF-8");
                    if ($output == "") 
                    {
                     $output = htmlentities(utf8_encode($vehicule['V_INDICATIF']), 0, "UTF-8"); 
                    }
                    echo $output;
                 ?>"> 
                  <?php 
                  $output = htmlentities($vehicule['V_INDICATIF'], 0, "UTF-8");
                    if ($output == "")
                     {
                    $output = htmlentities(utf8_encode($vehicule['V_INDICATIF']), 0, "UTF-8"); 
                     }
                     echo $output;
                     ?> 
                 </option>
                    <?php
                    }
                    ?> 
                
                </select></label>
                       
                  
                <label for="">Ronde : <input type="checkbox" name="ronde"></label>
                <label for="">Date de d&eacute;part <span class="important">*</span>: <input type="date" name="dateDepart" value="<?php echo date('Y-m-d'); ?>"></label>
                <label for="">Heure de d&eacute;part <span class="important">*</span>: <input type="time" name="heureDepart" value="<?php echo  date('H:i'); ?>"></label>
                <label for="">Date d'arriv&eacute;e sur le lieux : <input type="date" name="dateArrivee" value="<?php echo date('Y-m-d'); ?>"></label>
                <label for="">Heure d'arriv&eacute;e sur le lieux : <input type="time" name="heureArrivee" value="<?php echo  date('H:i'); ?>"></label>
                <label for="">Date de retour <span class="important">*</span>: <input type="date" name="dateRetour" value="<?php echo date('Y-m-d'); ?>"></label>
                <label for="">Heure de retour <span class="important">*</span>: <input type="time" name="heureRetour" id="here5" value="<?php echo  date('H:i'); ?>"></label>
                <input type="button" id="addEngin" onclick="addField()" value="Ajouter un autre véhicule" >
                <script>
function addField() {
    console.log("bonjour");
    
// creation de plusieurs engins 
}
</script>

            </div>
            <h3>RESPONSABLE</h3>
            <div class="section">
                <label for="">Nom du responsable : <input type="text" name="responsable" value="admin admin"></label>
            </div>
            <input type="submit" value="Sauver">
        </form>
    </div>
</div>