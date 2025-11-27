@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/legacy/sidebarStyle.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dialog-polyfill/0.5.6/dialog-polyfill.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">

    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <style>
        html {
            overflow-x: clip;
        }

        .conainer {
            font-family: 'Nunito', sans-serif;
            padding: 50px 0;
        }

        form {

            padding: 0 45px 0 45px;
            padding: 0 6rem;
            font-size: 13px;
        }

        #Action {
            display: flex;
        }

        #btn {
            display: flex;
        }

        #studentsTable {
            font-size: .9rem;
        }

        a {
            text-decoration: none;
        }

        #idtd2 {
            width: 149px;
        }

        #idtd1 {
            width: 120px;
        }

        p {
            margin: 0 auto;
        }

        .divform {
            padding: 0 20px;
            font-size: 13.5px;
        }

        #btn {
            font-size: 0.675rem;
        }


        body {
            background-color: #f0f0f0;
        }

        .container {
            background-color: #fff;
            padding: 8px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-info {}

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        #classesList {
            padding: 0 100px 0 100px;
            font-size: 12px;
        }

        .timetable th {
            background-color: #007bff;
            color: #fff;
            text-align: center;
        }

        .timetable th,
        .timetable td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }

        .timetable td {
            background-color: #f9f9f9;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        table td span {
            width: fit-content;
        }

        table td a {
            display: flex;
            justify-content: space-around;
        }

        .tableNotes th,
        .tableNotes td {
            vertical-align: middle;
        }





        @media screen and (max-width: 768px) {
            body {
                font-size: 16px;
            }

            .container {
                max-width: 506px;
                padding: 10px;
                font-size: 12px;
                
            }

            /* Additional styles for tablet devices */
            .card {
                margin: 0 ;
                max-width: 90%;
            }

            h4,
            h1 {
                font-size: 20px;
            }

            h5 {
                font-size: 13px;
            }

            .table-responsive {
                overflow-x: auto;
            }

            table {
                font-size: 14px;
            }

            #btn {
                font-size: 12px;
            }

            .divform {
                padding: 0 20px;
                font-size: 8px;

            }

            form {
                font-size: 14px;
                padding: initial;
            }

            .home_content {
                margin: 0 auto;
                max-width: auto;
                font-size: 12px;
                justify-content: center !important;
            }

            #classesList {
                padding: 0;
                font-size: 12px;
            }

        }

        @media print {

            #allAction {
                display: none;
            }

            a {
                text-decoration: none !important;
            }

        }
    </style>

    <div class="sidebar" id="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class="bx bx-book-open"></i>
                <div class="logo_name">École</div>
            </div>
            <i class="bx bx-menu" id="sidebtn"></i>
        </div>
        <div class="src" style="display: flex;">
            <i class="bx bx-search" title="recherche"></i>
            <span class="link_name" style="padding: 14px 57px;">Recherche</span>
        
        </div>
        <ul class="nav">
            <li>
                <a href="{{ url('/tableau-bord') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Accueil">
                    <i class="bi bi-house-door"></i>
                    <span class="link_name">Accueil</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/etudiant') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                    data-bs-title="Etudiants">
                    <i class="bi bi-people"></i>
                    <span class="link_name">Etudiants</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/enseignant') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                    data-bs-title="Enseignants">
                    <i class="bi bi-person-badge"></i>
                    <span class="link_name">Enseignants</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/classe') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Classes">
                    <i class="bi bi-journal-text"></i>
                    <span class="link_name">Classes</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/cour') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Emploi">
                    <i class="bi bi-calendar-event"></i>
                    <span class="link_name">Les emplois du temps</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/evoluation') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                    data-bs-title="Evoluations">
                    <i class="bi bi-bar-chart"></i>
                    <span class="link_name">L'évolutions</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/note') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Notes">
                    <i class="bi bi-journal-check"></i>
                    <span class="link_name">Les notes</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/paiement') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                    data-bs-title="Paiement">
                    <i class="bi bi-cash-stack"></i>
                    <span class="link_name">Paiement</span>
                </a>
            </li>
            <li style="top: 7px;">
                <button id='print' title="Imprimer" style="padding: 0 7px;">
                    <img id="img" src={{ asset('img/icons8-print-50.png') }}>
                </button>
            </li>
        </ul>

    </div>


    <div class="home_content" id="home_content">
        <div style="width:80%; margin-bottom: 0%; margin-left: 86px;">
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            @if (null !== session('flash_message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('flash_message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        @yield('content2')
    </div>
    <script>
        const print = document.getElementById('print');
        const home_content = document.getElementById('home_content');

        print.addEventListener('click', () => {
            sidebar.style.display = 'none';
            home_content.style.display = 'flex';
            home_content.style.left = '0';
            window.print();
            sidebar.style.display = 'block';
            home_content.style.display = 'block';
            home_content.style.left = '80px';
        });
        document.addEventListener("DOMContentLoaded", function() {
            var imgElement = document.getElementById("img");
            var originalSrc = imgElement.src;
            imgElement.addEventListener("mouseover", function() {
                imgElement.src = "{{ asset('img/icons8-print.gif') }}";
            });
            imgElement.addEventListener("mouseout", function() {
                imgElement.src = originalSrc;
            });
        });


        let sidebtn = document.querySelector("#sidebtn");
        let sidebar = document.querySelector(".sidebar");
        let srcBtn = document.querySelector(".bx-search");
        let container = document.querySelector("container");

        sidebtn.onclick = function() {
            sidebar.classList.toggle("active");
        };
        srcBtn.onclick = function() {
            window.location.href = "/search";
        };
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
