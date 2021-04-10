@extends('component/app')

@section('content')

    <!-- Main Container -->
    <main id="main-container">

        <!-- Manggil Partial Admin Dashboard -->
        @includeWhen(Auth::User()->role == 'Pengurus', '/admin/dashboard')

        <!-- Manggil Partial User Dashboard -->
        @includeWhen(Auth::User()->role == 'Anggota', '/user/dashboard')

    </main>
    <!-- END Main Container -->
@endsection
