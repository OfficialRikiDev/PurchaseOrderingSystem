<?php
$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
include_once($_SERVER['DOCUMENT_ROOT'] . '/autoload.php');


function getBaseImage($path)
{
    $imageData = base64_encode(file_get_contents($path));
    $src = 'data:' . mime_content_type($path) . ';base64,' . $imageData;
    return $src;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order</title>

    <style>

        body {
            width: 100%;
            min-width: 100%;
        }

        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .frm, .frm th, .frm td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 2px;
            width: 100%;
        }

        .white-table, .white-table th, .white-table td {
            border: 1px solid white;
            border-collapse: collapse;
            padding: 2px;
            width: 100%;
        }
    </style>
</head>
<body>
    <table style="width: 100%">
        <tr>
            <td style="width: auto">
                <img style="padding-right: 20px" src="<?php echo getBaseImage($_SERVER['DOCUMENT_ROOT'] . '/assets/elpardologo.png');?>" width="70px" height="70px">
        
            </td>
            <td style="width: 100%">
            <span style="font-weight: bold; width: 100%; margin-top: .5%;">El Pardo Transport Cooperation<br>
        <span style="font-weight: normal;">
            #2 Honeyville Route 1, Quiot, Cebu City<span style="margin-left: 45%;">No. <?php echo $id;?></span>  <br>
            Mobile No.  
            <span style="color: red;"> 0917-7705524 / 0923-9817336</span>
            <br>
            CDA Reg. No. <span style="color:blue">9520-1070000000046641 OTC Accreditation No. 2019- 305</span>
        </span>
            </td>
        </tr>
        
    </table>
    <br>
    <h3 style="text-align: center;">PURCHASE ORDER</h3>
    <br>
    <table style="width: 100%;" class="frm">
        <tr>
            <th colspan="2">
                VENDOR DETAILS
            </th>
            <th colspan="3">
                DELIVERY DETAILS
            </th>
        </tr>
        <tr>
            <td rowspan="2" colspan="2">
            </td>
            <th style="width: 8%;">Date:</th>
            <th  colspan="2" style="width: 50%;"></th>
        </tr>
        <tr>
            <th>Plate Number:</th>
            <th colspan="2"></th>
        </tr>
        <tr>
            <th style="width: 40px;">No</th>
            <th style="width: 250px;">Description</th>
            <th >Qty</th>
            <th style="width: 130px;">Unit Price</th>
            <th style="width: 170px;">Total</th>
        </tr>
        <?php 
            $data = $orders->getPOSFormData($id);
            $objects = json_decode($data['itemData']);
            $content = "";
            $increment = 1;
            $total = 0.0;
            foreach($objects as $item){     
                $itemData = $orders->getItemData($item->id);
                $content .= '<tr>
                <td style="text-align:center">'.$increment.'</td>
                <td style="text-align:center">'.$itemData['name'].'</td>
                <td style="text-align:center">'.$item->quantity.'</td>
                <td style="text-align:center"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>'.number_format($itemData['price'], 2).'</td>
                <td style="text-align:center"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>'.number_format($item->quantity * $itemData['price'], 2).'</td>
            </tr>';
                $increment++;
                $total += (double) $item->quantity * (double) $itemData['price'];
            }
            echo $content; 
        ?>
        <tr>
            <th colspan="4">Total</th>
            <td style="text-align:center"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span><?php echo number_format($total, 2);?></td>
        </tr>
        <tr>
            <td colspan="5" style="padding: 25px; ">
                <table class="white-table">
                    <tr>
                        <td> <span>Issued by: __________________ </span><br >
                <span style="padding-left: 25%">Fuel In-charge</span></td>
                        <td> <span style="margin-left: 40%;">Conforme: __________________<br >
                <span style="margin-left: 75%;">Driver</span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><br>
                        <span style="margin-left: 25%;">Payment recieved by: _________________________<br >
                <span style="margin-left: 45.5%;">EPTC Personal In-Charge</span></td>
                        </td>
                    </tr>
                </table>
                </span>
                
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="width: auto">
                <img style="padding-right: 20px" src="<?php echo getBaseImage($_SERVER['DOCUMENT_ROOT'] . '/assets/elpardologo.png');?>" width="70px" height="70px">
        
            </td>
            <td style="width: 100%">
            <span style="font-weight: bold; width: 100%; margin-top: .5%;">El Pardo Transport Cooperation<br>
        <span style="font-weight: normal;">
            #2 Honeyville Route 1, Quiot, Cebu City<span style="margin-left: 45%;">No. <?php echo $id;?></span>  <br>
            Mobile No.  
            <span style="color: red;"> 0917-7705524 / 0923-9817336</span>
            <br>
            CDA Reg. No. <span style="color:blue">9520-1070000000046641 OTC Accreditation No. 2019- 305</span>
        </span>
            </td>
        </tr>
        
    </table>
    <br>
    <h3 style="text-align: center;">PURCHASE ORDER</h3>
    <br>
    <table style="width: 100%;" class="frm">
        <tr>
            <th colspan="2">
                VENDOR DETAILS
            </th>
            <th colspan="3">
                DELIVERY DETAILS
            </th>
        </tr>
        <tr>
            <td rowspan="2" colspan="2">
            </td>
            <th style="width: 8%;">Date:</th>
            <th  colspan="2" style="width: 50%;"></th>
        </tr>
        <tr>
            <th>Plate Number:</th>
            <th colspan="2"></th>
        </tr>
        <tr>
            <th style="width: 40px;">No</th>
            <th style="width: 250px;">Description</th>
            <th >Qty</th>
            <th style="width: 130px;">Unit Price</th>
            <th style="width: 170px;">Total</th>
        </tr>
        <?php 
            $data = $orders->getPOSFormData($id);
            $objects = json_decode($data['itemData']);
            $content = "";
            $increment = 1;
            $total = 0.0;
            foreach($objects as $item){     
                $itemData = $orders->getItemData($item->id);
                $content .= '<tr>
                <td style="text-align:center">'.$increment.'</td>
                <td style="text-align:center">'.$itemData['name'].'</td>
                <td style="text-align:center">'.$item->quantity.'</td>
                <td style="text-align:center"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>'.number_format($itemData['price'], 2).'</td>
                <td style="text-align:center"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>'.number_format($item->quantity * $itemData['price'], 2).'</td>
            </tr>';
                $increment++;
                $total += (double) $item->quantity * (double) $itemData['price'];
            }
            echo $content; 
        ?>
        <tr>
            <th colspan="4">Total</th>
            <td style="text-align:center"><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span><?php echo number_format($total, 2);?></td>
        </tr>
        <tr>
            <td colspan="5">
                <h4>Payment Terms & Condition</h4>
                <h4>Option 1: 30 days</h4>
                <h4>Note:</h4> <span> Please write the quantity in letter and the total amount base on the invoice.</span>
                <p></p>
            </td>
        </tr>
        <tr>
        <td colspan="5" style="padding: 25px; ">
                <table class="white-table">
                    <tr>
                        <td> <span>Approved by: __________________ </span>
                        </td>
                        <td>Date</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h4 style="padding: 0; margin:0; margin-top: 35px;">Ellen Maghanoy</h4>
                            <span style="padding: 0; margin:0;">Chairman</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; padding: 15px 0;">
                            <span >We acknowledge receipt of the supplier's copy of this Purchase Order and agree to comply with all the terms and instructions set forth therein.</span>
                        </td>
                    </tr>
                </table>
                </span>
                <table class="white-table" style="width: 100%">
                    <tr>
                        <td style="text-align: right; width: 50%;">Supplier's Signature</td>
                        <td style="text-align: left; width: 50%;">____________________</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; width: 50%;">Date</td>
                        <td style="text-align: left; width: 50%;">____________________</td>
                    </tr>
                </table>
            </td>
        </tr>
        
    </table>
</body>
</html>