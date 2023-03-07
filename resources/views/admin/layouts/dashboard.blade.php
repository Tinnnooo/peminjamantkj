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
