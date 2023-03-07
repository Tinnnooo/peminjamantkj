<section class="list_barang_section">
    <div class="list-title">
        <h2 class="list-title_text">List Pinjam Barang</h2>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-auto">
            <form class="form-inline" method="GET" action="{{ route('admin.index') }}">
                <label class="my-1 mr-2" for="rowsBarang">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsBarang" onchange="this.form.submit()">
                    <option value="10" {{ $rowsBarang == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsBarang == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsBarang == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsBarang == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsBarang">entries</label>
            </form>
        </div>

    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Peminjam</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="tbody-light">
            @if (count($pinjambarang) !== 0)
                @foreach ($pinjambarang as $barang)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $barang->barang->nama_barang }}</td>
                        <td>{{ $barang->user->nama_lengkap }}</td>
                        <td>{{ $barang->status }}</td>
                        <td>Mark</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
        @if (count($pinjambarang) === 0)
            <h5>Tidak ada data.</h5>
        @endif
        <div class="list-pagination">   
            {{$pinjambarang->appends(['barang' => $pinjambarang->currentPage()])->links('pagination::bootstrap-5')}}   
        </div>
</section>