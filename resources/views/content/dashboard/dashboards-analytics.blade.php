@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row">
  <!-- Profit, Sales, Payments, Transactions -->
  <div class="col-lg-3 col-md-6 col-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">DOSEN</span></br>
        <h3 class="card-title mb-2">{{ $dosen->count() }} Orang</h3>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">MAHASISWA</span></br>
        <h3 class="card-title mb-2">{{ $mahasiswa->count() }} Orang</h3>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="Credit Card" class="rounded">
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">MATKUL</span></br>
        <h3 class="card-title text-nowrap mb-1">{{ $matkuls->count() }}</h3>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <img src="{{asset('assets/img/icons/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded">
          </div>
        </div>
        <span class="fw-semibold d-block mb-1">JADWAL</span></br>
        <h3 class="card-title mb-2">#</h3>
      </div>
    </div>
  </div>
  <!-- Total Revenue -->
  <div class="col-12 mb-4">
    <div class="card">
      <div class="card-header text-center">
        <h5 class="m-0">Pengumuman / Berita</h5>
      </div>
      <div class="card-body">
        @foreach($beritas as $berita)
        <div class="mb-4 p-3 border rounded bg-light">
          <h6 class="fw-bold text-center mb-2">{{ $berita->judul }}</h6>
          <p class="mb-3 text-justify">{{ $berita->berita }}</p>
          <div class="text-end text-muted" style="font-size: 0.8rem;">
            {{ $berita->tanggal }}
          </div>
        </div>
        @endforeach
        @if($beritas->isEmpty())
        <div class="text-center p-3">
          <p class="text-muted mb-0">Belum ada pengumuman atau berita yang tersedia.</p>
        </div>
        @endif
      </div>
    </div>
  </div>

</div>
@endsection
