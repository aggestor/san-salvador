<?php

namespace Root\Core;

class EnabledCashOut
{
    /**
     * Pour verifier s'il pwu recevoir un bonus soit journalier ou s'il peut faire un demande de retait
     *
     * @param array $date. array de type date.getdate()
     * @param boolean $returnInvest
     * @return boolean
     */
    public static function isEnabled(array $date, bool $returnInvest = false)
    {
        if ($returnInvest) {
            $arrayDay = [1, 2, 3, 4, 5];
            if (in_array($date["wday"], $arrayDay) && !empty($date)) {
                return true;
            }
        } else {
            if ($date["wday"] == 6 && $date["weekday"] == "Saturday" && !empty($date)) {
                return true;
            }
        }
        return false;
    }
}
