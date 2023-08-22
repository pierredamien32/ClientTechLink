@extends('welcome')

@section('content')
    <style>
        .tail {
            padding: 8px 8px;
        }

        .input-box {
            position: relative;
            height: 76px;
            max-width: 900px;
            width: 100%;
            background: #fff;
            margin: 0 20px;
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .input-box i,
        .input-box .button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .input-box i {
            left: 20px;
            font-size: 30px;
            color: #707070;
        }

        .input-box input {
            height: 100%;
            width: 100%;
            outline: none;
            font-size: 18px;
            font-weight: 400;
            border: none;
            padding: 0 155px 0 65px;
            background-color: transparent;
        }

        .input-box .button {
            right: 20px;
            font-size: 16px;
            font-weight: 400;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            background-color: #4070f4;
            cursor: pointer;
        }

        .input-box .button:active {
            transform: translateY(-50%) scale(0.98);
        }

        .transition-visible {
            opacity: 1;
            max-height: 100px;
            /* Vous pouvez ajuster la valeur */
            overflow: visible;
            transition: opacity 0.3s, max-height 0.3s;
        }

        .transition-hidden {
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: opacity 0.3s, max-height 0.3s;
        }


        /* Responsive */
        @media screen and (max-width: 500px) {
            .input-box {
                height: 66px;
                margin: 0 8px;
            }

            .input-box i {
                left: 12px;
                font-size: 25px;
            }

            .input-box input {
                padding: 0 112px 0 50px;
            }

            .input-box .button {
                right: 12px;
                font-size: 14px;
                padding: 8px 18px;
            }
        }
    </style>
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-signal menu-icon"></i>
                </span> Radios
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        {{-- <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Utilisateur Total <i
                                class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ count($utilisateurs) }}</h2>
                        @if ($date)
                            <h6 class="card-text">Mise à jour depuis le {{ $date->updated_at->format('d/m/y') }}</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3"><i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">-------</h2>
                        <h6 class="card-text"></h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3"><i class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">-------</h2>
                        <h6 class="card-text"></h6>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row" style="margin-bottom: 20px; display: flex; justify-content:center; align-items:center;">
            <form action="{{ route('radio.index') }}" method="get" accept-charset="UTF-8" role="search">
                <div class="input-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Rechercher une radio..." name="search"
                        value="{{ request()->search }}" />
                    <button class="button">Rechercher</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                            <h4 class="card-title">Liste des Radios</h4>

                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-ajout"
                                class="btn btn-block btn-lg btn-gradient-primary">+ Ajouter une radio</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Nom de la radio </th>
                                        <th> Adresse de la radio </th>
                                        <th> Signal </th>
                                        <th> Passerelle </th>
                                        <th> Masque </th>
                                        <th> Associé à l'Ap </th>
                                        <th> Associé au client </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                @foreach ($radios as $radio)
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $radio->nom_radio }}
                                            </td>
                                            <td> {{ $radio->adresse_radio }} </td>
                                            <td>
                                                {{ $radio->signal }}
                                            </td>
                                            <td>
                                                {{ $radio->passerelle }}
                                            </td>
                                            <td>
                                                {{ $radio->masque }}
                                            </td>

                                            <td>
                                                {{ $radio->ap->nom_ap }}
                                            </td>

                                            @if ($radio->emplacement->client->nom === '--------')
                                            @else
                                                <td>
                                                    {{ $radio->emplacement->client->nom }}
                                                </td>
                                            @endif

                                            @if ($radio->emplacement->client->denomination === '--------')
                                            @else
                                                <td>
                                                    {{ $radio->emplacement->client->denomination }}
                                                </td>
                                            @endif

                                            <td>
                                                <a href="#edit{{ $radio->id }}"
                                                    class="page-title-icon bg-primary text-white me-2 tail" type="button"
                                                    data-bs-toggle="modal" style="border: none;">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="#delete{{ $radio->id }}" type="button" data-bs-toggle="modal"
                                                    class="page-title-icon bg-danger text-white me-2 tail"
                                                    style="border: none;">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                                @include('dashboard.radio.action')
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        <div style="margin-top: 20px;"></div>
                        @if (count($radios) > 0)
                            {{ $radios->links() }}
                        @else
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="card-description">Pas de radio.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- End custom js for this page -->

    {{-- Modal boite d'Ajout --}}
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal fade" id="modal-ajout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ajout d'un emplacement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('radio.store') }}" method="POST" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Nom de la radio</label>
                                <input type="text" class="form-control @error('nom_radio') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Nom de la radio" name="nom_radio"
                                    value="{{ old('nom_radio') }}">
                                @error('nom_radio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Adresse de la radio</label>
                                <input type="text" id="floatInput" name="adresse_radio" step="any"
                                    class="form-control @error('adresse_radio') is-invalid @enderror"
                                    id="exampleInputEmail1" placeholder="Adresse de la radio"
                                    value="{{ old('adresse_radio') }}">
                                @error('adresse_radio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Signal de la radio</label>
                                <input type="number" id="floatInput" name="signal" step="any"
                                    class="form-control @error('signal') is-invalid @enderror" id="exampleInputEmail1"
                                    placeholder="Signal" value="{{ old('signal') }}">
                                @error('signal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Passerelle de la radio</label>
                                <input type="text" id="floatInput" name="passerelle" step="any"
                                    class="form-control @error('passerelle') is-invalid @enderror" id="exampleInputEmail1"
                                    placeholder="Passerelle de la radio" value="{{ old('passerelle') }}">
                                @error('passerelle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Adresse masque de la radio</label>
                                <input type="text" id="floatInput" name="masque" step="any"
                                    class="form-control @error('masque') is-invalid @enderror" id="exampleInputEmail1"
                                    placeholder="masque de la radio" value="{{ old('masque') }}">
                                @error('masque')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">Associé à l'ap</label>
                                <select name="nom_ap"
                                    class="form-control form-control-sm @error('nom_ap') is-invalid @enderror">
                                    @foreach ($aps as $ap)
                                        <option>{{ $ap->nom_ap }}</option>
                                    @endforeach
                                </select>
                                @error('nom_ap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">Type du client</label>
                                <select class="form-control form-control-sm" id="exampleFormControlSelect3"
                                    onchange="handleClientTypeChange()">
                                    <option>Bureau</option> {{-- Particulier --}}
                                    <option>Maison</option> {{-- Entreprise --}}
                                </select>
                            </div>
                            <div class="form-group transition-hidden" id="entrepriseSection">
                                <label for="exampleFormControlSelect3">Associé au client</label>
                                <select name="denomination"
                                    class="form-control form-control-sm @error('denomination') is-invalid @enderror"
                                    id="exampleFormControlSelect3">
                                    <option></option>
                                    @php
                                        $addedValues = [];
                                    @endphp
                                    @foreach ($client_bureaux as $bureau)
                                        @php
                                            $valueToAdd = $bureau->nom == '--------' ? $bureau->denomination : $bureau->nom;
                                        @endphp

                                        @if (!in_array($valueToAdd, $addedValues))
                                            <option>{{ $valueToAdd }}</option>
                                            <?php $addedValues[] = $valueToAdd; ?>
                                        @endif
                                    @endforeach
                                </select>
                                @error('denomination')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group transition-hidden" id="particulierSection">
                                <label for="exampleFormControlSelect3">Associé au client</label>
                                <select name="nom_client"
                                    class="form-control form-control-sm @error('nom_client') is-invalid @enderror"
                                    id="exampleFormControlSelect3">
                                    <option></option>
                                    @php
                                        $options = []; // Tableau pour stocker les options déjà ajoutées
                                    @endphp

                                    @foreach ($client_maisons as $maison)
                                        @php
                                            $optionValue = $maison->denomination == '--------' ? $maison->nom : $maison->denomination;
                                        @endphp

                                        @if (!in_array($optionValue, $options))
                                            <option>{{ $optionValue }}</option>
                                            @php
                                                $options[] = $optionValue; // Ajouter l'option au tableau des options
                                            @endphp
                                        @endif
                                    @endforeach
                                </select>
                                @error('nom_client')
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
    </div>
    {{-- Fin du Modal boite d'Ajout --}}

    <script>
        function handleClientTypeChange() {
            var selectedOption = document.getElementById("exampleFormControlSelect3").value;
            var particulierSection = document.getElementById("particulierSection");
            var entrepriseSection = document.getElementById("entrepriseSection");

            if (selectedOption === "Maison") {
                particulierSection.classList.remove("transition-hidden");
                particulierSection.classList.add("transition-visible");
                entrepriseSection.classList.remove("transition-visible");
                entrepriseSection.classList.add("transition-hidden");
            } else if (selectedOption === "Bureau") {
                entrepriseSection.classList.remove("transition-hidden");
                entrepriseSection.classList.add("transition-visible");
                particulierSection.classList.remove("transition-visible");
                particulierSection.classList.add("transition-hidden");
            }
        }

        // Appel initial pour s'assurer que la bonne section est affichée selon la valeur par défaut
        handleClientTypeChange();
    </script>
@endsection
