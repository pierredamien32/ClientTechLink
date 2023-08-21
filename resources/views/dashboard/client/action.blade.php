{{-- Modal boite de modification  --}}
{{-- <div class="modal-dialog modal-dialog-centered"> --}}
<div class="modal fade" id="edit{{ $client->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification d'un client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('client.update', $client->id) }}"  method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nom du client</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror"
                            id="exampleInputUsername1" placeholder="Nom du client " name="nom"
                            value="{{ $client->nom }}">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Prénom du client</label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                            id="exampleInputUsername1" placeholder="Prénom du client si nécessaire" name="prenom"
                            value="{{ $client->prenom }}">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Denomination de l'entreprise</label>
                        <input type="text" class="form-control @error('denomination') is-invalid @enderror"
                            id="exampleInputUsername1" placeholder="Dénomination de l'entreprise si nécessaire"
                            name="denomination" value="{{ $client->denomination }}">

                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect3">Type de client</label>
                        <select name="type_client"
                            class="form-control form-control-sm @error('type_client') is-invalid @enderror"
                            id="exampleFormControlSelect3">
                            @if ($client->type_client == "Particulier")
                                <option>{{ $client->type_client }}</option>
                                <option>Entreprise</option>
                            @else
                                <option>{{ $client->type_client }}</option>
                                <option>Particulier</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Le code AnyxTech</label>
                        <input type="text" class="form-control @error('code_anyx') is-invalid @enderror"
                            id="exampleInputUsername1" placeholder="Code AnyxTech" name="code_anyx"
                            value="{{ $client->code_anyx }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Le code Befra</label>
                        <input type="text" class="form-control @error('code_befra') is-invalid @enderror"
                            id="exampleInputUsername1" placeholder="Code Befra" name="code_befra"
                            value="{{ $client->code_befra }}">

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
<div class="modal fade" id="delete{{ $client->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Suppression d'un client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes vous sûr de vouloir supprimer ce client?
            </div>
            <form action="{{ route('client.delete', $client->id) }}" method="post">
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
