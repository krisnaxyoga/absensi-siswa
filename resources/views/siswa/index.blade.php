@extends('layouts.siswa')
@section('title', 'Siswa')
@section('contents')
<section>
    <div class="container mt-3">
        <h3>Pengumuman</h3>
        <div class="row">
            @if ($pengumuman->count() != 0)
                @foreach ($pengumuman as $item)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{ $item->title }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <p>{{ $item->description }}</p>

                            <p style="font-size: 10px">diunggah : {{ $item->created_at }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{$item->file}}" class="btn btn-primary"><i data-feather="download"></i></a>
                        </div>
                    </div>

                </div>
                @endforeach

            @else
                <div class="card">
                    <div class="card-body">
                        Tidak ada pengumuman
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
