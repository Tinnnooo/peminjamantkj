<main class="d-flex main-card">
<section class="cards-section">   
        <div class="card cards-section_card">
            <div class="card-body">
                <i class='bx bxs-box card-title card-body_icon'></i>
                <h6 class="card-subtitle mb-2 text-muted">Data Barang</h6>
                <p class="card-text">{{ count($barang) }}</p>
            </div>
          </div>

          <div class="card cards-section_card">
            <div class="card-body">
                <i class='bx bx-building card-title card-body_icon'></i>
              <h6 class="card-subtitle mb-2 text-muted">Data Ruangan</h6>
              <p class="card-text">{{ count($ruangan) }}</p>
            </div>
          </div>

          <div class="card cards-section_card">
            <div class="card-body">
                <i class='bx bxs-user-detail card-title card-body_icon'></i>
              <h6 class="card-subtitle mb-2 text-muted">Data User</h6>
              <p class="card-text">{{ count($user) }}</p>
            </div>
          </div>

          <div class="card cards-section_card">
            <div class="card-body">
                <i class='bx bxs-hdd card-title card-body_icon'></i>
              <h6 class="card-subtitle mb-2 text-muted">Pinjam Barang</h6>
              <p class="card-text">{{ $countBarang }}</p>
            </div>
          </div>

          <div class="card cards-section_card">
            <div class="card-body">
                <i class='bx bx-door-open card-title card-body_icon'></i>
              <h6 class="card-subtitle mb-2 text-muted">Pinjam Ruangan</h6>
              <p class="card-text">{{ $countRuangan }}</p>
            </div>
          </div>
    </section>

@if(auth()->user()->hasAnyRole(['guru', 'user']))
<section class="cards-section peraturan">
  <div class="card cards-section_card">
    <div class="card-body d-flex">
        <div class="row">
          <div class="col-icon h1"><span class='bx bxs-alarm-exclamation'></span></div>
        </div>
        <div class="col col-stats">
          <div class="noted">
            <p class="card-subtitle text-muted h3">Peraturan Peminjaman</p>
            <div class="noted-text mt-3">
              <h5 class="text-muted">Hanya diizinkan meminjam alat dengan izin guru yang mengajar.</h5>
              <h5 class="text-muted">Pastikan cek alat yang dipinjam terlebih dahulu.</h5>
              <h5 class="text-muted">Wajib mengisi pengajuan peminjaman..</h5>
              <h5 class="text-muted">Barang yang rusak karena dipinjam tanpa identitas, menjadi tanggung jawab kelas.</h5>
              <h5 class="text-muted">Barang yang rusak diganti dengan barang yang sama.</h5>
          </div>
          </div>
        </div>
    </div>
  </div>
</section>
@endif
  </main>