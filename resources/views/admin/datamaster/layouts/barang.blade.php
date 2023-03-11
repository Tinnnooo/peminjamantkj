<section class="list_barang_section" style='margin-top: 5rem;'>
    <div class="list-title">
        <h2 class="list-title_text">Data Barang</h2>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-auto">
            <form class="form-inline" method="GET" action="{{ route('datamaster', ['any' => 'barang'] ) }}">
                <label class="my-1 mr-2" for="rowsBarang">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsBarang" onchange="this.form.submit()">
                    <option value="10" {{ $rowsBarang == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsBarang == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsBarang == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsBarang == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsBarang">entries</label>

                <input type="hidden" name="page" value="{{ $barang->currentPage() }}">
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
            <th scope="col">Stok</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="tbody-barang">
            @php
                $no = ($barang->currentPage() - 1) * $barang->perPage() + 1;
            @endphp
            @foreach ($barang as $brng)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td class="col-md-7">{{ $brng->nama_barang }}</td>
                <td class="col-md-1">{{ $brng->stok }}</td>
                <td class="col-md-1">{{ $brng->status }}</td>
                <td class="col-md-3">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $brng->id }}">
                            <i style="padding: 3.5px;" class="fa-solid fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $brng->id }}">
                            <i style="padding: 3.5px;" class='bx bx-edit'></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalGanti{{ $brng->id }}">
                            <i style="padding: 3.5px;" class='bx bxs-edit'></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $brng->id }}">
                            <i style="padding: 3.5px;" class='bx bx-trash'></i>
                        </button>
                </td>
            </tr>
            <div class="modal fade" id="modal{{ $brng->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel">Detail Barang</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang:</label>
                            <input type="text" class="form-control" id="nama_barang" value="{{ $brng->nama_barang }}" readonly>
                          </div>
                          <div class="form-group mt-4">
                            <label for="stok">Stok:</label>
                            <input type="text" class="form-control" id="stok" value="{{ $brng->stok }}" readonly>
                          </div>
                          <div class="form-group mt-4">
                            <label for="status">Status:</label>
                            <input type="text" class="form-control" id="status" value="{{ $brng->status }}" readonly>
                          </div>
                          <div class="form-group mt-4">
                            <label for="deskripsi">Deskripsi:</label>
                            <textarea class="form-control" readonly id="deskripsi" name="deskripsi" rows="5" >{{ $brng->deskripsi }}</textarea>
                          </div>
                          <div class="form-group mt-4">
                            {{ $brng->foto }}
                          </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        </tbody>
    </table>
        @if (count($barang) === 0)
            <h5>Tidak ada data.</h5>
        @endif

        <div class="list-pagination">   
            {{$barang->appends(['rowsBarang' => $rowsBarang])->links('pagination::bootstrap-5')}}
        </div>
    
</section>