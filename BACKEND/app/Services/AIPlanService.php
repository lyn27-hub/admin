<?php

namespace App\Services;

use App\Models\AISetting;

class AIPlanService
{
    protected $groq;

    // Dipakai kalau admin belum pernah mengisi prompt di ai_settings,
    // supaya generate plan tidak gagal total.
    private const DEFAULT_PROMPT = "Buatkan rencana penurunan berat badan untuk pasien berusia {age} tahun, jenis kelamin {gender}, berat {weight} kg, tinggi {height} cm, BMI {bmi} ({category}), tingkat risiko {risk_level}. Tujuan: {goal}. Tingkat aktivitas: {activity_level}. Kebiasaan: minum manis {sweet_drink}, fast food {fast_food}, tidur {sleep_duration} jam. Kondisi medis: {conditions}. Makanan favorit: {top_food}.";

    public function __construct(GroqService $groq)
    {
        $this->groq = $groq;
    }

    public function generatePlan(
        $screening,
        $topFood,
        $goal,
        $avgCalories,
        $previousWeight
    ) {
        $bmi = $screening->imt_value;

        if ($bmi < 18.5) {
            $category = "Underweight";
        } elseif ($bmi < 25) {
            $category = "Normal";
        } elseif ($bmi < 30) {
            $category = "Overweight";
        } else {
            $category = "Obesitas";
        }

        $template = AISetting::getValue('ai_plan_prompt', self::DEFAULT_PROMPT);

        $prompt = str_replace(
            [
                '{age}',
                '{gender}',
                '{weight}',
                '{height}',
                '{bmi}',
                '{risk_level}',
                '{goal}',
                '{category}',
                '{activity_level}',
                '{sweet_drink}',
                '{fast_food}',
                '{sleep_duration}',
                '{conditions}',
                '{top_food}',
            ],
            [
                $screening->age,
                $screening->gender,
                $screening->weight,
                $screening->height,
                $screening->imt_value,
                $screening->risk_level,
                $goal,
                $category,
                $screening->activity_level,
                $screening->sweet_drink,
                $screening->fast_food,
                $screening->sleep_duration,
                $screening->conditions,
                $topFood,
            ],
            $template
        );

        return $this->groq->ask($prompt);
    }
}