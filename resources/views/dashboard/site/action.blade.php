{{-- Modal boite de modification  --}}
{{-- <div class="modal-dialog modal-dialog-centered"> --}}
<div class="modal fade" id="edit{{ $site->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification d'un site</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('site.update', $site->id) }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nom du site</label>
                        <input type="text" class="form-control @error('nom_site') is-invalid @enderror"
                            id="exampleInputUsername1" placeholder="Nom du site" name="nom_site"
                            value="{{ $site->nom_site }}">
                        {{-- @error('nom_site')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Localisation latitude</label>
                        <input type="number" id="floatInput" name="local_latitude" step="any"
                            class="form-control @error('local_latitude') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Localisation latitude" value="{{ $site->local_latitude }}">
                        {{-- @error('local_latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Localisation longitude</label>
                        <input type="number" id="floatInput" name="local_longitude" step="any"
                            class="form-control @error('local_longitude') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Localisation longitude" value="{{ $site->local_longitude }}">
                        {{-- @error('local_longitude')
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
<div class="modal fade" id="delete{{ $site->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Suppression d'un site</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes vous sûr de vouloir supprimer ce site?
            </div>
            <form action="{{ route('site.delete', $site->id) }}" method="post">
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
