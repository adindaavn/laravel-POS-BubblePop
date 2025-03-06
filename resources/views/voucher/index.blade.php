@extends('layouts.header')
@section('title', 'Voucher')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

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
            <h5 class="card-header pb-0 fw-bold">Data Voucher</h5>
            <div class="table-responsive text-nowrap p-3">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th class="fw-bold">No</th>
                            <th class="fw-bold">Kode</th>
                            <th class="fw-bold">Nilai</th>
                            <th class="fw-bold">Tipe</th>
                            <th class="fw-bold">Status</th>
                            <th class="fw-bold">Stok</th>
                            <th class="fw-bold">Min Belanja</th>
                            <th class="fw-bold">Max Diskon</th>
                            <th class="fw-bold">Durasi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($voucher as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->kode}}</td>
                            <td>{{$data->nilai}}</td>
                            <td>{{$data->tipe}}</td>
                            <td>
                                @if($data->is_active == 0)
                                Tidak Aktif
                                @endif
                                @if($data->is_active == 1)
                                Aktif
                                @endif
                            </td>
                            <td>{{$data->stok}}</td>
                            <td>{{$data->min_belanja}}</td>
                            <td>{{$data->max_diskon}}</td>
                            <td>{{$data->valid_dari}} - {{$data->valid_sampai}}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="button"
                                        class="btn btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit"
                                        data-id="{{$data->id}}"
                                        data-kode="{{$data->kode}}"
                                        data-nilai="{{$data->nilai}}"
                                        data-tipe="{{$data->tipe}}"
                                        data-min_belanja="{{$data->min_belanja}}"
                                        data-max_diskon="{{$data->max_diskon}}"
                                        data-valid_dari="{{$data->valid_dari}}"
                                        data-valid_sampai="{{$data->valid_sampai}}"
                                        data-stok="{{$data->stok}}"
                                        data-is_active="{{$data->is_active}}">
                                        <span class="badge rounded-pill bg-label-info"><i class="bx bx-edit-alt text-dark"></i></span>
                                    </button>
                                    <form action="{{ route('voucher.destroy', $data->id) }}" method="post">
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
            <form id="jenis-form" action="{{ route('voucher.store') }}" method="post">
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

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="nilai" class="form-label">Nilai</label>
                                <input
                                    type="number"
                                    id="nilai"
                                    class="form-control"
                                    placeholder="Nilai"
                                    name="nilai" />
                            </div>

                            <div class="col-6 mb-3">
                                <label for="nilai" class="form-label">Tipe</label>
                                <div class="d-flex justify-content-between">
                                    <div class="form-check">
                                        <input name="tipe" class="form-check-input" type="radio" value="fixed" id="fixed" checked="">
                                        <label class="form-check-label" for="fixed">Fixed</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="tipe" class="form-check-input" type="radio" value="percent" id="percent">
                                        <label class="form-check-label" for="percent">Percent</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="min_belanja" class="form-label">Min. Belanja</label>
                                <input
                                    type="text"
                                    id="min_belanja"
                                    class="form-control"
                                    placeholder="Min. belanja"
                                    name="min_belanja" />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="max_diskon" class="form-label">Max. Diskon</label>
                                <input
                                    type="text"
                                    id="max_diskon"
                                    class="form-control"
                                    placeholder="Max. Diskon"
                                    name="max_diskon" />
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Durasi</label>
                            <div class="row">
                                <div class="col-5">
                                    <input name="valid_dari" class="form-control" type="date" id="valid_dari" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-1">-</div>
                                <div class="col-5">
                                    <input name="valid_sampai" class="form-control" type="date" id="valid_sampai">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input
                                    type="integer"
                                    id="stok"
                                    class="form-control"
                                    placeholder="Stok"
                                    name="stok" />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="is_active" class="form-label">Status</label>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label" for="is_active">Aktif</label>
                                </div>
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
            $('.modal-title').text('Tambah Voucher');
            $('#jenis-form').attr('action', "{{ route('voucher.store') }}");
            $('#form-method').val('POST');
            $('#submit-btn').text('Tambah');

            $('#nilai').val('');
            $('#tipe').val('');
            $('#min_belanja').val('');
            $('#max_diskon').val('');
            $('#valid_dari').val('');
            $('#valid_sampai').val('');
            $('#is_active').val('');
            $('#stok').val('');
        });

        $('.btn-edit').click(function() {
            let id = $(this).data('id');
            let kode = $(this).data('kode');
            let nilai = $(this).data('nilai');
            let tipe = $(this).data('alamat');
            let min_belanja = $(this).data('min_belanja');
            let max_diskon = $(this).data('max_diskon');
            let valid_dari = $(this).data('valid_dari');
            let valid_sampai = $(this).data('valid_sampai');
            let is_active = $(this).data('is_active');
            let stok = $(this).data('stok');

            $('.modal-title').text('Edit Voucher');
            $('#jenis-form').attr('action', `/voucher/${id}`);
            $('#form-method').val('PUT');
            $('#submit-btn').text('Edit');

            $('#id').val(id);
            $('#kode').val(kode);
            $('#nilai').val(nilai);
            $('#tipe').val(tipe);
            $('#min_belanja').val(min_belanja);
            $('#max_diskon').val(max_diskon);
            $('#valid_dari').val(valid_dari);
            $('#valid_sampai').val(valid_sampai);
            $('#stok').val(stok);
            if (is_active == 1) {
                $('#is_active').prop('checked', true);
            } else {
                $('#is_active').prop('checked', false);
            }
        });

    });
</script>
@endsection