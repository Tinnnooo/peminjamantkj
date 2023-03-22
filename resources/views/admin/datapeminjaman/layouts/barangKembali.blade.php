<section class="list_barang_section" style='margin-top: 5rem;'>
    <div class="list_header_barang d-flex">
        <div class="list_barang_title">
            <h2 class="list_barang_title_text">Data Barang Kembali</h2>
        </div>
    </div>

    <div class="row justify-content-between">
        <form class="form-inline d-flex justify-content-between" method="GET" action="{{ route('barangKembali') }}">
        <div class="col-md-auto">
                <label class="my-1 mr-2" for="rowsBarang">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsBarang" onchange="this.form.submit()">
                    <option value="10" {{ $rowsBarang == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsBarang == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsBarang == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsBarang == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsBarang">entries</label>

                <input type="hidden" name="page" value="{{ $barangKembali->currentPage() }}">
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
                $no = ($barangKembali->currentPage() - 1) * $barangKembali->perPage() + 1;
            @endphp
            @foreach ($barangKembali as $kembali)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td style="width: 9%;">{{ $kembali->user->nama_lengkap }}</td>
                <td style="width: 13%;">{{ $kembali->barang->nama_barang }}</td>
                <td style="width: 11%;">{{ $kembali->tgl_mulai }}</td>
                <td style="width: 10%;">{{ $kembali->wkt_mulai }}</td>
                <td style="width: 11%;">{{ $kembali->tgl_selesai }}</td>
                <td style="width: 10%;">{{ $kembali->wkt_selesai }}</td>
                <td style="width: 5%;">{{ $kembali->qty }}</td>
                <td style="width: 10%;">{{ $kembali->lokasi_barang }}</td>
                <td style="width: 11%;"><span class="bg-success text-white p-1 d-flex border-success justify-content-center">{{ $kembali->status }}</span></td>
                <td style="width: 90%;">
                  @if (Str::contains($kembali->status, 'selesai' ) || Str::contains($kembali->status, 'approve'))
                    <span class="bg-success text-white p-1 d-flex border-success justify-content-center">Selesai</span>
                  @endif
                </td>
            </tr>

            @endforeach

        </tbody>

    </table>

        @if (count($barangKembali) === 0)
            <h5>Tidak ada data.</h5>
        @endif

        <div class="list-pagination">
            {{$barangKembali->appends(['rowsBarang' => $rowsBarang])->links('pagination::bootstrap-5')}}
        </div>

</section>
