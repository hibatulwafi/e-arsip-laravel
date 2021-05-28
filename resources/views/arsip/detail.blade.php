
@extends('layouts.auth')

@section('content')
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
           <div class="row">
	           <div class="col-12 text-center">
	          		<img src="{{ asset('/img/arsip.png')}}" class="brand-image img-circle elevation-2" style="opacity: .8 ; margin-bottom:10px;" width="60px">
	           </div>
	           <div class="col-12">
	           		<h4> <p class="login-box-msg">Detail Arsip</p></h4>
	           </div>
           </div>

	        <div class="callout callout-info mt-3 small">
	        <table class="table">
	        	<tr>
	        		<td>Nama Arsip</td>
	        		<td>:</td>
	        		<td>{{$qry->nama_arsip}}</td>
	        	</tr>
	        	<tr>
	        		<td>Rak</td>
	        		<td>:</td>
	        		<td>{{$qry->nama_rak}}</td>
	        	</tr>
	        	<tr>
	        		<td>Customer</td>
	        		<td>:</td>
	        		<td>{{$qry->nama_customer}}</td>
	        	</tr>
	        	<tr>
	        		<td>No Polis</td>
	        		<td>:</td>
	        		<td>{{$qry->no_polis}}</td>
	        	</tr>
	        	<tr>
	        		<td>No Kontrak</td>
	        		<td>:</td>
	        		<td>{{$qry->no_kontrak}}</td>
	        	</tr>
	        	<tr>
	        		<td>Valid</td>
	        		<td>:</td>
	        		<td>{{date_format(date_create($qry->tanggal_valid),"d, M Y") }}</td>
	        	</tr>
	        	<tr>
	        		<td>Status</td>
	        		<td>:</td>
	        		<td> 
	        		  @if($qry->status_arsip == 0)
	                    <span class="badge badge-danger">archieved</span>
	                  @elseif($qry->status_arsip == 1)
	                    <span class="badge badge-success">on shelf</span>
	                  @elseif($qry->status_arsip == 2)
	                    <span class="badge badge-info">Dipinjam</span>
	                  @else
	                    <span class="badge badge-danger">Error</span>
	                  @endif
                    </td>
	        	</tr>
	        	<tr>
	        		<td>Keterangan</td>
	        		<td>:</td>
	        		<td>{{$qry->keterangan_arsip}}</td>
	        	</tr>
	        	  @if($qry->status_arsip == 1)
	                <tr>
	        		<td colspan="3">
	        		<center>
	        			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#pinjamModal">Pinjam Arsip</button>
	        		</center>
	        		</td>
	        		</tr>
	              @elseif($qry->status_arsip == 2)
  					<tr>
	        		<td colspan="3">
	        		<center>
	        			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#kembaliModal">Pengembalian Arsip</button>
	        		</center>
	        		</td>
	        		</tr>
	              @else
	                <span class="badge badge-danger">Error</span>
	              @endif
	        	
	        </table>
	        </div>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- Modal Pinjam-->
<div class="modal fade" id="pinjamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Peminjaman Arsip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('peminjaman.pinjamBarcode')}}" method="POST" id="pinjamForm">
            @csrf
            <div class="modal-body">
            	<div class="col-12">
                    <div class="form-group">
                         <input type="hidden" name="id_arsip" id="id_arsip" class="form-control @error('id_arsip') is-invalid @enderror" value="{{$qry->id_arsip}}">
                        @error('id_arsip')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            	<div class="col-12">
                    <div class="form-group">
                        <label for="id_peminjam">Arsip</label>
                         <input type="text" name="nama_arsip" id="nama_arsip" class="form-control @error('nama_arsip') is-invalid @enderror" value="{{$qry->nama_arsip}}" readonly="">
                        @error('nama_arsip')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="id_peminjam">Nama</label>
                         <select name="id_peminjam" id="id_peminjam" class="form-control @error('id_peminjam') is-invalid @enderror">
                            @foreach ($user as $row)
                            <option value="{{ $row->id  }}"
                                    @if ($row->name == old('name'))
                                        selected
                                    @endif    
                                >
                                {{ $row->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_peminjam')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-success">Ya, Pinjam</button>
            </div>
            </form>

        </div>
    </div>
</div>


<!-- Modal Pinjam-->
<div class="modal fade" id="kembaliModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Pengembalian Arsip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('peminjaman.pinjamBarcode')}}" method="POST" id="pinjamForm">
            @csrf
            <div class="modal-body">
            	<div class="col-12">
                    <div class="form-group">
                         <input type="hidden" name="id_arsip" id="id_arsip" class="form-control @error('id_arsip') is-invalid @enderror" value="{{$qry->id_arsip}}">
                        @error('id_arsip')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            	<div class="col-12">
                    <div class="form-group">
                        <label for="id_peminjam">Arsip</label>
                         <input type="text" name="nama_arsip" id="nama_arsip" class="form-control @error('nama_arsip') is-invalid @enderror" value="{{$qry->nama_arsip}}" readonly="">
                        @error('nama_arsip')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <table class="table table-head-fixed text-nowrap table-stripped  table-hover" id="myTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Peminjam</th>
                                        <th>Tgl Pinjam</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($no=1)
                                    @forelse($peminjaman as $row)
                                        <tr>
                                            <td width="5%" class="text-center">{{$no++}}</td>
                                            <td>{{$row->nama_peminjam }}</td>
                                            <td class="text-center">{{date_format(date_create($row->tanggal_peminjaman),"d, M Y") }}</td>
                                          
                                            <td style="width: 20px">
                                               
                                                <a class="btn btn-info btn-sm" href="{{url('kembaliBarcode/'.$row->id_peminjaman)}}">
                                                    <i class="fas fa-reply"></i>
                                                    Pengembalian
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Data Tidak Ada</td>
                                        </tr>
                                    @endforelse
    
                                </tbody>
                            </table>
                </div>
               
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>

        </div>
    </div>
</div>

@endsection


@section('scripts')


@if(session()->has('success'))
    <script>
        $(document).ready(function () {
            toastr["success"]('{{ session()->get('success') }}')
        });

    </script>
@endif

@if(session()->has('error'))
    <script>
        $(document).ready(function () {
            toastr["info"]('{{ session()->get('error') }}')
        });

    </script>
@endif

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">
@endsection
