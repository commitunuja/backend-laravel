@extends('template/bootstrap')
@section('title')
    Tampil Data Supplier
@endsection

@section('content')
<div class="card">
        <div class="card-header">
            Tampil Data Supplier
        </div>
        <div class="card-body">
            <a href="{{route('supplier.create') }}" class="btn btn-success">Create</a>
            <hr/>
          <table class ="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Nama Supplier</th>
                    <th>Telp Supplier</th>
                    <th>Alamat Supplier</th>
                    <th>Action</th>   
                </tr>
                @foreach($data_supplier as $row)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $row->nama_supplier}}</td>
                    <td>{{ $row->telp_supplier}}</td>
                    <td>{{ $row->alamat_supplier}}</td>
                    <td>
                    
                    <form method="post" action="{{route('supplier.destroy',[$row->kd_supplier]) }}">
                    @csrf
                    {{method_field('DELETE')}}
                    <a href="{{route('supplier.edit',[$row->kd_supplier]) }}" class="btn btn-warning">Edit</a>
                    <a href="{{route('supplier.show',[$row->kd_supplier]) }}" class="btn btn-info">Detail</a>
                    <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                    </td>
                </tr>
                @endforeach
          </table>
        </div>
    </div>
@endsection
