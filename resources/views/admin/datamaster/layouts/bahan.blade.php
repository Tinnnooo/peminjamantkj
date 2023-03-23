<section class="list_barang_section" style='margin-top: 5rem;'>
    <div class="list_header_barang d-flex">
        <div class="list_barang_title">
            <h2 class="list_barang_title_text">List Bahan</h2>
        </div>

        <div class="form-add">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddBahan">
                <i class='bx bx-plus'></i>
                <span class="add_icon">Tambah Bahan</span>
            </button>
            <a href="{{ route('bahan.export') }}" class="btn btn-sm btn-info text-white text-center"><i class='bx bx-export' style="margin-right: 8px;"></i>Export Data</a>
        </div>
    </div>

    <div class="row justify-content-between">
        <form class="form-inline d-flex justify-content-between" method="GET" action="{{ route('bahan') }}">
        <div class="col-md-auto">
                <label class="my-1 mr-2" for="rowsBahan">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsBahan" onchange="this.form.submit()">
                    <option value="10" {{ $rowsBahan == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsBahan == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsBahan == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsBahan == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsBahan">entries</label>

                <input type="hidden" name="page" value="{{ $bahans->currentPage() }}">
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
            <th scope="col">Nama Bahan</th>
            <th scope="col">Stok</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="tbody-barang">
            @php
                $no = ($bahans->currentPage() - 1) * $bahans->perPage() + 1;
            @endphp
            @foreach ($bahans as $bahan)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td class="col-md-7">{{ $bahan->nama_bahan }}</td>
                <td class="col-md-1">{{ $bahan->stok }}</td>
                <td class="col-md-3">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $bahan->id }}">
                            <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $bahan->id }}">
                            <i style="padding: 3.5px;" class='bx bx-edit'></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $bahan->id }}">
                            <i style="padding: 3.5px;" class='bx bx-trash'></i>
                        </button>
                </td>
            </tr>

            {{--  MODAL VIEW  --}}
            <div class="modal fade" id="modal{{ $bahan->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Detail Bahan</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_barang">Nama Bahan:</label>
                            <input type="text" class="form-control" id="nama_barang" value="{{ $bahan->nama_bahan }}" readonly>
                          </div>
                          <div class="form-group mt-4">
                            <label for="stok">Stok:</label>
                            <input type="text" class="form-control" id="stok" value="{{ $bahan->stok }}" readonly>
                          </div>
                          <div class="form-group mt-4">
                            <label for="deskripsi">Deskripsi:</label>
                            <textarea class="form-control" readonly id="deskripsi" name="deskripsi" rows="5" >{{ $bahan->deskripsi }}</textarea>
                          </div>
                          <div class="form-group mt-3">
                            <img src="{{ asset('storage/images/' . $bahan->foto) }}" alt="Foto Barang" class="modal-foto">
                          </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>

            {{--  MODAL EDIT  --}}
            <div class="modal fade" id="modalEdit{{ $bahan->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Edit Bahan</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('edit_bahan', $bahan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_bahan">Nama Bahan</label>
                              <input type="text" class="form-control" name="nama_bahan" value="{{ $bahan->nama_bahan }}" required>
                            </div>

                            <div class="form-group">
                              <label for="stok">Stok</label>
                              <input type="number" class="form-control" name="stok" value="{{ $bahan->stok }}" required>
                            </div>

                            <div class="form-group">
                              <label for="deskripsi">Deskripsi</label>
                              <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" required>{{ $bahan->deskripsi }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control" name="foto" id="foto">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
                  </div>
                </div>
            </div>

            {{--  MODAL HAPUS  --}}
            <div class="modal fade" id="modalHapus{{ $bahan->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Hapus Bahan</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <span>Apakah Anda Ingin Menghapus Bahan {{ $bahan->nama_bahan }} ?</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('hapus_bahan' , $bahan->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus</button>
                        </form>
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>

            @endforeach

        </tbody>
            {{--  MODAL ADD  --}}
            <div class="modal fade" id="modalAddBahan" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">Tambah Bahan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('tambah_bahan') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                                <div class="form-group">
                                <label for="nama_bahan">Nama Bahan</label>
                                <input type="text" class="form-control" name="nama_bahan" placeholder="Nama Bahan.." required>
                                </div>

                                <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" name="stok" placeholder="Stok.." required>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskpripsi</label>
                                    <textarea name="deskripsi" rows="5" id="deskripsi" class="form-control" placeholder="Deskripsi..." required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" class="form-control" name="foto" id="foto" required>
                                </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
    </table>

        @if (count($bahans) === 0)
            <h5>Tidak ada data.</h5>
        @endif

        <div class="list-pagination">
            {{$bahans->appends(['rowsbahan' => $rowsBahan, 'search' => $search])->links('pagination::bootstrap-5')}}
        </div>

</section>
