
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Mrge - Job Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
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
                <h1 class="display-4">Welcome to Mrge Job Portal</h1>
                <p class="lead">Are you looking for a new challenge?</p>
                <hr class="my-4">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover job-list-table">
                            <thead>
                                <th>Job Title</th>
                                <th>Location</th>
                                <th>Employment Type</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($job_listing as $list)
                                    <tr>
                                        <td>{{$list['title']}}</td>
                                        <td>{{$list['location']}}</td>
                                        <td>{{$list['type']}}</td>
                                        <td>
                                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#job_detail_{{$list['id']}}" aria-controls="offcanvasTop">View Details</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @foreach($job_listing as $list)
                        <div class="modal fade" id="job_detail_{{$list['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                <div class="modal-body">
                                    <div class="jumbotron">
                                        <h1 class="display-4">{{$list['title']}}</h1>
                                        <p class="lead">{!!$list['description']!!}</p>
                                        <hr class="my-4">
                                        
                                        <p>Employment Type: {{$list['type']}}</p><br>
                                        <p>Location: {{$list['location']}}</p><br>

                                        <p>Qualifications:</p>
                                        @if($list['status'] == "External")
                                            {!!$list['qualification']!!}
                                        @else
                                            @php
                                            $qualification = explode("|", $list['qualification'])
                                            @endphp
                                            @foreach($qualification as $q)
                                                <li>{{$q}}</li>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </body>
</html>

<script>
    let job_post = new DataTable('.job-list-table', {
        responsive: true
    });
</script>
