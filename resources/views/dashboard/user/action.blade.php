{{-- Modal boite de modification  --}}
{{-- <div class="modal-dialog modal-dialog-centered"> --}}
<div class="modal fade" id="edit{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification d'un utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Pseudo</label>
                        <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username"
                            name="pseudo" value="{{ $user->pseudo }}">
                        {{-- @error('pseudo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control " id="exampleInputEmail1"
                            placeholder="Email" value="{{ $user->email }}">
                        {{-- @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect3">Type d'utilisateur</label>
                        <select name="type_user" class="form-control form-control-sm " id="exampleFormControlSelect3">
                            @if ($user->type_user == 'Super Admin')
                                <option>{{ $user->type_user }}</option>
                                <option>Admin</option>
                                <option>Simple Utilisateur</option>
                            @endif
                            @if ($user->type_user == 'Admin')
                                <option>{{ $user->type_user }}</option>
                                <option>Super Admin</option>
                                <option>Simple Utilisateur</option>
                            @endif
                            @if ($user->type_user == 'Simple Utilisateur')
                                <option>{{ $user->type_user }}</option>
                                <option>Super Admin</option>
                                <option>Admin</option>
                            @endif
                        </select>
                        {{-- @error('type_user')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
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


{{-- Modal boite de confirmation  --}}
{{-- <div class="modal-dialog modal-dialog-centered"> --}}
<div class="modal fade" id="delete{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Suppression d'un utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes vous sûr de vouloir supprimer cet utilisateur?
            </div>
            <form action="{{ route('user.delete', $user->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Oui, je suis sûr!</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- </div> --}}
{{-- Fin du Modal boite de confirmation --}}
