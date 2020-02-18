<?php
class View
{
    private $listevar;
    private $listLinks;
    private $listScripts;


    public function ajouterLink($dossier, $valeur)
    {
        $this->listLinks[$valeur] = $dossier;
    }
    public function ajouterScript($dossier, $valeur)
    {
        $this->listScripts[$valeur] = $dossier;
    }

    public function afficher($displayfile)
    {
        extract($this->listevar);
        echo '<!doctype html>';
        echo '<html lang="fr">';
        echo '<head>';
        include VIEWS . DS . 'common' . DS . 'head.php';
        if (isset($this->listLinks)) {
            foreach ($this->listLinks as $l => $val) {
                echo '<link href="' . LOCAL_VENDORS . DS . $val . DS . "css" . DS . $l . '.css" rel="stylesheet">';
            }
        }
        echo '</head>';
        echo '<body>';
        echo '<div class="contain">';
        include VIEWS . DS . 'common' . DS . 'nav.php';
        echo '<div class="main">';
        include VIEWS . DS . strtolower($displayfile) . ".php";
        echo '</div>';
        echo '</div>';
        include VIEWS . DS . 'common' . DS . 'bs_js.php';

        echo '</body></html>';
    }

    public function __construct()
    {
        $this->listevar = [];
    }
    public function ajouterVariable($nom, $valeur)
    {
        $this->listevar[$nom] = $valeur;
    }


    public function afficherLogin()
    {
        extract($this->listevar);
        echo '<!doctype html>';
        echo '<html lang="fr">';
        echo '<head>';
        include VIEWS . DS . 'common' . DS . 'head.php';
        echo '<link href="' . LOCAL_VENDORS . DS . "personal" . DS . "css" . DS . "login" . '.css" rel="stylesheet">';
        echo '<link href="' . LOCAL_VENDORS . DS . "font-awesome" . DS . "css" . DS . "font-awesome.min" . '.css" rel="stylesheet">';

        echo '</head><body>';
        include VIEWS . DS . 'login_index.php';
        include VIEWS . DS . 'common' . DS . 'bs_js.php';
        echo '</body></html>';
    }
}