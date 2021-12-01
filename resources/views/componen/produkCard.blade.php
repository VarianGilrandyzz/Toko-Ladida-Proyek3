<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
  <div class="icon-box produk-card" data-aos="fade-up" data-aos-delay="200" 
    style="background:linear-gradient(to top, #106eea23, #106eea6b), url('/upload/{{$item['gambar']}}')">
    <h4 class="title"><a href="">{{$item['nama_barang']}}</a></h4>
    <p class="description">{{$item['deskripsi']}}</p>
    <p class="description"><b>Rp. {{$item['harga']}}</b></p>
    @if ($btn)
        <div class="btn-beli">
          <label class="btn btn-light">
            <input type="checkbox" name='produk' value="{{$item['id']}}"> Tambahkan
          </label>
        </div>
    @endif
  </div>
</div>