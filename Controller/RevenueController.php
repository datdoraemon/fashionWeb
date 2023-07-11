<?php

require_once __DIR__ . '/../Model/AdminModel.php';

class RevenueController{
   public function RevenueDay($shopID)
   {
       $revenue = new AdminModel();
       $revenueday = $revenue->getQuantityFromUP($shopID);
       return $revenueday;
   }
   
   public function getRevenueDay($shopID, $date)
   {
       $revenue = new AdminModel();
       $revenueday = $revenue->getRevenueDay($shopID,$date);
       return $revenueday;
   }
   public function RevenueWeek()
   {
        $revenue = new AdminModel();
        $revenueday = $revenue->getCurDate();
        return $revenueday;
   }
   
   public function Minusday($curdate)
   {
    {
        $days = array();
        
        for ($i = 0; $i < 7; $i++) {
            $newdate = strtotime("-$i day", strtotime($curdate));
            $newdate = date('Y-m-j', $newdate);
            $days[] = $newdate;
        }
        
        return $days;
    }
   }

}

?>
