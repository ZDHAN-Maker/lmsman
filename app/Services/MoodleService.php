<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MoodleService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = config('services.moodle.url'); 
        $this->token = config('services.moodle.token');
    }

    public function createUser($userData)
    {
        $postData = [
            'wstoken' => $this->token,
            'wsfunction' => 'core_user_create_users',
            'moodlewsrestformat' => 'json',
        ];

        // Konversi ke format yang diminta Moodle: users[0][key] = value
        foreach ($userData as $key => $value) {
            $postData["users[0][$key]"] = $value;
        }

        $response = Http::asForm()->post($this->baseUrl, $postData);

        return $response->json();
    }

    public function getSiteInfo()
    {
        $params = [
            'wstoken' => $this->token,
            'wsfunction' => 'core_webservice_get_site_info',
            'moodlewsrestformat' => 'json',
        ];

        $response = Http::get($this->baseUrl, $params);

        return $response->json();
    }
    public function createCourse($courseData)
{
    $response = Http::get($this->baseUrl, [
        'wstoken' => $this->token,
        'wsfunction' => 'core_course_create_courses',
        'moodlewsrestformat' => 'json',
        'courses' => json_encode([$courseData])
    ]);

    return $response->json();
}
}
