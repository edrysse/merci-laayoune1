@extends('client.layout')

@section('content')
@php
    function random_strings($length_of_string) {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }
@endphp

<base href="{{ secure_asset('/') }}">
@include('client.includes.aside')

<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url({{ secure_asset('clientpage/images/bg-event-03.jpg') }});">
    <h2 class="tit6 t-center">Commande</h2>
</section>

<section class="py-5">
    @if ($msg = Session::get('msg'))
        <div class="alert alert-success">
            {{ $msg }}
            <div>
                <a href="{{ route('clientMenu.index') }}">
                    <button class="btn btn-success flex-shrink-0" type="button">
                        <i class="bi-cart-fill me-1"></i> Retour au menu
                    </button>
                </a>
                <a href="{{ route('pannier.index') }}">
                    <button class="btn btn-success flex-shrink-0" type="button">
                        <i class="bi-cart-fill me-1"></i> Aller au panier
                    </button>
                </a>
            </div>
        </div>
    @endif

    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ secure_asset($repas->image) }}" alt="..." /></div>
            <div class="col-md-6">
                <div class="medium mb-1">{{ $repas->type }}</div>
                <h1 class="display-5 fw-bolder">{{ $repas->nom }}</h1>
                <div class="fs-20 mb-7">
                    <span>{{ $repas->prix }} DHS</span>
                </div>
                <p class="lead">{{ $repas->description }}</p>
                <form action="{{ route('add_pannier', $repas->id) }}" method="get">
                    <div class="quantity">
                        <div class="number-input">
                            <button onclick="this.parentNode.queryبالطبع، إليك النسخ المعدلة لكل من صفحة السلة (pannier) وصفحة الطلب (cart) مع تصحيحات وأفضل الممارسات:

### 1. صفحة السلة (pannier.blade.php)

```blade
@extends('client.layout')

@section('meta')
<title>Merci Laayoune - Pannier</title>
<meta name="description" content="Consultez votre panier au Merci Laayoune pour voir les articles que vous avez choisis. Visualisez les produits, leurs prix et les quantités sélectionnées avant de passer à l'étape suivante de votre expérience de commande.">
<meta name="keywords" content="Panier d'achats, Articles choisis, Prix produits, Quantités, Expérience de commande.">
<meta property="og:locale" content="fr_FR">
<meta property="og:type" content="website">
<meta property="og:title" content="Merci Laayoune - Pannier">
<meta property="og:url" content="{{ secure_url('pannier') }}">
<meta property="og:site_name" content="Merci Laayoune">
@endsection

@section('content')
<base href="{{ secure_asset('/') }}">
@include('client.includes.aside')

<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url({{ secure_asset('clientpage/images/bg-title-page-03.jpg') }});">
    <div style="display: flex; flex-direction: column; align-items: center;">
        <h2 class="tit6 t-center">Pannier</h2>
        <div class="mb-4">
            <img class="mercilogo-autre" src="{{ secure_asset('clientpage/images/MERCI_IMG/LOGO/Logo-Merci-b1.png') }}" alt="">
        </div>
        <div style="display: flex; align-items: center;">
            <a href="https://www.facebook.com/mercilaayoune"><img src="{{ secure_asset('clientpage/images/MERCI_IMG/social-media-merci/facebook-app-symbol-merci.png') }}" alt="" width="22px"></a>
            <a href="https://www.instagram.com/mercilaayoune1"><img class="ml-2" src="{{ secure_asset('clientpage/images/MERCI_IMG/social-media-merci/instagram-merci.png') }}" alt="" width="22px"></a>
            <a href="https://www.tiktok.com/@mercilaayoune"><img class="ml-2" src="{{ secure_asset('clientpage/images/MERCI_IMG/social-media-merci/tik-tok-merci.png') }}" alt="" width="22px"></a>
            <a href="#"><img class="ml-2" src="{{ secure_asset('clientpage/images/MERCI_IMG/social-media-merci/snapchat.png') }}" alt="" width="22px"></a>
            <a href="https://shorturl.at/cnrt1"><img class="ml-2" src="{{ secure_asset('clientpage/images/MERCI_IMG/social-media-merci/pin-merci.png') }}" alt="" width="22px"></a>
        </div>
    </div>
</section>

<div class="container">
    <style>
        .total { display: flex; flex-direction: column; align-items: flex-end; margin-bottom: 6em; margin-top: 1em; }
        .total .t { margin-bottom: 5px; }
        .button { display: flex; }
        span { display: block; width: 256px; border-top: 1px solid #ccc; }
    </style>

    <table class="pannier">
        <thead>
            <tr>
                <th scope="col">Photo</th>
                <th scope="col">Repas</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cartItems as $cartItem)
                @php $total += $cartItem->price * $cartItem->qty; @endphp
                <tr data-id="{{ $cartItem->id }}">
                    <td data-label="Photo" style="display: flex; justify-content: center;">
                        <img src="{{ secure_asset($cartItem->model->image) }}" class="img-fluid" style="width: 150px;" alt="">
                    </td>
                    <td data-label="Repas">{{ $cartItem->name }}</td>
                    <td data-label="Prix">{{ $cartItem->price }} DHS</td>
                    <td data-label="Quantité">
                        <form action="{{ route('pannier.update', $cartItem->rowId) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="increment">
                                <div class="number-input">
                                    <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                                    <input class="quantity" min="1" name="qty" value="{{ $cartItem->qty }}" type="number">
                                    <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                                </div>
                                <button type="submit" class="btn btn-outline-dark">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                    <td data-label="Subtotal">{{ $cartItem->price * $cartItem->qty }} DHS</td>
                    <td data-label="Supprimer">
                        <form action="{{ route('pannier.destroy', $cartItem->rowId) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-dark">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <div class="t">
            <h5 class="fw-bold mb-0">Total: {{ $total }} DHS</h5>
        </div>
        <div class="button">
            <div class="mr-3">
                <a href="{{ route('clientMenu') }}" class="btn3 flex-c-m size13 txt11 trans-0-4"><i class="mdi mdi-arrow-left me-1"></i> Retour au menu</a>
            </div>
            <div>
                <a href="{{ route('comnd.create') }}" class="btn3 flex-c-m size13 txt11 trans-0-4" style="width: 90px">Valider</a>
            </div>
        </div>
    </div>
</div>
@endsection
