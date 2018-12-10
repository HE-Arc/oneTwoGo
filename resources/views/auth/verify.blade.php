@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vérification de votre adresse mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse mail.') }}
                        </div>
                    @endif

                    {{ __('Avant de continuer, veuillez contrôler votre adresse mail pour le lien de vérification.') }}
                    {{ __('Si vous n'avez pas reçu de mail de vérification') }}, <a href="{{ route('verification.resend') }}">{{ __('Cliquez ici pour recevoir un nouveau mail') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
