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
                <th scope="col">photo</th>
                <th scope="col">repas</th>
                <th scope="col">prix</th>
                <th scope="col">quantite</th>
                <th scope="col">subtotal</th>
                <th scope="col">delete</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cartItems as $cartItem)
                @php $total += $cartItem->price * $cartItem->qty; @endphp
                <tr data-id="{{ $cartItem->id }}">
                    <td data-label="photo" style="display: flex; justify-content: center;">
                        <img src="{{ secure_asset($cartItem->model->image) }}" class="img-fluid" style="width: 150px;" alt="">
                    </td>
                    <td data-label="repas">{{ $cartItem->name }}</td>
                    <td data-label="prix">{{ $cartItem->price }} DHS</td>
                    <td data-label="quantite">
                        <form action="{{ route('pannier.update', $cartItem->rowId) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="increment">
                                <div class="number-input">
                                    <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                                    <input class="quantity" min="1" name="qty" value="{{ $cartItem->qty }}" type="number">
                                    <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                                </div>
                                <button type="submit" class="btn btn-outline-dark">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                    <td data-label="subtotal">{{ $cartItem->price * $cartItem->qty }} DHS</td>
                    <td data-label="delete">
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
