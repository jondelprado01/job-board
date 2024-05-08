<?php 

namespace App\Actions\DBOperations;

use App\Models\JobsModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPostNotification;
use Auth;

class JobCRUD{

    public function __construct()
    {
        $this->model = new JobsModel();
        $this->model->timestamps = false;
    }

    public function retrieve(){

        $user_id = Auth::user()->id;

        if ($user_id == 1) {
            $job_posts = $this->model->all();
        }
        else {
            $job_posts = $this->model->where('user_id', $user_id)->get();
        }

        return $job_posts;
    }

    public function create($data){

        $this->model->user_id = $data['user'];
        $this->model->title = $data['title'];
        $this->model->type = $data['type'];
        $this->model->location = $data['location'];
        $this->model->description = $data['description'];
        $this->model->qualification = implode("|", $data['qualification']);

        $create_job_post = $this->model->save();
        
        $link = url('view-job/'.$this->model->id);
        if ($create_job_post == 1) {
            Mail::to('jonathandelprado60@gmail.com')->send(new JobPostNotification($data['title'], $data['description'], $link, $data['name']));
        }
        
        return $create_job_post;
    }

    public function view($id){
        $get_job_post = $this->model->with('user')->where('id', $id)->first();
        return $get_job_post;
    }

    public function edit($id, $data){
        $edit_job_post = $this->model->where('id', $id)->update(['status' => $data['status']]);
        return $edit_job_post;
    }

    public function list(){
        $job_listing = $this->model->where('status', 'Published')->get();
        $job_listing->makeHidden(['created_at','updated_at','user_id']);
        return $job_listing;
    }

}

?>