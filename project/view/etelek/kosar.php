    <div class="con tabla kosar">
    <form action="index.php?action=kosar&lead=TRUE" method="post">
    <table><tr><th colspan="4">Kosár</th></tr>
    <?php 
    $_SESSION['dbtetel']=0;
    if(isset($_SESSION['kosar'])){
        foreach ($_SESSION['kosar'] as $key => $adat){
            if(strtotime($key)){
                foreach($adat as $etel => $db){
                    if($db!=0){
                        echo '<tr><td>'.$key.'</td>';
                        
                        $kosarelem = $kiETEL->getEtel($etel, $Db);
                        
                        echo '<td>'.$kosarelem['etelNev'].'</td>';
                        echo '<td><div class="plusmin"><a href="index.php?action=kosar&datum='.$key.'&eid='.$etel.'&act=minus&kosar=TRUE"><input type="button" value="-"></a><input type ="number" name="menny'.$_SESSION['dbtetel'].'" min="0" value="'.$_SESSION['kosar'][$key][$etel].'" readonly><a href="index.php?action=kosar&datum='.$key.'&eid='.$etel.'&act=plus&kosar=TRUE"><input type="button" value="+"></a></div></td>';
                        echo '<td><a href="index.php?action=kosar&datum='.$key.'&eid='.$etel.'&act=del"><input type="button" value="X"></a></td></tr>';
                        echo '<input type="hidden" name="datum'.$_SESSION['dbtetel'].'" value="'.$key.'">';
                        echo '<input type="hidden" name="etel'.$_SESSION['dbtetel'].'" value="'.$etel.'">';
                        $_SESSION['dbtetel']++;
                        
                    }
                }
            }
        }
    }
    if($_SESSION['dbtetel']==0){//tételek megszámlálása (ha 0 vissza kerülünk az étlap felületre)
        $_SESSION['kosar']['isset'] = FALSE;
        header('Location:index.php?action=etlap_rendeles');
        exit;
    }
 
    
    echo '<tr>
    	<td colspan="2"><label>
    		<input type="checkbox" name="kartyase" value="Kártyás fizetést szeretnék"> Kártyás fizetést szeretnék
    	</label></td>
    	<td colspan="2"><input type="submit" class="gomb" value="Rendelés leadása" name="lead"></td>
    </tr>';

	
    ?>
</table></form></div>
