@extends('layouts.header')
@section('title', 'Buku')
@section('content')
<div class="nav-align-top mb-4">
    <ul class="nav nav-tabs nav-fill" role="tablist">
        <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-stok" aria-controls="navs-top-stok" aria-selected="true">
                Stok Buku
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-data" aria-controls="navs-top-data" aria-selected="false">
                Data Buku
            </button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="navs-top-stok" role="tabpanel">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <h5 class="card-header pb-0 fw-bold">Stok Buku</h5>
                        <div class="table-responsive text-nowrap p-3">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="table-primary">
                                        <th class="fw-bold">No</th>
                                        <th class="fw-bold">Kode</th>
                                        <th class="fw-bold">Judul</th>
                                        <th class="fw-bold">Harga</th>
                                        <th class="fw-bold">Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buku as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->kode}}</td>
                                        <td>{{$data->judul}}</td>
                                        <td>{{$data->harga}}</td>
                                        <td>{{$data->stok}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="navs-top-data" role="tabpanel">
            <div class="row">
                <div class="mb-4 order-0">
                    <button type="button" class="btn btn-primary btn-add"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEdit">
                        <div class="d-flex align-content-center py-1">
                            <i class="menu-icon tf-icons bx bx-plus"></i>
                            <h5 class="text-white m-0">Tambah</h5>
                        </div>
                    </button>
                </div>

                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <h5 class="card-header pb-0 fw-bold">Data Buku</h5>
                        <div class="table-responsive text-nowrap p-3">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="table-primary">
                                        <th class="fw-bold">No</th>
                                        <th class="fw-bold">Kode</th>
                                        <th class="fw-bold">Judul</th>
                                        <th class="fw-bold">Penulis</th>
                                        <th class="fw-bold">Kategori</th>
                                        <th class="fw-bold">Penerbit</th>
                                        <th class="fw-bold">ISBN</th>
                                        <th class="fw-bold">Tahun Terbit</th>
                                        <th class="fw-bold">Jumlah Halaman</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buku as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->kode}}</td>
                                        <td>{{$data->judul}}</td>
                                        <td>{{$data->penulis}}</td>
                                        <td>
                                            @foreach ($kategori as $k)
                                            @if ($k->id == $data->kategori_id)
                                            {{ $k->nama }}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($penerbit as $p)
                                            @if ($p->id == $data->penerbit_id)
                                            {{ $p->nama }}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>{{$data->isbn}}</td>
                                        <td>{{$data->tahun_terbit}}</td>
                                        <td>{{$data->jml_halaman}}</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <button type="button"
                                                    class="btn btn-edit"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit"
                                                    data-id="{{$data->id}}"
                                                    data-kode="{{$data->kode}}"
                                                    data-judul="{{$data->judul}}"
                                                    data-penulis="{{$data->penulis}}"
                                                    data-kategori_id="{{$data->kategori_id}}"
                                                    data-harga="{{$data->harga}}"
                                                    data-stok="{{$data->stok}}"
                                                    data-penerbit_id="{{$data->penerbit_id}}"
                                                    data-isbn="{{$data->isbn}}"
                                                    data-tahun_terbit="{{$data->tahun_terbit}}"
                                                    data-jml_halaman="{{$data->jml_halaman}}">
                                                    <span class="badge rounded-pill bg-label-info"><i class="bx bx-edit-alt text-dark"></i></span>
                                                </button>
                                                <form action="{{ route('buku.destroy', $data->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn"><span class="badge rounded-pill bg-label-danger"><i class="bx bx-trash text-danger"></i></span></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- edit modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="jenis-form" action="{{ route('buku.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle"></h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body py-2">
                    <div class="row"> 

                        <input type="hidden" name="_method" id="form-method" value="POST">
                        <input type="hidden" name="id" id="id">

                        <div class="col-12 mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input
                                type="text"
                                id="judul"
                                class="form-control"
                                placeholder="Judul"
                                name="judul" />
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input
                                    type="text"
                                    id="penulis"
                                    class="form-control"
                                    placeholder="Penulis"
                                    name="penulis" />
                            </div>

                            <div class="col-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" name="kategori_id" id="kategori_id">
                                    @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input
                                    type="number"
                                    id="harga"
                                    class="form-control"
                                    placeholder="Harga"
                                    name="harga" />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input
                                    type="number"
                                    id="stok"
                                    class="form-control"
                                    placeholder="Stok"
                                    name="stok" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7 mb-3">
                                <label for="penerbit" class="form-label">penerbit</label>
                                <select class="form-select" name="penerbit_id" id="penerbit_id">
                                    @foreach($penerbit as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-5 mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input
                                    type="text"
                                    id="isbn"
                                    class="form-control"
                                    placeholder="ISBN"
                                    name="isbn" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                <input
                                    type="number"
                                    id="tahun_terbit"
                                    class="form-control"
                                    placeholder="Tahun Terbit"
                                    name="tahun_terbit" />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="jml_halaman" class="form-label">Jumlah Halaman</label>
                                <input
                                    type="number"
                                    id="jml_halaman"
                                    class="form-control"
                                    placeholder="Jumlah Halaman"
                                    name="jml_halaman" />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit-btn"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('.btn-add').click(function() {
            $('.modal-title').text('Tambah Buku');
            $('#jenis-form').attr('action', "{{ route('buku.store') }}");
            $('#form-method').val('POST');
            $('#judul').val('');
            $('#penulis').val('');
            $('#kategori_id').val('');
            $('#harga').val('');
            $('#stok').val('');
            $('#penerbit_id').val('');
            $('#isbn').val('');
            $('#tahun_terbit').val('');
            $('#jml_halaman').val('');
            $('#submit-btn').text('Tambah');
        });

        $('.btn-edit').click(function() {
            let id = $(this).data('id');
            let kode = $(this).data('kode');
            let judul = $(this).data('judul');
            let penulis = $(this).data('penulis');
            let kategori_id = $(this).data('kategori_id');
            let harga = $(this).data('harga');
            let stok = $(this).data('stok');
            let penerbit_id = $(this).data('penerbit_id');
            let isbn = $(this).data('isbn');
            let tahun_terbit = $(this).data('tahun_terbit');
            let jml_halaman = $(this).data('jml_halaman');

            $('.modal-title').text('Edit Buku');
            $('#jenis-form').attr('action', `/buku/${id}`);
            $('#form-method').val('PUT');
            $('#submit-btn').text('Edit');
            $('#id').val(id);
            $('#kode').val(kode);
            $('#judul').val(judul);
            $('#penulis').val(penulis);
            $('#kategori_id').val(kategori_id);
            $('#harga').val(harga);
            $('#stok').val(stok);
            $('#penerbit_id').val(penerbit_id);
            $('#isbn').val(isbn);
            $('#tahun_terbit').val(tahun_terbit);
            $('#jml_halaman').val(jml_halaman);
        });

    });
</script>
@endsection