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

         @media screen and (min-width:426px) and (max-width: 500px){
            .btn-add{
                padding: 0 10px;
                width: 100%;
            }
        }

        @media screen and (max-width:425px){
            .btn-add{
                padding: 0 10px;
                width: 100%;
            }
        }
    </style>
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-box"></i>
                </span> Clients
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Client Total <i
                                class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ count($clients) }}</h2>
                        @if ($date)
                            <h6 class="card-text">Mise à jour depuis le {{ $date->updated_at->format('d/m/y') }} à {{ $date->updated_at->format('H:i:s') }}</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Nombre de particulier<i
                                class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $clientParticulier }}</h2>
                        @if ($date_maj_particulier)
                            <h6 class="card-text">Mise à jour depuis le {{ $date_maj_particulier->format('d/m/y') }} à {{ $date_maj_particulier->format('H:i:s') }}</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Nombre d'entreprise<i
                                class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $clientEntreprise }}</h2>
                        @if ($date_maj_entreprise)
                            <h6 class="card-text">Mise à jour depuis le {{ $date_maj_entreprise->format('d/m/y') }} à {{ $date_maj_entreprise->format('H:i:s') }}</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-bottom: 20px; display: flex; justify-content:center; align-items:center;">
            <form action="{{ route('client.index') }}" method="get" accept-charset="UTF-8" role="search">
                <div class="input-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Rechercher un client..." name="search"
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
                            <h4 class="card-title">Liste des Clients</h4>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-ajout"
                                class="btn btn-add btn-gradient-primary" id="displayForm">+ Ajouter un
                                client</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Nom </th>
                                        <th> Prenom </th>
                                        <th> Dénomination social</th>
                                        <th> Type du client </th>
                                        <th> Code AnyxTech </th>
                                        <th> Code Befra </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                @foreach ($clients as $client)
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $client->nom }}
                                            </td>
                                            <td> {{ $client->prenom }} </td>
                                            <td>
                                                {{ $client->denomination }}
                                            </td>
                                            <td> {{ $client->type_client }} </td>
                                            <td> {{ $client->code_anyx }} </td>
                                            <td> {{ $client->code_befra }} </td>
                                            <td>
                                                <a href="{{ route('client.info_client', $client->id) }}">
                                                    <span class="page-title-icon bg-gradient-success text-white me-2 tail">
                                                        <i class="fa-solid fa-list"></i>
                                                    </span>
                                                </a>
                                                <a href="#edit{{ $client->id }}"
                                                    class="page-title-icon bg-primary text-white me-2 tail" type="button"
                                                    data-bs-toggle="modal" style="border: none;">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="#delete{{ $client->id }}" type="button" data-bs-toggle="modal"
                                                    class="page-title-icon bg-danger text-white me-2 tail"
                                                    style="border: none;">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                                @include('dashboard.client.action')
                                            </td>
                                        </tr>
                                    </tbody>
                                 @endforeach
                            </table>
                        </div>
                        <div style="margin-top: 20px;"></div>
                        @if (count($clients) > 0)
                            {{ $clients->links() }}
                        @else
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="card-description">Pas de client.</p>
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
                        <h5 class="modal-title" id="staticBackdropLabel">Ajout d'un client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="d-flex justify-content-center align-items-center" style="gap: 20px;">
                        <button type="button" id="forParticulier"
                            class="btn btn-outline-secondary btn-fw active">Particulier</button>
                        <button type="button" id="forEntreprise"
                            class="btn btn-outline-secondary btn-fw active">Entreprise</button>
                    </div>
                    <div>

                    </div>
                    <div class="modal-body" id="formContainer">
                        <form action="{{ route('client.FormParticulier') }}" id="particulierForm" method="POST"
                            class="forms-sample toggleForm">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Nom du client</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Nom du client si nécessaire" name="nom"
                                    value="{{ old('nom') }}">
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Prénom du client</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Prénom du client si nécessaire"
                                    name="prenom" value="{{ old('prenom') }}">
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Le code AnyxTech</label>
                                <input type="text" class="form-control @error('code_anyx') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Code AnyxTech" name="code_anyx"
                                    value="{{ old('code_anyx') }}">
                                @error('code_anyx')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Le code Befra</label>
                                <input type="text" class="form-control @error('code_befra') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Code Befra" name="code_befra"
                                    value="{{ old('code_befra') }}">
                                @error('code_befra')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregister</button>
                            </div>
                        </form>
                        <form action="{{ route('client.FormEntreprise') }}" id="entrepriseForm" method="POST"
                            class="forms-sample ">
                            @csrf
                            {{-- <div class="form-group">
                                <label for="exampleInputUsername1">Nom du client</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Nom du client si nécessaire" name="nom"
                                    value="{{ old('nom') }}">
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Prénom du client</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Prénom du client si nécessaire"
                                    name="prenom" value="{{ old('prenom') }}">
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label for="exampleInputUsername1">Denomination de l'entreprise</label>
                                <input type="text" class="form-control @error('denomination') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Dénomination de l'entreprise si nécessaire"
                                    name="denomination" value="{{ old('denomination') }}">
                                @error('denomination')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleFormControlSelect3">Type de client</label>
                                <select name="type_client"
                                    class="form-control form-control-sm @error('type_client') is-invalid @enderror"
                                    id="exampleFormControlSelect3">
                                    <option>Entreprise</option>
                                    <option>Particulier</option>
                                </select>
                                @error('type_client')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label for="exampleInputUsername1">Le code AnyxTech</label>
                                <input type="text" class="form-control @error('code_anyx') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Code AnyxTech" name="code_anyx"
                                    value="{{ old('code_anyx') }}">
                                @error('code_anyx')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Le code Befra</label>
                                <input type="text" class="form-control @error('code_befra') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Code Befra" name="code_befra"
                                    value="{{ old('code_befra') }}">
                                @error('code_befra')
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

    <!-- Ajoutez ce script dans votre page HTML -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const displayFormButton = document.getElementById("displayForm");
            const particulierForm = document.getElementById("particulierForm");
            const entrepriseForm = document.getElementById("entrepriseForm");
            const forParticulierButton = document.getElementById("forParticulier");
            const forEntrepriseButton = document.getElementById("forEntreprise");

            // Au chargement de la page, afficher le formulaire de particulier par défaut
            particulierForm.style.display = "block";
            entrepriseForm.style.display = "none";

            // Lorsque le bouton "Particulier" est cliqué, afficher le formulaire de particulier
            forParticulierButton.addEventListener("click", function() {
                particulierForm.style.display = "block";
                entrepriseForm.style.display = "none";
                entrepriseForm.classList.remove('active');
                particulierForm.classList.add('active');
            });

            // Lorsque le bouton "Entreprise" est cliqué, afficher le formulaire d'entreprise
            forEntrepriseButton.addEventListener("click", function() {
                particulierForm.style.display = "none";
                entrepriseForm.style.display = "block";
                particulierForm.classList.remove('active');
                entrepriseForm.classList.add('active');
            });

            // Lorsque le bouton "+ Ajouter un client" est cliqué, afficher la boîte de dialogue
            displayFormButton.addEventListener("click", function() {
                const modal = new bootstrap.Modal(document.getElementById("modal-ajout"));
                modal.show();
            });
        });
    </script>
@endsection
