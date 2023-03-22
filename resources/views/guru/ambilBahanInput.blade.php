<section class="section_input" style="margin-top: 5rem;">
    <div class="section_input_header d-flex">
        <div class="header_left">
            <div class="header_icon">
                <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='{{ route('guru.ambilBahan') }}'">
                    <i class='bx bx-arrow-back header_icon_icon'></i>
                    <span class="icon_text">Back</span>
                </button>
            </div>

            <div class="header_title">
                <h2 class="header_title_text">Create</h2>
            </div>
        </div>
    </div>

    <form action="{{ route('kirimAmbilBahan') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="section_input_content d-flex">
        <div class="container section_input_main1 shadow-lg bg-white rounded">
            <div class="input_title">
                <h5 class="input_title_text">Create Ambil Bahan</h5>
            </div>

            <div class="input_main mt-4">
                <div class="form-group datalist_barang">
                    <label for="nama_bahan">Nama Bahan :</label>
                    <input class="form-control mt-2" id="inputPinjaman" name="nama_bahan" placeholder="-- Pilih Bahan --" autocomplete="off">
                    <datalist id="optionPinjaman">
                        @foreach($bahan as $bhn)
                            <option value="{{ $bhn->nama_bahan }}" data-stok="{{ $bhn->stok }}" data-deskripsi="{{ $bhn->deskripsi }}">{{ $bhn->nama_bahan }}</option>
                        @endforeach
                    </datalist>
                </div>

                <div class="form-group datalist_guru">
                    <label for="stok">Stok :</label>
                    <input class="form-control mt-2 text-muted" id="stok" placeholder="Stok" name="stok" readonly>
                </div>

                <div class="form-group datalist_guru">
                    <label for="deskripsiBahan">Deskripsi :</label>
                    <textarea name="deskripsiBahan" id="deskripsiBahan" rows="3" class="form-control  mt-2 text-muted" placeholder="Deskripsi..." readonly></textarea>
                </div>
            </div>
        </div>

        <div class="container section_input_main2 shadow-lg bg-white rounded">
            <div class="input_title">
                <h5 class="input_title_text">Data Peminjam</h5>
            </div>

            <div class="input_main mt-4">
                <div class="form-group">
                    <label for="password">Password Pengirim :</label>
                    <input type="password" name="password" class="form-control mt-2" id="password" placeholder="Password Pengirim..">
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah Bahan Diambil :</label>
                    <input type="number" name="jumlah" class="form-control mt-2" id="jumlah" value="1">
                </div>

                <div class="form-group" style="margin-top: 2rem;">
                    <label for="tgl_ambil">Tanggal Ambil Bahan :</label>
                    <input type="text" name="tgl_ambil" class="form-control mt-2 text-muted" id="tgl_ambil" value="{{ date('Y-m-d') }}" readonly>
                </div>

                <div class="form-group" style="margin-top: 2rem;">
                    <label for="wkt_ambil">Tanggal Ambil Bahan :</label>
                    @php
                    date_default_timezone_set('Asia/Jakarta')
                    @endphp
                    <input type="text" name="wkt_ambil" class="form-control mt-2 text-muted" id="wkt_ambil" value="{{ date('H:i:s') }}" readonly>
                </div>

                <div class="form-group" style="margin-top: 2rem;">
                    <label for="untuk">Bahan akan digunakan untuk :</label>
                    <textarea name="untuk" id="untuk" rows="3" class="form-control mt-2" placeholder="Peruntukan..." ></textarea>
                </div>

                <div class="submit_button">
                    <button class="btn btn-success" type="submit">
                        <i class='bx bx-send'></i>
                        <span class="icon_text">Kirim</span>
                    </button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('guru.ambilBahan') }}'">
                        <i class='bx bx-arrow-back'></i>
                        <span class="icon_text">Cancel</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
</section>

