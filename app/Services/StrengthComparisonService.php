<?php

namespace App\Services;

use App\Models\StrengthStandardsLevel;

class StrengthComparisonService
{
    public function getTrainingLevel($lifter, $compound)
    {
        $lifterRecord = $lifter->getLifterRecordForCompound($compound->id);

        $weight = $lifter->weight;
        $oneRepMax = $lifterRecord->one_rep_max;
        $gender = $lifter->gender;

        $ratio = round($oneRepMax / $weight, 2);

        $strengthStandard = StrengthStandardsLevel::where('compound_id', $compound->id)
            ->where(function ($query) use ($ratio, $gender) {
                $query->where('min_ratio', '<=', $ratio)
                    ->where('max_ratio', '>=', $ratio)
                    ->where('gender', '=', $gender);
            })
            ->orWhere(function ($query) use ($ratio) {
                $query->where('max_ratio', '<', $ratio);
            })
            ->orderBy('max_ratio', 'desc') // Order by max_ratio descending to get the highest level first
            ->first();

        if (!$strengthStandard) {
            return null; // Handle case where no strength standard level is found
        }

        return $strengthStandard->training_level;
    }

    public function getFullDetails($lifter, $compound) {
        return [
            'standards' => $this->getStrengthStandardsByTime($lifter, $compound),
            'trainingLevel' => $this->getTrainingLevel($lifter, $compound),
        ];
    }

    public function getStrengthStandardsByTime($lifter, $compound)
    {
        $strengthStandard = StrengthStandardsLevel::where('compound_id', $compound->id)
            ->where('years_of_lifting', $lifter->years_of_lifting)
            ->first();

        if (!$strengthStandard) {
            return null;
        }

        return [
            'trainingLevel' => $strengthStandard->training_level,
            'yearsOfLifting' => $strengthStandard->years_of_lifting,
            'minRatio' => $strengthStandard->min_ratio,
            'maxRatio' => $strengthStandard->max_ratio,
        ];
    }
}
