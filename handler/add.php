<?php 
    if (isset($_POST['submit']) 
    && $_POST['submit'] == 'zakazi' 
    && isset($_POST['predmet'] ) 
    && isset($_POST['katedra'] )
    && isset($_POST['sala'] )
    && isset($_POST['datum'] ) ) {
        $prijava = new Prijava(null, $_POST['katedra'],$_POST['predmet'],$_POST['sala'],$_POST['datum']);
        $status = Prijava::add($prijava, $conn);
        if ($status) {
            echo "Uspesno ste kreirali novu prijavu";
        } else {
            echo "Doslo je do problema prilikom kreiranja prijave";
        }
        
    }
?>