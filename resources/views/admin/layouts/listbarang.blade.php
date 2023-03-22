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

                <input type="hidden" name="rowsRuangan" value="{{ $rowsRuangan }}">
                <input type="hidden" name="barang" value="{{ $pinjambarang->currentPage() }}">
                <input type="hidden" name="ruangan" value="{{ $pinjamruangan->currentPage() }}">
            </form>
        </div>
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
            @php
                $no = ($pinjambarang->currentPage() - 1) * $pinjambarang->perPage() + 1;
            @endphp
            @if (count($pinjambarang) !== 0)
                @foreach ($pinjambarang as $index => $barang)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td style="width: 25%;">{{ $barang->barang->nama_barang }}</td>
                        <td style="width: 20%;">{{ $barang->user->nama_lengkap }}</td>
                        <td style="width: 24%;">
                            @if($barang->status == 'menunggu')
                            <span class="bg-danger text-white justify-content-center border-success p-1 d-flex">{{ $barang->status }}</span>
                            @elseif(Str::contains($barang->status, 'approve'))
                            <span class="bg-success text-white justify-content-center border-success d-flex">{{ $barang->status }}</span>
                            @endif
                        </td>
                        <td style="width: 90%;">
                            @if ($barang->status === 'menunggu')
                            <form action="{{ auth()->user()->hasRole('admin') ? route('admin.barangApprove', $barang->id) : route('guru.approveBarang', $barang->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary btn-sm d-flex">Approve</button>
                                </form>
                            @elseif (Str::contains($barang->status, 'approve'))
                                <span class="bg-success text-white justify-content-center border-success d-flex">{{ $barang->status }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
        @if (count($pinjambarang) === 0)
            <h5>Tidak ada data.</h5>
        @endif
        <div class="list-pagination">
            {{$pinjambarang->appends(['barang' => $pinjambarang->currentPage(), 'rowsBarang' => $rowsBarang, 'rowsRuangan' => $rowsRuangan, 'ruangan' => $pinjamruangan->currentPage()])->links('pagination::bootstrap-5')}}
        </div>

</section>
