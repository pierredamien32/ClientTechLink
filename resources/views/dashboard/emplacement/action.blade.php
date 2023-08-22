{{-- Modal boite de modification  --}}
{{-- <div class="modal-dialog modal-dialog-centered"> --}}
<div class="modal fade" id="edit{{ $emplacement->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification d'un emplacement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('emplacement.update', $emplacement->id) }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Emplacement</label>
                        <select name="nom_emplacement"
                            class="form-control form-control-sm @error('nom_emplacement') is-invalid @enderror">
                            @if ($emplacement->nom_emplacement == 'Bureau')
                                <option>{{ $emplacement->nom_emplacement }}</option>
                                <option>Maison</option>
                            @else
                                <option>{{ $emplacement->nom_emplacement }}</option>
                                <option>Bureau</option>
                            @endif

                        </select>
                        {{-- @error('nom_emplacement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Localisation latitude</label>
                        <input type="number" id="floatInput" name="local_latitude" step="any"
                            class="form-control @error('local_latitude') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Localisation latitude" value="{{ $emplacement->local_latitude }}">
                        {{-- @error('local_latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Localisation longitude</label>
                        <input type="number" id="floatInput" name="local_longitude" step="any"
                            class="form-control @error('local_longitude') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Localisation longitude" value="{{ $emplacement->local_longitude }}">
                        {{-- @error('local_longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                    {{-- {{$emplacement->client->nom}} --}}
                    @if ($emplacement->client->nom == "--------")
                        <div class="form-group" >
                            <label for="exampleFormControlSelect3">Associé au client</label>
                            <select name="denomination"
                                class="form-control form-control-sm @error('denomination') is-invalid @enderror"
                                >
                                <option value="">{{$emplacement->client->denomination}}</option>
                                @foreach ($clients as $client)
                                    @if ($client->denomination == $emplacement->client->denomination || $client->denomination =='--------')
                                        
                                    @else
                                        <option>{{ $client->denomination }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{-- @error('denomination')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                        </div>
                    @else
                    {{-- {{$emplacement->client->nom}} --}}
                    {{-- je suis là --}}
                        <div class="form-group" >
                            <label for="exampleFormControlSelect3">Associé au client</label>
                            <select name="nom_client"
                                class="form-control form-control-sm @error('nom_client') is-invalid @enderror"
                               >
                                <option value="">{{$emplacement->client->nom}}</option>
                                @foreach ($clients as $client)
                                    @if ($client->nom == $emplacement->client->nom || $client->nom =='--------')
                                        
                                    @else
                                        <option>{{ $client->nom }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{-- @error('nom_client')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                        </div>
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
<div class="modal fade" id="delete{{ $emplacement->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Suppression d'un emplacement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes vous sûr de vouloir supprimer ce emplacement?
            </div>
            <form action="{{ route('emplacement.delete', $emplacement->id) }}" method="post">
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
