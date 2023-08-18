@extends('welcome')

@section('content')
    <style>
        .tail {
            padding: 8px 8px;
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
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Client Total  <i
                                class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">100</h2>
                        <h6 class="card-text">Mise à jour depuis le 11/08/2023</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Nombre de particulier<i
                                class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">50</h2>
                        <h6 class="card-text">Mise à jour depuis le 11/08/2023</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Nombre d'entreprise<i
                                class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">50</h2>
                        <h6 class="card-text">Mise à jour depuis le 11/08/2023</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                            <h4 class="card-title">Liste des Clients</h4>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-ajout"
                                class="btn btn-block btn-lg btn-gradient-primary">+ Ajouter un client</button>
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
                                <tbody>
                                    <tr>
                                        <td>
                                            01666556
                                        </td>
                                        <td> Deo </td>
                                        <td>
                                            John
                                        </td>
                                        <td> Licence 1 </td>
                                        <td> IRT </td>
                                        <td> AL </td>

                                        <td>
                                            <a href="">
                                                <span class="page-title-icon bg-gradient-success text-white me-2 tail">
                                                    <i class="fa-solid fa-list"></i>
                                                </span>
                                            </a>
                                            <button class="page-title-icon bg-primary text-white me-2 tail" type="button"
                                                data-bs-toggle="modal" data-bs-target="#modal-modification"
                                                style="border: none;">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal-confirmation"
                                                class="page-title-icon bg-danger text-white me-2 tail"
                                                style="border: none;">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                    <div class="modal-body">
                        <form action="{{ route('client.store') }}" method="POST" class="forms-sample">
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
                                    id="exampleInputUsername1" placeholder="Prénom du client si nécessaire" name="prenom"
                                    value="{{ old('prenom') }}">
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Denomination de l'entreprise</label>
                                <input type="text" class="form-control @error('denomination') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Dénomination de l'entreprise si nécessaire" name="denomination"
                                    value="{{ old('denomination') }}">
                                @error('denomination')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
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
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    {{-- Fin du Modal boite d'Ajout --}}

    {{-- Modal boite de modification  --}}
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal fade" id="modal-modification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modification d'un client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-primary">Modifier</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Fin du Modal boite de modification --}}

    {{-- Modal boite de confirmation  --}}
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal fade" id="modal-confirmation" data-bs-backdrop="static" data-bs-keyboard="false"
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-primary">Oui, je suis sûr!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Fin du Modal boite de confirmation --}}
@endsection
