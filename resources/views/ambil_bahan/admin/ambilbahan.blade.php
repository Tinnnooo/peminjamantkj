<section class="list_barang_section" style='margin-top: 5rem;'>
    <div class="list_header_barang d-flex">
        <div class="list_barang_title">
            <h2 class="list_barang_title_text">List Ambil Bahan</h2>
        </div>

        <a href="{{ route('ambilbahan.export') }}" class="btn btn-sm btn-info text-white text-center"><i class='bx bx-export' style="margin-right: 8px;"></i>Export Data</a>
    </div>

    <div class="row justify-content-between">
        <form class="form-inline d-flex justify-content-between" method="GET" action="{{ auth()->user()->hasRole('admin') ? route('admin.ambilBahan') : route('guru.ambilBahan') }}">
        <div class="col-md-auto">
                <label class="my-1 mr-2" for="rowsBahan">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsBahan" onchange="this.form.submit()">
                    <option value="10" {{ $rowsBahan == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsBahan == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsBahan == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsBahan == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsBahan">entries</label>

                <input type="hidden" name="page" value="{{ $ambil_bahan->currentPage() }}">
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
            <th scope="col">Nama Pengambil</th>
            <th scope="col">Nama Bahan</th>
            <th scope="col">Tgl Ambil</th>
            <th scope="col">Wkt Ambil</th>
            <th scope="col">Jumlah Ambil</th>
            <th scope="col">Peruntukan</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="tbody-barang">
            @php
                $no = ($ambil_bahan->currentPage() - 1) * $ambil_bahan->perPage() + 1;
            @endphp
            @foreach ($ambil_bahan as $bahan)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td style="width: 15%;">{{ $bahan->user->nama_lengkap }}</td>
                <td style="width: 15%;">{{ $bahan->bahan->nama_bahan }}</td>
                <td style="width: 10%;">{{ $bahan->tgl_ambil }}</td>
                <td style="width: 10%;">{{ $bahan->wkt_ambil }}</td>
                <td style="width: 10%;">{{ $bahan->qty }}</td>
                <td style="width: 10%;">{{ $bahan->deskripsi }}</td>
                <td style="width: 12%;">
                  @if($bahan->status == 'menunggu')
                    <span class="bg-danger text-white p-1 d-flex justify-content-center border-success">{{ $bahan->status }}</span>
                    @elseif($bahan->status == 'batal ambil')
                    <span class="bg-warning text-white p-1 d-flex justify-content-center border-success">{{ $bahan->status }}</span>
                    @elseif(Str::contains($bahan->status, 'approve'))
                    <span class="bg-success text-white p-1 d-flex justify-content-center border-success">{{ $bahan->status }}</span>
                    @endif
                </td>
                <td style="width: 90%;">
                  @if ($bahan->status === 'menunggu')
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $bahan->id }}">
                      <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalApprove{{ $bahan->id }}">
                      <i style="padding: 3.5px;" class='bx bx-check-circle'></i>
                  </button>
                  @elseif($bahan->status == 'batal ambil')
                  <div class="d-flex justify-content-around">
                      <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $bahan->id }}">
                          <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                      </button>

                      <span class="bg-warning text-white p-1 d-flex justify-content-center border-success">{{ $bahan->status }}</span>
                  </div>
                  @elseif(Str::contains($bahan->status, 'approve'))
                  <div class="d-flex justify-content-around">
                      <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $bahan->id }}">
                          <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                      </button>
                      <span class="bg-success text-white p-1 d-flex justify-content-center border-success">{{ $bahan->status }}</span>
                  </div>
                  @endif

                </td>
            </tr>

            {{--  MODAL VIEW  --}}
            <div class="modal fade" id="modal{{ $bahan->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Detail</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_pengambil">Nama Pengambil:</label>
                            <input type="text" class="form-control" id="nama_pengambil" value="{{ $bahan->user->nama_lengkap }}" readonly>
                          </div>

                        <div class="form-group mt-4">
                            <label for="nama_barang">Nama Bahan:</label>
                            <input type="text" class="form-control" id="nama_barang" value="{{ $bahan->bahan->nama_bahan }}" readonly>
                          </div>

                          <div class="form-group mt-4">
                            <label for="qty">Qty:</label>
                            <input type="text" class="form-control" id="qty" value="{{ $bahan->qty }}" readonly>
                          </div>

                          <div class="form-group mt-4">
                            <label for="status">Status:</label>
                            <input type="text" class="form-control" id="status" value="{{ $bahan->status }}" readonly>
                          </div>
                          <div class="form-group mt-4 d-flex tglwkt">
                            <div class="form group">
                                <label for="tgl_ambil">Tgl Ambil:</label>
                                <input type="text" class="form-control" id="tgl_ambil" value="{{ $bahan->tgl_ambil }}" readonly>
                            </div>
                            <div class="form group">
                                <label for="wkt_ambil">Wkt Ambil:</label>
                                <input type="text" class="form-control" id="wkt_ambil" value="{{ $bahan->wkt_ambil }}" readonly>
                            </div>
                          </div>

                          <div class="form-group mt-4">
                            <label for="deskripsi">Deskripsi:</label>
                            <textarea class="form-control" readonly id="deskripsi" name="deskripsi" rows="3" >{{ $bahan->deskripsi }}</textarea>
                          </div>

                          <div class="form-group mt-3">
                            <img src="{{ asset('storage/images/' . $bahan->bahan->foto) }}" alt="Foto Barang" class="modal-foto">
                          </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>

            {{--  MODAL APPROVE  --}}
            <div class="modal fade" id="modalApprove{{ $bahan->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Approve</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('approveBahan', $bahan->id) }}">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                        <span>Apakah Anda Ingin Approve Permintaan {{ $bahan->user->nama_lengkap }} untuk mengambil {{ $bahan->bahan->nama_bahan }} ?</span>
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

        @if (count($ambil_bahan) === 0)
            <h5>Tidak ada data.</h5>
        @endif

        <div class="list-pagination">
            {{$ambil_bahan->appends(['rowsBahan' => $rowsBahan, 'search' => $search])->links('pagination::bootstrap-5')}}
        </div>

</section>
