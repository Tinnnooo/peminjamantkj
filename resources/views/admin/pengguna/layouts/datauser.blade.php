<section class="list_user_section">
    <div class="list-title">
        <h2 class="list-title_text">List Users</h2>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-auto">
            <form class="form-inline" method="GET" action="{{ route('pengguna') }}">
                <label class="my-1 mr-2" for="rowsUser">Show</label>
                <select class="custom-select my-1 mr-sm-2" name="rowsUser" onchange="this.form.submit()">
                    <option value="10" {{ $rowsUser == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $rowsUser == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ $rowsUser == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $rowsUser == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label class="my-1 mr-2" for="rowsUser">entries</label>

                <input type="hidden" name="page" value="{{ $users->currentPage() }}">
            </form>
        </div>
    </div>

    <table class="table">
        <thead class="thead-user">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Lengkap</th>
            <th scope="col">Email</th>
            <th scope="col">No HP</th>
            <th scope="col">Username</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="tbody-user">
            @php
                $no = ($users->currentPage() - 1) * $users->perPage() + 1;
            @endphp
            @if (count($users) !== 0)
                @foreach ($users as $index => $user)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td class="col-md-5">{{ $user->nama_lengkap }}</td>
                        <td class="col-md-2">{{ $user->email }}</td>
                        <td class="col-md-1">{{ $user->nohp }}</td>
                        <td class="col-md-1">{{ $user->username }}</td>
                        <td class="col-md-1">{{ $user->roles->first()->name}}</td>
                        <td class="col-md-3">
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $user->id }}">
                                <i style="padding: 3.5px;" class="bx bx-trash"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalPassword{{ $user->id }}">
                                <i style="padding: 3.5px;" class='bx bx-lock'></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $user->id }}">
                                <i style="padding: 3.5px;" class='bx bxs-edit'></i>
                            </button>
                        </td>
                    </tr>

                    {{--  MODAL HAPUS  --}}
                    <div class="modal fade" id="modalHapus{{ $user->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="modalLabel">Hapus Pengguna</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <span>Apakah Anda Ingin Menghapus Pengguna {{ $user->nama_lengkap }} ?</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('hapus_pengguna' , $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus</button>
                                </form>
                              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                    </div>

                    {{--  MODAL PASSWORD  --}}
                    <div class="modal fade" id="modalPassword{{ $user->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="modalLabel">Ganti Password</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('ganti_password', $user->id) }}">
                                @csrf
                                @method('PUT')
                            <div class="modal-body">
                                    <div class="form-group">
                                      <label for="nama_lengkap">Nama Pengguna</label>
                                      <input type="text" class="form-control" name="nama_lengkap" value="{{ $user->nama_lengkap }}" readonly>
                                    </div>
                          
                                    <div class="form-group">
                                      <label for="password">New Password</label>
                                      <input type="password" class="form-control" id="password" name="password" required>
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

                    {{--  MODAL EDIT  --}}
                    <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="modalLabel">Edit Pengguna</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('edit_pengguna', $user->id) }}">
                                @csrf
                                @method('PUT')
                            <div class="modal-body">
                                    <div class="form-group">
                                      <label for="nama_lengkap">Nama Pengguna</label>
                                      <input type="text" class="form-control" name="nama_lengkap" value="{{ $user->nama_lengkap }}" required>
                                    </div>
                          
                                    <div class="form-group">
                                      <label for="email">Email</label>
                                      <input type="email" class="form-control" id="email" name="email" required value="{{ $user->email }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="nohp">No HP</label>
                                        <input type="number" class="form-control" id="nohp" name="nohp" required value="{{ $user->nohp }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="level">Level</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="level">
                                            <option value="admin" {{ $user->roles->first()->name == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="guru" {{ $user->roles->first()->name == 'guru' ? 'selected' : '' }}>Guru</option>
                                            <option value="user" {{ $user->roles->first()->name == 'user' ? 'selected' : '' }}>User</option>
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
                @endforeach
            @endif
        </tbody>
    </table>
        @if (count($users) === 0)
            <h5>Tidak ada data.</h5>
        @endif
        <div class="list-pagination">   
            {{$users->appends(['rowsUser' => $rowsUser])->links('pagination::bootstrap-5')}}   
        </div>
    
</section>