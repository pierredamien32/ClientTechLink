{{-- Modal boite de modification  --}}
{{-- <div class="modal-dialog modal-dialog-centered"> --}}
<div class="modal fade" id="edit{{ $radio->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modification d'un radio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('radio.update', $radio->id) }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group" id="">
                        <label for="exampleFormControlSelect3">Associé à l'ap</label>
                        <select id="" name="ap_nom" class="form-control">
                            <option>{{ $radio->ap->nom_ap }}</option>
                            @foreach ($aps as $ap)
                                @if ($ap->nom_ap == $radio->ap->nom_ap)
                                @else
                                    <option>{{ $ap->nom_ap }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @if ($radio->emplacement->client->nom == '--------')
                        <div class="form-group" id="">
                            <label for="exampleFormControlSelect3">Associé au client</label>
                            <select name="denomination"
                                class="form-control form-control-sm @error('denomination') is-invalid @enderror"
                                id="">
                                <option>{{ $radio->emplacement->client->denomination }}</option>

                                @foreach ($client_bureaux as $bureau)
                                    @if ($bureau->denomination == $radio->emplacement->client->denomination)
                                    @else
                                        <option>{{ $bureau->denomination }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{-- @error('nom_client')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                        </div>
                    @else
                        {{-- @if ($radio->emplacement->client->denomination == '--------') --}}
                        <div class="form-group " id="">
                            <label for="exampleFormControlSelect3">Associé au client</label>
                            <select name="nom_client"
                                class="form-control form-control-sm @error('denomination') is-invalid @enderror"
                                id="">
                                <option>{{ $radio->emplacement->client->nom }}</option>

                                @foreach ($client_maisons as $maison)
                                    @if ($maison->nom == $radio->emplacement->client->nom)
                                    @else
                                        <option>{{ $maison->nom }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{-- @error('nom_client')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                        </div>
                        {{-- @endif --}}
                    @endif
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nom de la radio</label>
                        <input type="text" class="form-control @error('nom_radio') is-invalid @enderror"
                            id="exampleInputUsername1" placeholder="Nom de la radio" name="nom_radio"
                            value="{{ $radio->nom_radio }}">
                        {{-- @error('nom_radio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Adresse de la radio</label>
                        <input type="text" id="floatInput" name="adresse_radio" step="any"
                            class="form-control @error('adresse_radio') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Adresse de la radio" value="{{ $radio->adresse_radio }}">
                        {{-- @error('adresse_radio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Passerelle de la radio</label>
                        <input type="text" id="floatInput" name="passerelle" step="any"
                            class="form-control @error('passerelle') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Passerelle de la radio" value="{{ $radio->passerelle }}">
                        {{-- @error('passerelle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Adresse masque de la radio</label>
                        <input type="text" id="floatInput" name="masque" step="any"
                            class="form-control @error('masque') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="masque de la radio" value="{{ $radio->masque }}">
                        {{-- @error('masque')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Signal de la radio</label>
                        <input type="number" id="floatInput" name="signal" step="any"
                            class="form-control @error('signal') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Signal" value="{{ $radio->signal }}">
                        {{-- @error('signal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect3">Status</label>
                        <select name="status"
                            class="form-control form-control-sm @error('status') is-invalid @enderror">
                            <option value="">{{$radio->status}}</option>
                            @if ($radio->status == 'Actif')
                                <option>Inactif</option>
                            @else
                                <option>Actif</option>
                            @endif
                             {{-- Entreprise --}}
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
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
<div class="modal fade" id="delete{{ $radio->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Suppression d'un radio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes vous sûr de vouloir supprimer cette radio?
            </div>
            <form action="{{ route('radio.delete', $radio->id) }}" method="post">
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
