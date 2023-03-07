<section class="list_ruangan_section">
    <div class="list-title">
        <h2 class="list-title_text">List Pinjam Ruangan</h2>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-auto">
            <form class="form-inline" method="GET" action="{{ route('admin.index') }}">
                <label class="my-1 mr-2" for="rowsRuangan">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsRuangan" onchange="this.form.submit()">
                    <option value="10" {{ $rowsRuangan == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsRuangan == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsRuangan == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsRuangan == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsRuangan">entries</label>
            </form>
        </div>

    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Ruangan</th>
            <th scope="col">Peminjam</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="tbody-light">
            @if (count($pinjamruangan) !== 0)
                @foreach ($pinjamruangan as $ruangan)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $ruangan->ruangan->nama_ruangan }}</td>
                        <td>{{ $ruangan->user->nama_lengkap }}</td>
                        <td>{{ $ruangan->status }}</td>
                        <td>Mark</td>
                    </tr>   
                @endforeach
            @endif
        </tbody>
    </table>
    @if(count($pinjamruangan) === 0)
        <h5>Tidak ada data.</h5>
    @endif
    <div class="list-pagination">   
        {{$pinjamruangan->appends(['ruangan' => $pinjamruangan->currentPage()])->links('pagination::bootstrap-5')}}
    </div>
</section>