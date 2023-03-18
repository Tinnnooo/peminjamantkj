<section class="section_input" style="margin-top: 5rem;">
    <div class="section_input_header d-flex">
        <div class="header_left">
            <div class="header_icon">
                <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='{{ auth()->user()->hasRole('guru') ? route('pinjamRuanganGuru') : route('pinjamRuanganUser') }}'">
                    <i class='bx bx-arrow-back header_icon_icon'></i>
                    <span class="icon_text">Back</span>
                </button>
            </div>

            <div class="header_title">
                <h2 class="header_title_text">Create</h2>
            </div>
        </div>
    </div>

    <form action="{{ auth()->user()->hasRole('guru') ? route('kirimPinjamanRuanganGuru') : route('kirimPinjamanRuanganUser') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="section_input_content d-flex">
        <div class="container section_input_main1 shadow-lg bg-white rounded">
            <div class="input_title">
                <h5 class="input_title_text">Create Pinjam Ruangan</h5>
            </div>

            <div class="input_main mt-4">
                <div class="form-group datalist_barang">
                    <label for="nama_ruangan">Nama Ruangan :</label>
                    <input for="nama_ruangan" class="form-control mt-2" id="inputPinjaman" placeholder="-- Pilih Ruangan --" name="nama_ruangan" autocomplete="off" />
                    <datalist id="optionPinjaman">
                        @foreach($ruangan as $ruang)
                          <option value="{{ $ruang->nama_ruangan }}">{{ $ruang->nama_ruangan }}</option>
                        @endforeach
                      </datalist>
                </div>

                <div class="form-group datalist_guru">
                    <label for="nama_guru">Nama Guru Yang Mengajar :</label>
                    <input for="nama_guru" class="form-control mt-2" id="inputNama_guru" placeholder="-- Nama Guru --" name="nama_guru" autocomplete="off" />
                    <datalist id="optionNama_guru">
                        @foreach($guru as $gr)
                          <option value="{{ $gr->nama_lengkap }}">{{ $gr->nama_lengkap }}</option>
                        @endforeach
                      </datalist>
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

                <div class="form-group" style="margin-top: 2rem;">
                    <label for="tgl_mulai">Tanggal Mulai Pinjam :</label>
                    <input type="text" name="tgl_mulai" class="form-control mt-2 text-muted" id="tgl_mulai" value="{{ date('Y-m-d') }}" readonly>
                </div>

                <div class="form-group" style="margin-top: 2rem;">
                    <label for="wkt_mulai">Tanggal Mulai Pinjam :</label>
                    {{ date_default_timezone_set('Asia/Jakarta') }}
                    <input type="text" name="wkt_mulai" class="form-control mt-2 text-muted" id="wkt_mulai" value="{{ date('H:i:s') }}" readonly>
                </div>

                <div class="submit_button">
                    <button class="btn btn-success" type="submit">
                        <i class='bx bx-send'></i>
                        <span class="icon_text">Kirim</span>
                    </button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ auth()->user()->hasRole('guru') ? route('pinjamRuanganGuru') : route('pinjamRuanganUser') }}'">
                        <i class='bx bx-arrow-back'></i>
                        <span class="icon_text">Cancel</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
</section>
