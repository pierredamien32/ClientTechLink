{{-- Modal boite de modification  --}}
    {{-- <div class="modal-dialog modal-dialog-centered"> --}}
        <div class="modal fade" id="edit{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modification d'un utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Pseudo</label>
                                <input type="text" class="form-control @error('pseudo') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Username" name="pseudo"
                                    value="{{ old('pseudo') }}">
                                @error('pseudo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                                    placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">Type d'utilisateur</label>
                                <select name="type_user"
                                    class="form-control form-control-sm @error('type_user') is-invalid @enderror"
                                    id="exampleFormControlSelect3">
                                    <option>Super Admin</option>
                                    <option>Admin</option>
                                    <option>Simple user</option>
                                </select>
                                @error('type_user')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    {{-- </div> --}}
    {{-- Fin du Modal boite de modification --}}