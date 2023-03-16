<section class="list_barang_section" style='margin-top: 5rem;'>
    <div class="list_header d-flex">
        <div class="list-title">
            <h2 class="list-title_text">Data Ruangan Kembali</h2>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-auto">
            <form class="form-inline" method="GET" action="{{ route('ruanganKembali') }}">
                <label class="my-1 mr-2" for="rowsRuangan">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsRuangan" onchange="this.form.submit()">
                    <option value="10" {{ $rowsRuangan == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsRuangan == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsRuangan == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsRuangan == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsRuangan">entries</label>

                <input type="hidden" name="page" value="{{ $ruanganKembali->currentPage() }}">
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
                $no = ($ruanganKembali->currentPage() - 1) * $ruanganKembali->perPage() + 1;
            @endphp
            @foreach ($ruanganKembali as $ruangan)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td style="width: 9%;">{{ $ruangan->user->nama_lengkap }}</td>
                <td style="width: 13%;">{{ $ruangan->ruangan->nama_ruangan }}</td>
                <td style="width: 12%;">{{ $ruangan->tgl_mulai }}</td>
                <td style="width: 12%;">{{ $ruangan->wkt_mulai }}</td>
                <td style="width: 12%;">{{ $ruangan->tgl_selesai }}</td>
                <td style="width: 12%;">{{ $ruangan->wkt_selesai }}</td>
                <td style="width: 15%;">
                    @if($ruangan->status == 'menunggu')
                    <span class="bg-danger text-white p-1 rounded-5 border-success">{{ $ruangan->status }}</span>
                    @elseif($ruangan->status !== 'menunggu')
                    <span class="bg-success text-white p-1 rounded-5 border-success">{{ $ruangan->status }}</span>
                    @endif
                </td>
                <td style="width: 90%;">
                    @if (Str::contains($ruangan->status, 'selesai'))
                        <span class="bg-success text-white p-1 rounded-5 border-success">{{ $ruangan->status }}</span>
                    @endif
                </td>
            </tr>

            @endforeach

        </tbody>

    </table>

        @if (count($ruanganKembali) === 0)
            <h5>Tidak ada data.</h5>
        @endif

        <div class="list-pagination">
            {{$ruanganKembali->appends(['rowsRuangan' => $rowsRuangan])->links('pagination::bootstrap-5')}}
        </div>

</section>
