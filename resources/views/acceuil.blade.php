<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ClientTechLink</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}" />
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;1,6..12,200;1,6..12,300;1,6..12,400&display=swap');
    *{
        font-family: 'Nunito Sans', sans-serif;
    }
.style {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 15px;
}
a {
    padding: 15px 40px;
    border-radius: 60px;
    background: white;
    border: none;
    z-index: 10;
    text-decoration: none;
    /* Ajouter une transition pour l'animation */
    transition: transform 0.3s ease;
}

a:hover {
    background: #da8cff;
    color: white;
    /* Appliquer l'animation de transformation sur le survol */
    transform: scale(1.1);
}

.text-gradient {
  /* display: inline-block;
  background: -webkit-linear-gradient(left, #da8cff, #9a55ff);
  background: linear-gradient(to right, #da8cff, #9a55ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent; */
  color:#9a55ff;
  font-size: 16px;
}


@media screen and (max-width:640px) {
    .style{
        margin: 0 30px;
    }
}
</style>

<body class="bg-gradient-primary body" style="z-index: 1;">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="style">
            <h1 class="text-white font-weight-bold" style="font-size: 60px;">Bienvenue sur ClientTechLink!</h1>
            <p class="text-white" style="font-size: 20px;">Ceci est la plateforme de support technique dédiée aux clients d'AnyxTech.</p>
            <a href="{{url('/login')}}" class="text-gradient">Connectez-vous </a>
        </div>
    </div>
</body>
</html>