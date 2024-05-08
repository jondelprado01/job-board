<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Post') }}
        </h2>
    </x-slot>

    
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-{{(Auth::user()->email != 'admin@admin.com') ? '7' : '12'}}">
                <div class="card">
                    <div class="card-header text-center">
                        <strong>Jobs Table</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped job-post-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Job Title</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($job_posts as $post)
                                    <tr>
                                        <td>{{$post->id}}</td>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->user->email}}</td>
                                        <td>{{$post->status}}</td>
                                        @if(Auth::user()->id == 1)
                                            <td>
                                                @if($post->status == "Pending")
                                                    <input class="post_id" type="hidden" value="{{$post->id}}">
                                                    <button class="btn btn-primary btn_edit" data-status="Published">Publish</button>
                                                    <button class="btn btn-danger btn_edit" data-status="Spam">Mark as Spam</button>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        @else
                                            <td>
                                                N/A
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if(Auth::user()->id != 1)
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header text-center">
                            <strong>Post Job</strong>
                        </div>
                        <div class="card-body">
                            
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Job Title</label>
                                        <input type="text" class="form-control rounded job-input" name="title">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Location</label>
                                        <input type="text" class="form-control rounded job-input" name="location">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Employment Type</label>
                                        <select class="form-control job-input" name="type">
                                            <option value="">-----</option>
                                            <option value="Full-Time">Full-Time</option>
                                            <option value="Part-Time">Part-Time</option>
                                            <option value="Contractual">Contractual</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="">Description</label>
                                        <textarea class="form-control job-input" name="description" rows="4"></textarea>
                                    </div>
                                    <div class="col-lg-7">
                                        <label for="">Qualification</label>
                                        <div class="input-group mb-3">
                                            <button class="btn btn-outline-primary" type="button" id="btn_add_qual">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                            <input type="text" class="form-control rounded" id="job_qualification">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 qualification_container">
                                        <label for="">&nbsp;</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-center">
                            <input type="hidden" class="job-input" name="user" value="{{Auth::user()->id}}">
                            <input type="hidden" class="job-input" name="name" value="{{Auth::user()->name}}">
                            <button request-type="product" type="button" class="btn btn-success btn_save_post">
                                <i class="fa-regular fa-floppy-disk"></i>
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
