<?php        
    function display_month($month, $year){
        $date = mktime(0, 0, 0, $month, 1, $year);
        //echo date('Y:M:d', $date);
        //echo "<br/>";
        echo date('jS F Y', $date);
        echo "<br/>";
        
        $day_name = date('l', $date);
        echo $day_name;
        echo "<br/>";
        
        $month_name = date('F', $date);
        echo $month_name;
        echo "<br/>";
        
        $day_of_week = date('w', $date);                      
        echo $day_of_week;          
        echo "<br/>";
        
        $days_in_month = date('t', $date);
        echo $days_in_month;
        echo "<br/>";
        
        echo    "<table border='solid'>
                    <tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>
                    <tr>
                ";
        if($day_of_week > 0){
            echo "<td colspan = '$day_of_week'>&nbsp</td>";
        }
        for($day = 1; $day <= $days_in_month; $day++){
            $date = mktime(0, 0, 0, $month, $day, $year);
            $day_of_week = date('w', $date);  
            echo "<td>$day</td>";
            if ($day_of_week == 6){
                echo "</tr><tr>";
            }
        }
        echo    "</tr></table>";
        
        if($year%4 === 0){
            //echo "leap year";
        }
        echo "month = $month, year = $year<br/>";
        //echo $day_of_week;
        echo "<td colspan = '$day_of_week'>&nbsp</td>";
        
    }
    
?>