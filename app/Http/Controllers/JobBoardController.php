<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JobRequestValidation;
use App\Actions\DBOperations\JobCRUD;
use GuzzleHttp\Client;
use Auth;

class JobBoardController extends Controller
{
    
    public function __construct()
    {
        $this->client = new Client();
        $this->crud = new JobCRUD();
        $this->url = "https://mrge-group-gmbh.jobs.personio.de/xml";
    }

    public function externalAPI(){
        try {
            $response = $this->client->get($this->url);
            $xmldat = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
            $xml = json_decode(json_encode((array) $xmldat), 1);
            return $xml;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function jobListing(){
        try {

            $job_listing = $this->crud->list();

            if ($this->externalAPI()) {
                foreach ($this->externalAPI() as $ext) {

                    foreach ($ext['jobDescriptions']['jobDescription'] as $jobDesc) {
                        if ($jobDesc['name'] == "Your Tasks:") {
                            $description = $jobDesc['value'];
                        }
                        if ($jobDesc['name'] == "Your Profile:") {
                            $qualification = $jobDesc['value'];
                        }
                    }

                    $job_listing[] = [
                        "id" => (int)$ext['id'],
                        "title" => $ext['name'],
                        "company" => $ext['subcompany'],
                        "description" => $description,
                        "type" => ucwords($ext['employmentType']),
                        "location" => $ext['office'],
                        "qualification" => $qualification,
                        "status" => "External",
                    ]; 
                }
            }
            
            return view('job-listing', compact('job_listing'));

        } catch (\Exception $e) {
            return response()->json(array(
                "status" => "Error",
                "message" => $e->getMessage(),
            ));
        }
    }

    public function jobPost(){
        $job_posts = $this->crud->retrieve();
        return view('job-post', compact('job_posts'));
    }

    public function addJob(JobRequestValidation $request){
        try {
            $validator = $request->validated();
            $create_job_post = $this->crud->create($request);

            return $create_job_post;

        } catch (\Exception $e) {
            return response()->json(array(
                "status" => "Error",
                "message" => $e->getMessage(),
            ));
        }
    }

    public function viewJobPost($id){
        if (Auth::user()->id == 1) {
            $get_job_post = $this->crud->view($id);
            return view('view-job-post', compact('get_job_post'));
        }
        else {
            abort(403);
        }
    }

    public function editJob(Request $request, $id){
        try {

            $get_job_post = $this->crud->edit($id, $request);
            return $get_job_post;

        } catch (\Exception $e) {
            return response()->json(array(
                "status" => "Error",
                "message" => $e->getMessage(),
            ));
        }
    }

    public function jobList() {
        return $this->externalAPI();
    }

}
