<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/autoload.php');
    use Dompdf\Dompdf; 
    use Dompdf\Options;
    $id;
    $type;

    if(isset($_GET['type']) && isset($_GET['id'])){
        $id = mysqli_real_escape_string($database->connection, $_GET['id']);
        $type = mysqli_real_escape_string($database->connection, $_GET['type']);
    }  

    ob_start();
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);
    include($_SERVER['DOCUMENT_ROOT'].'/templates/purchaseorder.php');
    $html = ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('Legal', 'portrait'); 
    $dompdf->render(); 
    ob_end_clean();
    $dompdf->stream("generatedPO_transtrack",array("Attachment" => false));
    exit(0);
?>