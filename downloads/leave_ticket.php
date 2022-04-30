<?php
require_once('../vendor/autoload.php');
@include('../includes/config.php');
@include('../includes/session.php');


function returnStatus($status){
    if($status == 0 OR $status == '0'):
        return ' <small class="badge text-secondary" >Pending</small>';
    elseif ($status == 1 OR $status == '1'):
        return ' <small class="badge text-success" >Approved</small>';
    elseif ($status == 2 OR $status == '2'):
        return ' <small class="badge text-danger" >Rejected</small>';
    else:
        return '';
    endif;
}


if(isset($_POST['print_leave_ticket'],$_POST['leaveID'])){
    $lid = intval($_POST['leaveID']);
    $sql = "SELECT tblleaves.id as lid, tblemployees.*,tblleaves.* from tblleaves join tblemployees on tblleaves.empid=tblemployees.emp_id where tblleaves.id='{$lid}'";
    $result=mysqli_query($conn, $sql);
    $leave = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0 ){
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->forcePortraitHeaders = true;
        $stylesheet = file_get_contents('./single-result.css'); // external css

        $employeeName = strtoupper($leave['FirstName'].' '.$leave['LastName']);

        $doc = '<h3 style="width:100%; text-align: center; margin-bottom: 10px;font-family:Verdana, Geneva, sans-serif;font-weight:450; ">LEAVE APPLICATION DETAILS FOR '.$employeeName.'</h3>';
function mimi(){return "fgfg";}
        $doc .= '<div style="text-align: right"> <small>Requested Date</small> : <small style="font-weight: bold;">'. date("F d, Y", strtotime($leave['PostingDate'])) .'</small> </div>';
        $doc .= '<table class="table" style="font-size:12px;">
        <thead>
            <tr style="background-color: rgba(73,71,71,0.28);">
                <th colspan="6" style="text-align: center;  padding: 1em;"> EMPLOYEE DETAILS </th>
            </tr>
        </thead>
        <tbody>
        ';


        $doc .= '<tr>';
        $doc .= '<td colspan="2" class="td" style="font-weight: bold">Employee Name</td>';
        $doc .= '<td colspan="4" class="td">'.$employeeName.'</td>';
        $doc .= '</tr>';

        $doc .= '<tr>';
        $doc .= '<td colspan="2" class="td" style="font-weight: bold">Gender</td>';
        $doc .= '<td colspan="4" class="td">'.$leave['Gender'].'</td>';
        $doc .= '</tr>';

        $doc .= '<tr>';
        $doc .= '<td colspan="2" class="td" style="font-weight: bold">Email Address</td>';
        $doc .= '<td colspan="4" class="td">'.$leave['EmailId'].'</td>';
        $doc .= '</tr>';

        $doc .= '<tr>';
        $doc .= '<td colspan="2" class="td" style="font-weight: bold">Phone Number</td>';
        $doc .= '<td colspan="4" class="td">'.$leave['Phonenumber'].'</td>';
        $doc .= '</tr>';

        $doc .='</tbody>';

        $doc .= ' <thead style="background-color: rgba(10,10,10,0.94)">
            <tr style="background-color: rgba(73,71,71,0.28);">
                <th colspan="6" style="text-align: center;  padding: 1em;"> LEAVE DETAILS </th>
            </tr>
        </thead>
        <tbody>
        ';

        $doc .= '<tr>';
        $doc .= '<td colspan="2" class="td" style="font-weight: bold">Leave Type</td>';
        $doc .= '<td colspan="4" class="td">'.$leave['LeaveType'].'</td>';
        $doc .= '</tr>';

        $doc .= '<tr>';
        $doc .= '<td colspan="2" class="td" style="font-weight: bold">Leave Days</td>';
        $doc .= '<td colspan="4" class="td">'.$leave['num_days'].'</td>';
        $doc .= '</tr>';

        $doc .= '<tr>';
        $doc .= '<td colspan="2" class="td" style="font-weight: bold">Leave Dates</td>';
        $doc .= '<td colspan="2" class="td">
                     <div><small>From</small> </div>
                     <div>'. date('F d, Y',strtotime($leave['FromDate'])).'</div>
                 </td>';
        $doc .= '<td colspan="2" class="td">
                     <div><small>To</small> </div>
                     <div>'. date('F d, Y',strtotime($leave['ToDate'])).'</div>
                 </td>';
        $doc .= '</tr>';

        $doc .= '<tr>';
        $doc .= '<td colspan="2" class="td" style="font-weight: bold">Leave Reason</td>';
        $doc .= '<td colspan="4" class="td">'.$leave['Description'].'</td>';
        $doc .= '</tr>';


        $doc .= ' <thead>
                    <tr style="background-color: rgba(73,71,71,0.28);">
                        <th colspan="6" style="text-align: center;  padding: 1em;"> LEAVE APPLICATION STATUS </th>
                    </tr>
                </thead>
                <tbody>';


        $doc .= '<tr>
                   <th colspan="2">Administer</th>
                   <th>Status</th>
                   <th title="date of action">Date</th>
                   <th colspan="2">Leader Remark</th>
               </tr>';

        $doc .= '<tr>';
        $doc .= '<td colspan="2" class="td" style="font-weight: bold; text-align: center">
                    <div>HOD</div>
                    <div><small class="text-default">(Head of Department)</small></div>
                </td>';
        $doc .= '<td class="td">'.returnStatus($leave['hod_status']).'</td>';
        $doc .= '<td class="td"><small>'. date('F d, Y',strtotime($leave['hod_action_date'])).'</small></td>';
        $doc .= '<td colspan="2" class="td">'.$leave['hod_remark'].'</td>';
        $doc .= '</tr>';

        $doc .= '<tr>';
        $doc .= '<td colspan="2" class="td" style="font-weight: bold; text-align: center">
                    <div>Principle</div>
                    <div><small class="text-default">(Head of College)</small></div>
                </td>';
        $doc .= '<td class="td">'.returnStatus($leave['principal_status']).'</td>';
        $doc .= '<td class="td"><small>'. date('F d, Y',strtotime($leave['principal_action_date'])).'</small></td>';
        $doc .= '<td colspan="2" class="td">'.$leave['principal_remark'].'</td>';
        $doc .= '</tr>';

        $doc .= '<tr>';
        $doc .= '<td colspan="2" class="td" style="font-weight: bold; text-align: center">
                    <div>DVC</div>
                    <div><small class="text-default">(Depute Vice Chancellor)</small></div>
                </td>';
        $doc .= '<td class="td">'.returnStatus($leave['dvc_status']).'</td>';
        $doc .= '<td class="td"><small>'. date('F d, Y',strtotime($leave['dvc_action_date'])).'</small></td>';
        $doc .= '<td colspan="2" class="td">'.$leave['dvc_remark'].'</td>';
        $doc .= '</tr>';

        $doc .= '</tbody></table>';
        $doc .= '<div style="margin: 1em; text-align: right ">
                       <small style="font-weight: bold"> HOD / Principal signature</small>
                       <p>..................................</p>
                  </div>';
        //$doc .= '<div style="page-break-after:always;"></div>';



        $mpdf->AddPage();
        $mpdf->SetWatermarkText('Employee Leave');
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        // Write some HTML code:
        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($doc,\Mpdf\HTMLParserMode::HTML_BODY);
        // Output a PDF file directly to the browser
        $mpdf->Output($employeeName." - ".date('M d, Y')." - ".$lid.' Report.pdf','I');

        header("location:".$_SERVER['HTTP_REFERER']);
    }else{
        $_SESSION['failed'] ="Fail to find leave data";
        echo $sql."<br>".$_SERVER['HTTP_REFERER'];
        header($_SERVER['HTTP_REFERER']);
    }
}else{
    $_SESSION['failed'] ="fail to generate this leave report";
    header("loaction: ".$_SERVER['HTTP_REFERER']);
}
