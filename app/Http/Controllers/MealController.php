<?php

namespace App\Http\Controllers;

use App\Services\MealService;

class MealController extends Controller
{
    private MealService $mealService;

    public function __construct(MealService $mealService)
    {
        $this->mealService = $mealService;
    }

    public function store()
    {
//        $this->mealService
    }
}
