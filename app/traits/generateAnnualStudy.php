<?php

namespace App\traits;

trait generateAnnualStudy
{
    public static function generateAnnualStudy() :array
    {
        $annualStudyMaster = [];;
        for ($i=2023; $i < date('Y')+5; $i++) { 
            $annualStudyMaster[$i.'/'.$i+1] = $i.'/'.$i+1;
        }
        return $annualStudyMaster;
    }
}
