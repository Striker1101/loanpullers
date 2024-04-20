<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $location }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">Home</a></li>
                        @foreach ($locations as $location)
                            @if ($location['active'])
                                @if (isset($location['route']) && $location['route'])
                                    <li class="breadcrumb-item active"><a
                                            href="{{ route($location['route']) }}">{{ $location['name'] }}</a></li>
                                @else
                                    <li class="breadcrumb-item active"><a>{{ $location['name'] }}</a></li>
                                @endif
                            @else
                                @if (isset($location['route']) && $location['route'])
                                    <li class="breadcrumb-item "><a
                                            href="{{ route($location['route']) }}">{{ $location['name'] }}</a></li>
                                @else
                                    <li class="breadcrumb-item "><a>{{ $location['name'] }}</a></li>
                                @endif
                            @endif
                        @endforeach

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('layouts.footer')
