<?php

namespace App;

trait RequestRules
{

    public function jobRules()
    {
        return [
            "title" => "required",
            "type" => "required",
            "location" => "required",
            "description" => "required",
            "qualification" => "required",
        ];
    }

    public function jobRulesMessages()
    {
        return [
            "title.required" => "Job Title is Required",
            "type.required" => "Employment Type is Required",
            "location.required" => "Job Location is Required",
            "description.required" => "Job Description is Required",
            "qualification.required" => "Job Qualification is Required",
        ];
    }

}
