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
                    <i class="mdi mdi-contacts menu-icon"></i>
                </span> Utilisateurs
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
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Utilisateur Total <i
                                class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ count($utilisateurs) }}</h2>
                        <h6 class="card-text">Mise à jour depuis le {{$date->updated_at->format('d/m/y')}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
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
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3"><i class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">-------</h2>
                        <h6 class="card-text"></h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                            <h4 class="card-title">Liste des Utilisateurs</h4>
                            
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-ajout"
                                class="btn btn-block btn-lg btn-gradient-primary">+ Ajouter un utilisateur</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Pseudo </th>
                                        <th> Email </th>
                                        <th> Type utilisateur</th>
                                        <th> Dernière connexion</th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                @foreach ($utilisateurs as $user)
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $user->pseudo }}
                                            </td>
                                            <td> {{ $user->email }} </td>
                                            <td>
                                                {{ $user->type_user }}
                                            </td>
                                            <td>le 12/08/2023</td>
                                            <td>
                                                {{-- <a href="">
                                                <span class="page-title-icon bg-gradient-success text-white me-2 tail">
                                                    <i class="fa-solid fa-list"></i>
                                                </span>
                                            </a> --}}
                                                <a href="#edit{{ $user->id }}"
                                                    class="page-title-icon bg-primary text-white me-2 tail" type="button"
                                                    data-bs-toggle="modal" style="border: none;">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="#delete{{ $user->id }}" type="button" data-bs-toggle="modal"
                                                    class="page-title-icon bg-danger text-white me-2 tail"
                                                    style="border: none;">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                                @include('dashboard.user.action')
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        <div style="margin-top: 20px;"></div>
                        @if (count($utilisateurs) > 0)
                            {{ $utilisateurs->links() }}
                        @else
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="card-description">Pas d'utilisateurs.</p>
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
                        <h5 class="modal-title" id="staticBackdropLabel">Ajout d'un utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.store') }}" method="POST" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Pseudo</label>
                                <input type="text" class="form-control @error('pseudo') is-invalid @enderror"
                                    id="exampleInputUsername1" placeholder="Username" name="pseudo"
                                    value="{{ old('pseudo') }}">
                                @error('pseudo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                                    placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">Type d'utilisateur</label>
                                <select name="type_user"
                                    class="form-control form-control-sm @error('type_user') is-invalid @enderror"
                                    id="exampleFormControlSelect3">
                                    <option>Super Admin</option>
                                    <option>Admin</option>
                                    <option>Simple Utilisateur</option>
                                </select>
                                @error('type_user')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mot de passe</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="exampleInputPassword1" placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Confirmer le mot de passe</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="exampleInputConfirmPassword1" placeholder="Confirm password">
                                @error('password_confirmation')
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
@endsection
