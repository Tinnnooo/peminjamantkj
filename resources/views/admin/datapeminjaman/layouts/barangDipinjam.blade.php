<section class="list_barang_section" style='margin-top: 5rem;'>
    <div class="list_header d-flex">
        <div class="list-title">
            <h2 class="list-title_text">Data Pinjam Barang</h2>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-auto">
            <form class="form-inline" method="GET" action="{{ route('barangDipinjam') }}">
                <label class="my-1 mr-2" for="rowsBarang">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsBarang" onchange="this.form.submit()">
                    <option value="10" {{ $rowsBarang == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsBarang == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsBarang == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsBarang == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsBarang">entries</label>

                <input type="hidden" name="page" value="{{ $pinjambarang->currentPage() }}">
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
            <th scope="col">Nama Peminjam</th>
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
                <td style="width: 9%;">{{ $barang->user->nama_lengkap }}</td>
                <td style="width: 13%;">{{ $barang->barang->nama_barang }}</td>
                <td style="width: 11%;">{{ $barang->tgl_mulai }}</td>
                <td style="width: 10%;">{{ $barang->wkt_mulai }}</td>
                <td style="width: 11%;">{{ $barang->tgl_selesai }}</td>
                <td style="width: 10%;">{{ $barang->wkt_selesai }}</td>
                <td style="width: 5%;">{{ $barang->qty }}</td>
                <td style="width: 10%;">{{ $barang->lokasi_barang }}</td>
                <td style="width: 11%;">
                  @if($barang->status == 'menunggu')
                  <span class="bg-danger text-white p-1 rounded-5 border-success">{{ $barang->status }}</span>
                  @elseif($barang->status === 'batal pinjam')
                  <span class="bg-warning text-white p-1 rounded-5 border-success">{{ $barang->status }}</span>
                  @elseif($barang->status === 'selesai')
                  <span class="bg-success text-white p-1 rounded-5 border-success">{{ $barang->status }}</span>
                  @elseif(Str::contains($barang->status, 'approve'))
                  <span class="bg-success text-white p-1 rounded-5 border-success">{{ $barang->status }}</span>
                  @endif
                </td>
                <td style="width: 90%;">
                  @if ($barang->status === 'menunggu')
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $barang->id }}">
                            <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                        </button>

                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalApprove{{ $barang->id }}">
                            <i style="padding: 3.5px;" class='bx bx-check-circle'></i>
                        </button>
                  @elseif ($barang->status === 'selesai')
                  <span class="bg-success text-white p-1 rounded-5 border-success">{{ $barang->status }}</span>
                  @elseif(Str::contains($barang->status, 'approve'))
                  <span class="bg-success text-white p-1 rounded-5 border-success">{{ $barang->status }}</span>
                  @elseif($barang->status ==='batal pinjam')
                  <span class="bg-warning text-white p-1 rounded-5 border-success">{{ $barang->status }}</span>
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
                        <div class="form-group">
                            <label for="nama_peminjam">Nama Peminjam:</label>
                            <input type="text" class="form-control" id="nama_peminjam" value="{{ $barang->user->nama_lengkap }}" readonly>
                          </div>
                        <div class="form-group mt-4">
                            <label for="nama_barang">Nama Barang:</label>
                            <input type="text" class="form-control" id="nama_barang" value="{{ $barang->barang->nama_barang }}" readonly>
                          </div>
                          <div class="form-group mt-4">
                            <label for="jumlah">Jumlah Pinjam:</label>
                            <input type="text" class="form-control" id="jumlah" value="{{ $barang->qty }}" readonly>
                          </div>

                          <div class="form-group mt-4">
                            <label for="lokasi">Lokasi Barang:</label>
                            <input type="text" class="form-control" id="lokasi" value="{{ $barang->lokasi_barang }}" readonly>
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

            {{--  MODAL APPROVE  --}}
            <div class="modal fade" id="modalApprove{{ $barang->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Approve Peminjaman</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('approvePinjamBarang', $barang->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                            <span>Approve peminjaman {{ $barang->user->nama_lengkap }} untuk meminjam {{ $barang->barang->nama_barang }} ?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Approve</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
