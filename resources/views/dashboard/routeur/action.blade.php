{{-- Modal boite de modification  --}}
{{-- <div class="modal-dialog modal-dialog-centered"> --}}
<div class="modal fade" id="edit{{ $routeur->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification d'un routeur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('routeur.update', $routeur->id) }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nom du routeur</label>
                        <input type="text" class="form-control @error('nom_routeur') is-invalid @enderror"
                            id="exampleInputUsername1" placeholder="Nom du routeur" name="nom_routeur"
                            value="{{ $routeur->nom_routeur }}">
                        {{-- @error('nom_routeur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Adresse du routeur</label>
                        <input type="text" id="floatInput" name="adresse_routeur" step="any"
                            class="form-control @error('adresse_routeur') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Adresse du routeur" value="{{ $routeur->adresse_routeur }}">
                        {{-- @error('adresse_routeur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">La marque du routeur</label>
                        <input type="text" id="floatInput" name="marque"
                            class="form-control @error('marque') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="marque" value="{{ $routeur->marque }}">
                        {{-- @error('marque')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Le modèle du routeur</label>
                        <input type="text" id="floatInput" name="modele"
                            class="form-control @error('modele') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="modele" value="{{ $routeur->modele }}">
                        {{-- @error('modele')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Passerelle du routeur</label>
                        <input type="text" id="floatInput" name="passerelle" step="any"
                            class="form-control @error('passerelle') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Passerelle du routeur" value="{{ $routeur->passerelle }}">
                        {{-- @error('passerelle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Adresse masque du routeur</label>
                        <input type="text" id="floatInput" name="masque" step="any"
                            class="form-control @error('masque') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="masque du routeur" value="{{ $routeur->masque }}">
                        {{-- @error('masque')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                    @if ($routeur->emplacement->client->nom == '--------')
                        <div class="form-group" id="">
                            <label for="exampleFormControlSelect3">Associé au client</label>
                            <select name="denomination"
                                class="form-control form-control-sm @error('denomination') is-invalid @enderror"
                                id="">
                                <option>{{ $routeur->emplacement->client->denomination }}</option>

                                @foreach ($client_bureaux as $bureau)
                                    @if ($bureau->denomination == $routeur->emplacement->client->denomination)
                                    @else
                                        <option value="">{{ $bureau->denomination }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{-- @error('nom_client')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                        </div>
                    @else
                        {{-- @if ($routeur->emplacement->client->denomination == '--------') --}}
                        <div class="form-group " id="">
                            <label for="exampleFormControlSelect3">Associé au client</label>
                            <select name="nom_client"
                                class="form-control form-control-sm @error('denomination') is-invalid @enderror"
                                id="">
                                <option>{{ $routeur->emplacement->client->nom }}</option>

                                @foreach ($client_maisons as $maison)
                                    @if ($maison->nom == $routeur->emplacement->client->nom)
                                    @else
                                        <option value="">{{ $maison->nom }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{-- @error('nom_client')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                        </div>
                        {{-- @endif --}}
                    @endif


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregister</button>
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
<div class="modal fade" id="delete{{ $routeur->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Suppression d'un routeur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes vous sûr de vouloir supprimer ce routeur?
            </div>
            <form action="{{ route('routeur.delete', $routeur->id) }}" method="post">
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
