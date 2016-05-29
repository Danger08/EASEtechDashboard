
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: auto">
<colgroup>
<col style="width: 39px">
<col style="width: 22px">
<col style="width: 31px">
<col style="width: 56px">
<col style="width: 31px">
<col style="width: 42px">
</colgroup>
  <tr>
    <th class="tg-yw4l">date</th>
    <th class="tg-yw4l">in</th>
    <th class="tg-yw4l">out</th>
    <th class="tg-yw4l">regular</th>
    <th class="tg-yw4l">OT</th>
    <th class="tg-yw4l">Total</th>
  </tr>

  <?php
  $start =  new DateTime('05/16/16');
  $end =  new DateTime('05/30/16');
  $json = '{"aaData":[["Mon","2016-05-16","8:19 PM","","0000-00-00","","0","0","122.52.27.196","","Bulihan","webcamcb1489f482059f43ee38ca47af8968a4911.jpg","","0","878","","Waiting for approval","","ACER Aspire 4750Z Black","--","","Pending"],["Mon","2016-05-16","8:14 PM","Mon","2016-05-16","8:19 PM","0","0","122.52.27.196","122.52.27.196","Bulihan","webcamc6b250436a4a8fff4a460f908760959f550.jpg","webcam0dcd9f9a226272ef748b0675cadde8eb609.jpg","5","877","","Waiting for approval","","ACER Aspire 4750Z Black","--","","Pending"],["Mon","2016-05-16","4:01 PM","Mon","2016-05-16","8:14 PM","4","0","127.0.0.1","122.52.27.196","Bulihan","webcam3f90598b639184b525707c1d3202c160615.jpg","webcam3b01a432abf021cd5b88c0809b2ee74c908.jpg","13","876","","Waiting for approval","","ACER Aspire 4750Z Black","--","","Pending"],["Mon","2016-05-16","12:30 AM","Mon","2016-05-16","12:38 PM","12","3","127.0.0.1","127.0.0.1","Bulihan","webcam604e2614ecca67bdd5a2e3224a5b871c626.jpg","webcam6ad8184d1e55c1a336e358b893f6e412770.jpg","8","875","","","","ACER Aspire 4750Z Black","--","","Approved"],["Mon","2016-05-16","12:24 AM","Mon","2016-05-16","12:30 AM","0","0","127.0.0.1","127.0.0.1","Bulihan","webcam7e59bdff7e4c82afdff740bb54886c5c863.jpg","webcam75b77fdebd9bb0e2acab828c017434be652.jpg","6","874","","","","ACER Aspire 4750Z Black","--","","Approved"],["Mon","2016-05-16","12:03 AM","Mon","2016-05-16","12:24 AM","0","0","127.0.0.1","127.0.0.1","Bulihan","webcam0d101e7f831427c96191c61b6bd962f1544.jpg","webcamc0a186e4e04dea667e4f6e799633c500666.jpg","21","873","","","","ACER Aspire 4750Z Black","--","","Approved"]]}';

  $obj = json_decode($json);
  echo print_r($obj->aaData[0]);

  echo $start->format('m-d-Y') . '<br>';
  echo $end->format('m-d-Y') . '<br>' ;

  $interval = DateInterval::createFromDateString('1 day');
  $period = new DatePeriod($start, $interval, $end);
  $counter = 0;
  foreach ( $period as $dt ){
   $dl = strtolower($dt->format("l"));


   $datemm =  new DateTime($obj->aaData[$counter][1]);
   $datemmstr = strtolower($datemm->format("m-d"));
   echo $datemmstr . '<br>';
   if($datemmstr == strtolower($dt->format( 'm-d'))){

    //  if($first == false){
    //    echo "<tr><td class='tg-yw4l'> <div style='float:left'>" . $dt->format( 'l') . "</div><div style='float:right'>" . $dt->format( 'm-d') . "</div> </td>";
    //    echo "<td class='tg-yw4l'>" . strtolower($obj->aaData[$counter][2]) ." </td>";
    //     echo "</tr>";
    //     $first = true;
    //  }else {
    //    echo "<tr><td class='tg-yw4l'> <div style='float:left'></div><div style='float:right'></div> </td>";
    //    echo "<td class='tg-yw4l'>" . strtolower($obj->aaData[$counter][2]) ." </td>";
    //     echo "</tr>";
    //  }


    //  echo "<td class='tg-yw4l'></td>
    //  <td class='tg-yw4l'></td>
    //  <td class='tg-yw4l'></td>
    //  <td class='tg-yw4l'></td> </tr>";
   }


  	//echo $dt->format( "l m-d" ) . '<br>';
  	// if($dl == "saturday"){
  	// 	echo "<br>";
  	// }
    $counter +=1;
  }
  echo $end->format( "l m-d" );

  ?>


</table>
