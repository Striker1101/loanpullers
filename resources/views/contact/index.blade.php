@include('layouts.header', ['location' => 'Contact'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'Contact', 'locations' => [['name' => 'Contact', 'route' => 'contact.index', 'active' => true]]])

@section('content')
    <!-- Body of Contact -->
    <div>
        <div class="mapouter">
            <div class="gmap_canvas"><iframe width="100%" height="685" id="gmap_canvas"
                    src="https://maps.google.com/maps?q=dubai&t=k&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                    scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://textcaseconvert.com"></><br>
                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 685px;
                            width: auto;
                        }
                    </style><a href="https://www.ongooglemaps.com">google maps embed</a>
                    <style>
                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 685px;
                            width: auto;
                        }
                    </style>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-column flex-md-row"> <!-- Use flex utilities to control direction -->
                        <div class="flex-grow-1 me-md-2 mb-2 mb-md-0"> <!-- Use flex-grow and margin utilities -->
                            <!-- Content for the first child div -->


                            <h5>{{ config('app.name') }} Pty Ltd</h5>
                            <p>Level 3, 99 York Street, Sydney NSW 2000
                            </p>
                            <p>{{ config('app.phone_num') }}</p>
                            <p>{{ config('app.email') }}</p>

                            <p>For all enquiries please call us on {{ config('app.phone_num') }} or please fill in your
                                details and we will
                                contact you to help you with all your property and finance needs.
                            </p>
                        </div>
                        <form class="flex-grow-1 ms-md-2 mb-3">
                            <div class="mb-3 form-group">

                                <input type="text" class="form-control" id="name" aria-describedby="name of user"
                                    placeholder="Your Name">
                            </div>

                            <div class="mb-3 form-group">

                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Email Address">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>

                            <div class="mb-3 form-group">

                                <input type="number" class="form-control" id="number" aria-describedby="number of user"
                                    placeholder="Phone Number">
                            </div>

                            <div class="mb-3 form-group">

                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Your Message"></textarea>
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
