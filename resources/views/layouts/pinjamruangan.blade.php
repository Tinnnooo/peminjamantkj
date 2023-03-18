<section class="list_barang_section" style='margin-top: 5rem;'>
    <div class="list_header d-flex">
        <div class="list-title">
            <h2 class="list-title_text">Data Pinjam Ruangan</h2>
        </div>

        <div class="form-add">
          <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='{{ auth()->user()->hasRole('guru') ? route('inputPinjamRuanganGuru') : route('inputPinjamRuanganUser') }}'">
              <i class='bx bx-plus'></i>
              <span class="add_icon">Tambah Data</span>
          </button>
      </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-auto">
            <form class="form-inline" method="GET" action="{{ auth()->user()->hasRole('guru') ? route('pinjamRuanganGuru') : route('pinjamRuanganUser') }}">
                <label class="my-1 mr-2" for="rowsRuangan">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsRuangan" onchange="this.form.submit()">
                    <option value="10" {{ $rowsRuangan == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsRuangan == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsRuangan == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsRuangan == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsRuangan">entries</label>

                <input type="hidden" name="page" value="{{ $pinjamruangan->currentPage() }}">
            </form>
        </div>

        <div class="col-md-auto" >
                <input type="text" name="search" id="search" placeholder="Search...">
        </div>
    </div>

    <table class="table">
        <thead class="thead-barang">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Guru Pengajar</th>
            <th scope="col">Nama Ruangan</th>
            <th scope="col">Tgl Mulai</th>
            <th scope="col">Wkt Mulai</th>
            <th scope="col">Tgl Selesai</th>
            <th scope="col">Wkt Selesai</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="tbody-barang">
            @php
                $no = ($pinjamruangan->currentPage() - 1) * $pinjamruangan->perPage() + 1;
            @endphp
            @foreach ($pinjamruangan as $ruangan)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td style="width: 12%">{{ $ruangan->guru->nama_lengkap }}</td>
                <td style="width: 12%;">{{ $ruangan->ruangan->nama_ruangan }}</td>
                <td style="width: 11%;">{{ $ruangan->tgl_mulai }}</td>
                <td style="width: 11%;">{{ $ruangan->wkt_mulai }}</td>
                <td style="width: 11%;">{{ $ruangan->tgl_selesai }}</td>
                <td style="width: 11%;">{{ $ruangan->wkt_selesai }}</td>
                <td style="width: 13%;">
                  @if($ruangan->status == 'menunggu')
                  <span class="bg-danger text-white p-1 rounded-5 border-success">{{ $ruangan->status }}</span>
                  @elseif($ruangan->status === 'batal pinjam')
                  <span class="bg-warning text-white p-1 rounded-5 border-success">{{ $ruangan->status }}</span>
                  @elseif($ruangan->status === 'selesai')
                  <span class="bg-success text-white p-1 rounded-5 border-success">{{ $ruangan->status }}</span>
                  @elseif(Str::contains($ruangan->status, 'approve'))
                  <span class="bg-success text-white p-1 rounded-5 border-success">{{ $ruangan->status }}</span>
                  @endif
                </td>
                <td style="width: 90%;">
                  @if ($ruangan->status === 'menunggu')
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $ruangan->id }}">
                            <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalBatal{{ $ruangan->id }}">
                            <i style="padding: 3.5px;" class='bx bxs-trash'></i>
                        </button>
                  @elseif ($ruangan->status === 'batal pinjam')
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $ruangan->id }}">
                      <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                    </button>
                    <span class="bg-warning text-white p-1 rounded-5 border-success">{{ $ruangan->status }}</span>
                  @elseif($ruangan->status === 'selesai')
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $ruangan->id }}">
                      <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                    </button>
                    <span class="bg-success text-white p-1 rounded-5 border-success">{{ $ruangan->status }}</span>
                  @elseif(Str::contains($ruangan->status, 'approve'))
                  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $ruangan->id }}">
                    <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                  </button>

                  <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalKembalikan{{ $ruangan->id }}">
                    <i style="padding: 3.5px;" class='bx bx-rotate-left text-white'></i>
                </button>
                  @endif
                </td>
            </tr>

            {{--  MODAL VIEW  --}}
            <div class="modal fade" id="modal{{ $ruangan->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Detail</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <div class="form-group mt-2">
                        <label for="nama_guru">Guru Pengajar:</label>
                        <input type="text" class="form-control" id="nama_guru" value="{{ $ruangan->guru->nama_lengkap }}" readonly>
                      </div>

                        <div class="form-group mt-4">
                            <label for="nama_ruangan">Nama Ruangan:</label>
                            <input type="text" class="form-control" id="nama_ruangan" value="{{ $ruangan->ruangan->nama_ruangan }}" readonly>
                          </div>

                          <div class="form-group d-flex tglwkt mt-4">
                            <div class="form-group">
                              <label for="tgl_mulai">Tgl Mulai:</label>
                              <input type="text" class="form-control" id="tgl_mulai" value="{{ $ruangan->tgl_mulai }}" readonly>
                            </div>

                            <div class="form-group">
                              <label for="wkt_mulai">Wkt Mulai:</label>
                              <input type="text" class="form-control" id="wkt_mulai" value="{{ $ruangan->wkt_mulai }}" readonly>
                            </div>
                          </div>

                          <div class="form-group d-flex tglwkt mt-4">
                            <div class="form-group">
                              <label for="tgl_selesai">Tgl Selesai:</label>
                              <input type="text" class="form-control" id="tgl_selesai" value="{{ $ruangan->tgl_selesai }}" readonly>
                            </div>

                            <div class="form-group">
                              <label for="wkt_selesai">Wkt Selesai:</label>
                              <input type="text" class="form-control" id="wkt_selesai" value="{{ $ruangan->wkt_selesai }}" readonly>
                            </div>
                          </div>

                          <div class="form-group mt-4">
                            <label for="status">Status:</label>
                            <input type="text" class="form-control" id="status" value="{{ $ruangan->status }}" readonly>
                          </div>

                          <div class="form-group mt-4">
                            <label for="deskripsi">Deskripsi:</label>
                            <input type="text" class="form-control" id="deskripsi" value="{{ $ruangan->ruangan->deskripsi }}" readonly>
                          </div>
                    </div>

                    <div class="form-group mt-3">
                      <img src="{{ asset('storage/images/'.$ruangan->ruangan->foto) }}" alt="Foto Ruangan" class="modal-foto">
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>

            {{--  MODAL BATAL  --}}
            <div class="modal fade" id="modalBatal{{ $ruangan->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Batalkan Pinjaman</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ auth()->user()->hasRole('guru') ? route('batalkanPinjamRuanganGuru', $ruangan->id) : route('batalkanPinjamRuanganUser', $ruangan->id) }}" enctype="multipart/form-data">
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
            <div class="modal fade" id="modalKembalikan{{ $ruangan->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">Kembalikan Pinjaman</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="POST" action="{{ auth()->user()->hasRole('guru') ? route('kembalikanRuanganGuru', $ruangan->id) : route('kembalikanRuanganUser', $ruangan->id) }}" enctype="multipart/form-data">
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

        @if (count($pinjamruangan) === 0)
            <h5>Tidak ada data.</h5>
        @endif

        <div class="list-pagination">
            {{$pinjamruangan->appends(['rowsRuangan' => $rowsRuangan])->links('pagination::bootstrap-5')}}
        </div>

</section>
