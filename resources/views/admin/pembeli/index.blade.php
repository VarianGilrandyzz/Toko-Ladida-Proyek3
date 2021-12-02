@extends('adminlte::page')

@section('title', 'Daftar pembeli')

@section('content_header')
    <div class="row">
      <div class="col-auto mr-auto">
        <h1>Daftar pembeli</h1>
      </div>
      <div class="col-auto">
        <a class="btn btn-primary" href="{{ route('pembeli.create') }}">Tambahkan Pembeli Baru</a>
      </div>
  </div>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table table-light" id="tabel">
                     <thead>
                       <td>ID</td>
                       <td>Nama Lengkap</td>
                       <td>No. Telp</td>
                       <td>Action</td>
                     </thead>
                     <tbody>
                       @foreach ($data as $pembeli)
                          <tr>
                            <td>{{$pembeli->id_pembeli}}</td>
                            <td>{{$pembeli->nama_lengkap}}</td>
                            <td>
                              <a href="tel:+62{{$pembeli->no_telp}}">+62{{$pembeli->no_telp}}</a>
                            </td>
                            <td>
                              <a class="btn btn-secondary" href="http://wa.me/62{{$pembeli->no_telp}}" target="blank">WA <i class="fa fa-whatsapp-square" aria-hidden="true"></i></a>
                              -
                              <a class="btn btn-primary" href="{{ route('pembeli.show', ['pembeli'=>$pembeli->id_pembeli]) }}">Show</a>
                              <a class="btn btn-warning" href="{{ route('pembeli.edit', ['pembeli'=>$pembeli->id_pembeli]) }}">Edit</a>
                              <button 
                                class="btn btn-danger" 
                                data-toggle="modal" 
                                data-target="#hapus" 
                                data-name="{{$pembeli->nama_lengkap}}"
                                data-url="{{ route('pembeli.destroy', ['pembeli'=>$pembeli->id_pembeli]) }}"
                              >
                                delete
                              </button>
                            </td>
                          </tr>
                       @endforeach
                     </tbody>
                   </table>
                </div>

                {{-- Modal Hapus Data --}}
                <div class="modal" tabindex="-1" role="dialog" id="hapus">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">back</button>
                        <form action="" method="post" id="formHapus">
                          @csrf
                          <input type="hidden" name="_method" value="delete" />
                          <button type="submit" class="btn btn-danger">delete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
      @media only screen and (max-width: 768px) {
        table.dataTable{
          width: auto!important
        }
      }
    </style>
@stop

@section('plugins.Datatables', true)

@section('js')
  <script>
    var table = $('#tabel').DataTable({
      responsive: true
    });

    $('#hapus').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var name = button.data('name')
      var url = button.data('url') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-body p').text('Hapus pembeli : ' + name)
      modal.find('.modal-footer #formHapus').attr('action',url)
    })

    @include('componen.toast')    
  </script>
@endsection