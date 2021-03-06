@extends('home.layout')

@section('body')
    <main id="main" data-aos="fade-up">
    
      @include('componen.breadcrumbs',['page'=>'Pemesanan'])

      <form action="{{ route('proses.pemesanan') }}" method="POST">
      {{-- <form action="#" method="GET"> --}}
        @csrf
        <!-- Quantity Section -->
        <section class="inner-page">
          <div class="container">
            
            <div class="section-title">
              <h2>Tentukan Jumlah</h2>
            </div>
            <p>Daftar Barang</p>
            <div id="formJumlah" class="col">

            </div>

          </div>
        </section>
        <!-- end Quantity Section -->

        <!-- Identitas Section -->
        <section class="inner-page">
          <div class="container">
            
            <div class="section-title">
              <h2>Isi Identitas</h2>
            </div>
            
            {{-- Form alamat --}}
            <div class="form-group">
              <div class="form-row row">
                <div class="form-group col-md-6">
                  <label for="Input Nama">Nama</label>
                  <input type="text" class="form-control {{ $errors->has('no_telp') ? 'is-invalid' : '' }}" id="InputNama" name="nama_lengkap"
                    value="{{ old('nama_lengkap') }}" placeholder="Masukan Nama" >
                    @if($errors->has('nama_lengkap'))
                      <div class="invalid-feedback">
                          <strong>{{ $errors->first('nama_lengkap') }}</strong>
                      </div>
                    @endif
                </div>
                <div class="form-group col-md-6">
                  <label for="phone">Telepon/WA</label>
                  <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            +62
                        </div>
                    </div>
                    <input type="number" name="no_telp" class="form-control {{ $errors->has('no_telp') ? 'is-invalid' : '' }}"
                          value="{{ old('no_telp') }}" placeholder="No. telp/WA pembeli">                    
                    @if($errors->has('no_telp'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('no_telp') }}</strong>
                        </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea name="alamat" id="alamat" class="form-control {{ $errors->has('no_telp') ? 'is-invalid' : '' }}" rows="5" 
                placeholder="Alamat Lengkap">{{ old('alamat') }}</textarea>
              @if($errors->has('alamat'))
                  <div class="invalid-feedback">
                      <strong>{{ $errors->first('alamat') }}</strong>
                  </div>
              @endif
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="agree" id="gridCheck" required>
                <label class="form-check-label" for="gridCheck">
                  Saya Setuju dengan Persyaratan Pembelian
                </label>
              </div>
            </div>
            {{-- End alamat --}}
            <button type="submit" class="btn btn-primary" >Lakukan Pemesanan</button>
          </div>
        </section>
        {{-- end identitas section --}}

      </form>

  </main>
@endsection

@section('js')
    <script>
      function addForm() {
        const data = cart.getCart();
        const formJumlah = document.getElementById('formJumlah');
        let form = '<hr>';
        let i = 1;
        if (cart.cartCount()!=0) {
          data.forEach(e => {
            form += "<div class='input-group mb-3 row'>"+
              "<input type='hidden' name='id[]' value="+e.id+">"+
              "<label class='col-sm-2 col-form-label'> - "+e.nama+"</label>"+
              "<label class='col-sm-2 col-form-label'> @"+e.harga+"</label>"+
              "<input type='hidden' name='harga[]' value="+e.harga+">"+
              "<label class='col-sm-2 col-form-label'>Jumlah : </label>"+
              "<select class='form-control col-sm-2 col-form-label' name='qtw[]''>"+
                "<option value='1'>1</option>"+
                "<option value='2'>2</option>"+
                "<option value='3'>3</option>"+
                "<option value='4'>4</option>"+
                "<option value='5'>5</option>"+
              "</select>"+
              "<button class='btn btn-danger col-sm-1' type='button' data-id="+e.id+" onclick='removeItem(this)'><i class='fa fa-trash' aria-hidden='true'></i></button>"+
              "</div><hr>"
              i++
          });
        }else{
          form+="Tidak ada Barang di Keranjang"
        }
        formJumlah.innerHTML = form
      }
      function removeItem(btn) {
        cart.removeItemCart(btn.dataset.id);
        addForm();
        updateIconCart(cart.cartCount());
      }
      addForm();
    </script>
@endsection