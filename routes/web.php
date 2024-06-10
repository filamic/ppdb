<?php

use App\Livewire\UserRegistration;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/debug', function () {
    // dd(auth()->id());
        // dd(Student::create([
        //     "annual_study" => "2031/2032",
        //     "registration_number" => "fzi6Vsl86dRhpy7ewBzE3UNyV17N6CqV",
        //     "class_level_proposed" => "10",
        //     "name" => "Jennifer Payne",
        //     "nickname" => "Quamar Frazier",
        //     "place_of_birth" => "Eaque dolor quam est",
        //     "date_of_birth" => "1994-12-07",
        //     "mother_tongue" => "Sapiente laboris occ",
        //     "status_in_the_family" => "Dolor qui eos adipi",
        //     "pupil_position" => "80",
        //     "sex" => "2",
        //     "religion" => "6",
        //     "nationality" => "Esse amet voluptas ",
        //     "numbers_of_siblings" => "298",
        //     "previous_school_name" => "Devin Guthrie",
        //     "previous_school_city_name" => "Miranda Ayala",
        //     "previous_school_country_name" => "Cooper Jackson"
        // ]));
    // return view('welcome');
});

// Route::get('/user-registration', UserRegistration::class);