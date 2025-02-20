@extends('layouts.header')
@section('title', 'Vendor')
@section('content')
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
            <h5 class="card-header pb-0 fw-bold">Data Vendor</h5>
            <div class="table-responsive text-nowrap p-3">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th class="fw-bold">No</th>
                            <th class="fw-bold">Kode</th>
                            <th class="fw-bold">Nama</th>
                            <th class="fw-bold">No. HP</th>
                            <th class="fw-bold">Email</th>
                            <th class="fw-bold">Alamat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendor as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->kode}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->no_hp}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->alamat}}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="button"
                                        class="btn btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit"
                                        data-id="{{$data->id}}"
                                        data-nama="{{$data->nama}}"
                                        data-alamat="{{$data->alamat}}"
                                        data-no_hp="{{$data->no_hp}}"
                                        data-email="{{$data->email}}">
                                        <span class="badge rounded-pill bg-label-info"><i class="bx bx-edit-alt text-dark"></i></span>
                                    </button>
                                    <form action="{{ route('vendor.destroy', $data->id) }}" method="post">
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

<!-- edit modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="jenis-form" action="{{ route('vendor.store') }}" method="post">
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
                            <label for="nama" class="form-label">Nama</label>
                            <input
                                type="text"
                                id="nama"
                                class="form-control"
                                placeholder="Nama"
                                name="nama" />
                        </div>

                        <div class="col-12 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                id="email"
                                class="form-control"
                                placeholder="Email"
                                name="email" />
                        </div>

                        <div class="col-12 mb-3">
                            <label for="no_hp" class="form-label">No. Hp</label>
                            <input
                                type="text"
                                id="no_hp"
                                class="form-control"
                                placeholder="No. Hp"
                                name="no_hp" />
                        </div>

                        <div class="col-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
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
            $('.modal-title').text('Tambah Vendor');
            $('#jenis-form').attr('action', "{{ route('vendor.store') }}");
            $('#form-method').val('POST');
            $('#nama').val('');
            $('#submit-btn').text('Tambah');
        });

        $('.btn-edit').click(function() {
            let id = $(this).data('id');
            let kode = $(this).data('kode');
            let nama = $(this).data('nama');
            let alamat = $(this).data('alamat');
            let no_hp = $(this).data('no_hp');
            let email = $(this).data('email');

            $('.modal-title').text('Edit Vendor');
            $('#jenis-form').attr('action', `/vendor/${id}`);
            $('#form-method').val('PUT');
            $('#submit-btn').text('Edit');
            $('#id').val(id);
            $('#kode').val(kode);
            $('#nama').val(nama);
            $('#alamat').val(alamat);
            $('#no_hp').val(no_hp);
            $('#email').val(email);
        });

    });
</script>
@endsection