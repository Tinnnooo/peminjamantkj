<section class="list_barang_section" style='margin-top: 5rem;'>
    <div class="list_header_barang d-flex">
        <div class="list_barang_title">
            <h2 class="list_barang_title_text">Data Pinjam Barang</h2>
        </div>

        <div class="form-add">
          <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='{{ auth()->user()->hasRole('guru') ? route('inputPinjamBarangGuru') : route('inputPinjamBarangUser') }}'">
              <i class='bx bx-plus'></i>
              <span class="add_icon">Tambah Data</span>
          </button>
      </div>
    </div>

    <div class="row justify-content-between">
        <form class="form-inline d-flex justify-content-between" method="GET" action="{{ auth()->user()->hasRole('guru') ? route('pinjamBarangGuru') : route('pinjamBarangUser') }}">
        <div class="col-md-auto">
                <label class="my-1 mr-2" for="rowsBarang">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsBarang" onchange="this.form.submit()">
                    <option value="10" {{ $rowsBarang == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsBarang == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsBarang == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsBarang == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsBarang">entries</label>

                <input type="hidden" name="page" value="{{ $pinjambarang->currentPage() }}">
            </div>

            <div class="col-md-auto d-flex search_box" >
                <span>Search:</span>
                <input type="text" name="search" id="search" class="form-control" placeholder="Search..." value="{{ $search }}">
            </div>
        </form>
    </div>

    <table class="table">
        <thead class="thead-barang">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Guru Pengajar</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Tgl Mulai</th>
            <th scope="col">Wkt Mulai</th>
            <th scope="col">Tgl Selesai</th>
            <th scope="col">Wkt Selesai</th>
            <th scope="col">Jumlah Pinjam</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="tbody-barang">
            @php
                $no = ($pinjambarang->currentPage() - 1) * $pinjambarang->perPage() + 1;
            @endphp
            @foreach ($pinjambarang as $barang)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td style="width: 10%">{{ $barang->guru->nama_lengkap }}</td>
                <td style="width: 11%;">{{ $barang->barang->nama_barang }}</td>
                <td style="width: 11%;">{{ $barang->tgl_mulai }}</td>
                <td style="width: 9%;">{{ $barang->wkt_mulai }}</td>
                <td style="width: 11%;">{{ $barang->tgl_selesai }}</td>
                <td style="width: 9%;">{{ $barang->wkt_selesai }}</td>
                <td style="width: 2%;">{{ $barang->qty }}</td>
                <td style="width: 7%;">{{ $barang->lokasi_barang }}</td>
                <td style="width: 13%;">
                  @if($barang->status == 'menunggu')
                  <span class="bg-danger text-white p-1 d-flex justify-content-center border-success">{{ $barang->status }}</span>
                  @elseif($barang->status === 'batal pinjam')
                  <span class="bg-warning text-white p-1 d-flex justify-content-center border-success">{{ $barang->status }}</span>
                  @elseif($barang->status === 'selesai')
                  <span class="bg-success text-white p-1 d-flex justify-content-center border-success">{{ $barang->status }}</span>
                  @elseif(Str::contains($barang->status, 'approve'))
                  <span class="bg-success text-white p-1 d-flex justify-content-center border-success">{{ $barang->status }}</span>
                  @endif
                </td>
                <td style="width: 90%;">
                  @if ($barang->status === 'menunggu')
                  <div class="d-flex justify-content-around">
                      <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $barang->id }}">
                          <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                      </button>

                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalBatal{{ $barang->id }}">
                          <i style="padding: 3.5px;" class='bx bxs-trash'></i>
                      </button>
                  </div>
                  @elseif ($barang->status === 'batal pinjam')
                  <div class="d-flex justify-content-around">
                      <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $barang->id }}">
                        <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                      </button>
                      <span class="bg-warning text-white p-1 d-flex justify-content-center border-success">{{ $barang->status }}</span>
                  </div>
                  @elseif($barang->status === 'selesai')
                  <div class="d-flex justify-content-around">
                      <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $barang->id }}">
                        <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                      </button>
                      <span class="bg-success text-white p-1 d-flex justify-content-center border-success">{{ $barang->status }}</span>
                  </div>
                  @elseif(Str::contains($barang->status, 'approve'))
                  <div class="d-flex justify-content-around">
                      <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $barang->id }}">
                        <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                      </button>

                      <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalKembalikan{{ $barang->id }}">
                        <i style="padding: 3.5px;" class='bx bx-rotate-left text-white'></i>
                    </button>
                  </div>
                  @endif
                </td>
            </tr>

            {{--  MODAL VIEW  --}}
            <div class="modal fade" id="modal{{ $barang->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Detail</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group mt-2">
                        <label for="nama_guru">Guru Pengajar:</label>
                        <input type="text" class="form-control" id="nama_guru" value="{{ $barang->guru->nama_lengkap }}" readonly>
                      </div>

                        <div class="form-group mt-4">
                            <label for="nama_barang">Nama Barang:</label>
                            <input type="text" class="form-control" id="nama_barang" value="{{ $barang->barang->nama_barang }}" readonly>
                          </div>

                          <div class="form-group d-flex tglwkt mt-4">
                            <div class="form-group">
                              <label for="tgl_mulai">Tgl Mulai:</label>
                              <input type="text" class="form-control" id="tgl_mulai" value="{{ $barang->tgl_mulai }}" readonly>
                            </div>

                            <div class="form-group">
                              <label for="wkt_mulai">Wkt Mulai:</label>
                              <input type="text" class="form-control" id="wkt_mulai" value="{{ $barang->wkt_mulai }}" readonly>
                            </div>
                          </div>

                          <div class="form-group d-flex tglwkt mt-4">
                            <div class="form-group">
                              <label for="tgl_selesai">Tgl Selesai:</label>
                              <input type="text" class="form-control" id="tgl_selesai" value="{{ $barang->tgl_selesai }}" readonly>
                            </div>

                            <div class="form-group">
                              <label for="wkt_selesai">Wkt Selesai:</label>
                              <input type="text" class="form-control" id="wkt_selesai" value="{{ $barang->wkt_selesai }}" readonly>
                            </div>
                          </div>

                          <div class="form-group mt-4">
                            <label for="status">Status:</label>
                            <input type="text" class="form-control" id="status" value="{{ $barang->status }}" readonly>
                          </div>

                          <div class="form-group mt-4">
                            <label for="lokasi">Lokasi Barang:</label>
                            <input type="text" class="form-control" id="lokasi" value="{{ $barang->lokasi_barang }}" readonly>
                          </div>

                          <div class="form-group mt-4">
                            <label for="deskripsi">Deskripsi:</label>
                            <input type="text" class="form-control" id="deskripsi" value="{{ $barang->barang->deskripsi }}" readonly>
                          </div>
                    </div>

                    <div class="form-group mt-3">
                      <img src="{{ asset('storage/images/'.$barang->barang->foto) }}" alt="Foto Ruangan" class="modal-foto">
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>

            {{--  MODAL BATAL  --}}
            <div class="modal fade" id="modalBatal{{ $barang->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Batalkan Pinjaman</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ auth()->user()->hasRole('guru') ? route('batalkanPinjamanGuru', $barang->id) : route('batalkanPinjamanUser', $barang->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                      <div class="form-group mt-0">
                        <label for="tgl_selesai">Tgl Pembatalan:</label>
                        <input type="text" class="form-control" name="tgl_selesai" id="tgl_selesai" value="{{ date('Y-m-d') }}" readonly>
                      </div>

                      <div class="form-group mt-2">
                        <label for="wkt_selesai">Wkt Pembatalan:</label>
                        <?php
                        date_default_timezone_set('Asia/Jakarta');
                        $currentTime = date('H:i:s');
                        ?>
                        <input type="text" class="form-control" name="wkt_selesai" id="wkt_selesai" value="{{ $currentTime }}" readonly>
                      </div>

                      <div class="form-group">
                        <span>Apakah anda ingin Membatalkan Pinjaman ini?</span>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Batal Pinjam</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
                  </div>
                </div>
            </div>

            {{--  MODAL KEMBALIKAN  --}}
            <div class="modal fade" id="modalKembalikan{{ $barang->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">Kembalikan Pinjaman</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="POST" action="{{ auth()->user()->hasRole('guru') ? route('kembalikanPinjamanGuru', $barang->id) : route('kembalikanPinjamanUser', $barang->id) }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                  <div class="modal-body">
                    <div class="form-group mt-0">
                      <label for="tgl_selesai">Tgl Kembali:</label>
                      <input type="text" class="form-control" name="tgl_selesai" id="tgl_selesai" value="{{ date('Y-m-d') }}" readonly>
                    </div>

                    <div class="form-group mt-2">
                      <label for="wkt_selesai">Wkt Kembali:</label>
                      <?php
                      date_default_timezone_set('Asia/Jakarta');
                      $currentTime = date('H:i:s');
                      ?>
                      <input type="text" class="form-control" name="wkt_selesai" id="wkt_selesai" value="{{ $currentTime }}" readonly>
                    </div>

                    <div class="form-group">
                      <span>Apakah anda ingin Mengembalikan Pinjaman ini?</span>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-warning text-white" data-bs-dismiss="modal">Kembalikan Pinjaman</button>
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                  </div>
              </form>
                </div>
              </div>
          </div>

            @endforeach

        </tbody>

    </table>

        @if (count($pinjambarang) === 0)
            <h5>Tidak ada data.</h5>
        @endif

        <div class="list-pagination">
            {{$pinjambarang->appends(['rowsBarang' => $rowsBarang])->links('pagination::bootstrap-5')}}
        </div>

</section>
