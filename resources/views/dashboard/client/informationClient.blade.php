@extends('welcome')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> information sur le client </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('client.index') }}">Retour en arrière</a></li>
                <li class="breadcrumb-item active" aria-current="page">information sur le client</li>
            </ol>
        </nav>
    </div>

    @if ($info_client == null)
        <div class="d-flex justify-content-center align-items-center">
            <p class="card-description">Tous les informations consernant le client n'ont pas été
                renseigner.</p>
        </div>
    @else
        @foreach ($info_client as $info)
            @if ($info->denomination == '--------')
                <div class="d-flex justify-content-center align-items-center">
                    <h1>Information sur le particulier {{ $info->nom }} {{ $info->prenom }}</h1>
                </div>
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Information personnelle du client</h4>
                                <p> <b>Nom: </b> {{ $info->nom }}</p>
                                <p> <b>Prenom: </b> {{ $info->prenom }}</p>
                                <p> <b>Le type du client:</b> {{ $info->type_client }}</p>
                                <p> <b>Code AnyxTech du client:</b> {{ $info->code_anyx }}</p>
                                <p> <b>Code Befra du client:</b> {{ $info->code_befra }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Information sur l'emplacement</h4>
                                <p><b>Emplacement: </b> {{ $info->nom_emplacement }}</p>
                                <p><b>Localisation latitude de son emplacement: </b> {{ $info->local_latitude }}
                                </p>
                                <p><b>Localisation longitude de son emplacement: </b> {{ $info->local_longitude }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Information sur la Station</h4>
                                <p><b>Nom de la station: </b> {{ $info->nom_radio }} </p>
                                <p><b>Adresse de la station: </b> {{ $info->adresse_radio }} </p>
                                <p><b>Signal de la station: </b> {{ $info->signal }} </p>
                                <p><b>Passerelle de la station: </b> {{ $info->passerelle }} </p>
                                <p><b>Masque de la station: </b> {{ $info->masque }} </p>
                                <p><b>Status: </b> {{ $info->status }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Information sur l'ap </h4>
                                <p><b>Nom de l'ap: </b> {{ $info->nom_ap }} </p>
                                <p><b>SSID de l'ap: </b> {{ $info->ssid }} </p>
                                <p><b>Adresse Ip de l'ap : </b> {{ $info->adresse_ap }} </p>
                                <p><b>Adresse Mac: </b> {{ $info->adresse_mac }} </p>
                                <p><b>Azimuth: </b> {{ $info->azimuth }}° </p>
                                <p><b>Hauteur: </b> {{ $info->hauteur }}m </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Information sur le site</h4>
                                <p><b>Nom du site: </b> {{ $info->nom_site }} </p>
                                <p><b>Localisation de la latitude: </b> {{ $info->local_latitude_site }} </p>
                                <p><b>Localisation de la longitude: </b> {{ $info->local_longitude_site }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Information sur le routeur </h4>
                                <p><b>Nom du routeur: </b> {{ $info->nom_routeur }} </p>
                                <p><b>La marque : </b> {{ $info->marque }} </p>
                                <p><b>Le modèle: </b> {{ $info->modele }} </p>
                                <p><b>Adresse ip du routeur: </b> {{ $info->adresse_routeur }} </p>
                                <p><b>Passerelle: </b> {{ $info->passerelle_routeur }} </p>
                                <p><b>Masque: </b> {{ $info->adresse_routeur }} </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @if ($info->nom == '--------')
                    <div class="d-flex justify-content-center align-items-center">
                        <h1>Information sur l'entreprise {{ $info->denomination }}</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Information personnelle du client</h4>
                                    <p> <b>Denomination de l'entreprise: </b> {{ $info->denomination }}</p>
                                    <p> <b>Le type du client:</b> {{ $info->type_client }}</p>
                                    <p> <b>Code AnyxTech du client:</b> {{ $info->code_anyx }}</p>
                                    <p> <b>Code Befra du client:</b> {{ $info->code_befra }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Information sur l'emplacement</h4>
                                    <p><b>Emplacement: </b> {{ $info->nom_emplacement }}</p>
                                    <p><b>Localisation latitude de son emplacement: </b> {{ $info->local_latitude }}
                                    </p>
                                    <p><b>Localisation longitude de son emplacement: </b> {{ $info->local_longitude }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Information sur la Station</h4>
                                    <p><b>Nom de la station: </b> {{ $info->nom_radio }} </p>
                                    <p><b>Adresse de la station: </b> {{ $info->adresse_radio }} </p>
                                    <p><b>Signal de la station: </b> {{ $info->signal }} </p>
                                    <p><b>Passerelle de la station: </b> {{ $info->passerelle }} </p>
                                    <p><b>Masque de la station: </b> {{ $info->masque }} </p>
                                    <p><b>Status: </b> {{ $info->status }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Information sur l'ap </h4>
                                    <p><b>Nom de l'ap: </b> {{ $info->nom_ap }} </p>
                                    <p><b>SSID de l'ap: </b> {{ $info->ssid }} </p>
                                    <p><b>Adresse Ip de l'ap : </b> {{ $info->adresse_ap }} </p>
                                    <p><b>Adresse Mac: </b> {{ $info->adresse_mac }} </p>
                                    <p><b>Azimuth: </b> {{ $info->azimuth }}° </p>
                                    <p><b>Hauteur: </b> {{ $info->hauteur }}m </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Information sur le site</h4>
                                    <p><b>Nom du site: </b> {{ $info->nom_site }} </p>
                                    <p><b>Localisation de la latitude: </b> {{ $info->local_latitude_site }} </p>
                                    <p><b>Localisation de la longitude: </b> {{ $info->local_longitude_site }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Information sur le routeur </h4>
                                    <p><b>Nom du routeur: </b> {{ $info->nom_routeur }} </p>
                                    <p><b>La marque : </b> {{ $info->marque }} </p>
                                    <p><b>Le modèle: </b> {{ $info->modele }} </p>
                                    <p><b>Adresse ip du routeur: </b> {{ $info->adresse_routeur }} </p>
                                    <p><b>Passerelle: </b> {{ $info->passerelle_routeur }} </p>
                                    <p><b>Masque: </b> {{ $info->adresse_routeur }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    @endif


    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <!-- endinject -->
@endsection
