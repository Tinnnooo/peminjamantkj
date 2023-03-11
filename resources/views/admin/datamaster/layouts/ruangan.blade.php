<section class="list_barang_section" style='margin-top: 5rem;'>
    <div class="list_header d-flex">
        <div class="list-title">
            <h2 class="list-title_text">List Users</h2>
        </div>

        <div class="form-add">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddBarang">
                <i class='bx bx-plus'></i>
                <span class="add_icon">Tambah Barang</span>
            </button>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-auto">
            <form class="form-inline" method="GET" action="{{ route('ruangan') }}">
                <label class="my-1 mr-2" for="rowsBarang">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsRuangan" onchange="this.form.submit()">
                    <option value="10" {{ $rowsRuangan == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsRuangan == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsRuangan == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsRuangan == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsRuangan">entries</label>

                <input type="hidden" name="page" value="{{ $ruangan->currentPage() }}">
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
            <th scope="col">Nama Barang</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="tbody-barang">
            @php
                $no = ($ruangan->currentPage() - 1) * $ruangan->perPage() + 1;
            @endphp
            @foreach ($ruangan as $ruang)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td class="col-md-7">{{ $ruang->nama_ruangan }}</td>
                <td class="col-md-3">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $ruang->id }}">
                            <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $ruang->id }}">
                            <i style="padding: 3.5px;" class='bx bx-edit'></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $ruang->id }}">
                            <i style="padding: 3.5px;" class='bx bxs-file-jpg'></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $ruang->id }}">
                            <i style="padding: 3.5px;" class='bx bx-trash'></i>
                        </button>
                </td>
            </tr>

            {{--  MODAL VIEW  --}}
            <div class="modal fade" id="modal{{ $ruang->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Detail Barang</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang:</label>
                            <input type="text" class="form-control" id="nama_barang" value="" readonly>
                          </div>
                          <div class="form-group mt-4">
                            <label for="stok">Stok:</label>
                            <input type="text" class="form-control" id="stok" value="" readonly>
                          </div>
                          <div class="form-group mt-4">
                            <label for="status">Status:</label>
                            <input type="text" class="form-control" id="status" value="" readonly>
                          </div>
                          <div class="form-group mt-4">
                            <label for="deskripsi">Deskripsi:</label>
                            <textarea class="form-control" readonly id="deskripsi" name="deskripsi" rows="5" ></textarea>
                          </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>

            {{--  MODAL EDIT  --}}
            <div class="modal fade" id="modalEdit{{ $ruang->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Edit Pengguna</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_barang">Nama Barang</label>
                              <input type="text" class="form-control" name="nama_barang" value="" required>
                            </div>

                            <div class="form-group">
                              <label for="stok">Stok</label>
                              <input type="text" class="form-control" name="stok" value="" required>
                            </div>

                            <div class="form-group">
                              <label for="deskripsi">Deskripsi</label>
                              <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" required>{{ $ruang->deskripsi }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="status">
                                    <option value="free" selected >Free</option>
                                    <option value="rusak">Rusak</option>
                                </select>
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

            {{--  MODAL FOTO  --}}
            <div class="modal fade" id="modalFoto{{ $ruang->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Edit Pengguna</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_barang">Nama Barang</label>
                              <input type="text" class="form-control" name="nama_barang" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control" name="foto" id="foto" required>
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
            <div class="modal fade" id="modalHapus{{ $ruang->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Hapus Pengguna</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <span>Apakah Anda Ingin Menghapus Pengguna {{ $ruang->nama_ruangan }} ?</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="" method="POST">
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
            <div class="modal fade" id="modalAddBarang" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">Tambah Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('tambah_barang') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                                <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang.." required>
                                </div>

                                <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" name="stok" placeholder="Stok.." required>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="status">
                                        <option value="free" selected >Free</option>
                                        <option value="rusak">Rusak</option>
                                    </select>
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

        @if (count($ruangan) === 0)
            <h5>Tidak ada data.</h5>
        @endif

        <div class="list-pagination">
            {{$ruangan->appends(['rowsRuangan' => $rowsRuangan])->links('pagination::bootstrap-5')}}
        </div>

</section>
