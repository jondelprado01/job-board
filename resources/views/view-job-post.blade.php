<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Job Board</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('js/script.js')}}"></script>

        <style>
            .rounded{
                border-radius: 5px;
            }
            .colored{
                background-color: #c2c2c2!important;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="container p-4">
            <div class="jumbotron">
                <h1 class="display-4">{{$get_job_post->title}}</h1>
                <p class="lead">{{$get_job_post->description}}</p>
                <hr class="my-4">

                <p>Employment Type: {{$get_job_post->type}}</p><br>
                <p>Location: {{$get_job_post->location}}</p><br>

                <p>Qualifications:</p>
                <ul>
                    @php
                        $qualification = explode("|", $get_job_post->qualification)
                    @endphp
                    @foreach($qualification as $q)
                        <li>{{$q}}</li>
                    @endforeach
                    
                </ul>

                <hr class="my-4">
                <p>Posted By: {{ucwords($get_job_post->user->name)}}</p>

                <p class="lead">
                    @if($get_job_post->status == "Pending")
                        <input class="post_id" type="hidden" value="{{$get_job_post->id}}">
                        <a class="btn btn-primary btn-lg btn_edit" href="#" role="button" data-status="Published">Publish</a>
                        <a class="btn btn-danger btn-lg btn_edit" href="#" role="button" data-status="Spam">Mark as Spam</a>
                    @else
                        <h4>{{$get_job_post->status}}</h4>
                    @endif
                </p>
            </div>
        </div>
    </body>
</html>
