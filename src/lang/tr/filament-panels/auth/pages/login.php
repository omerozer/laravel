<?php

return [

    'title' => 'Giriş',

    'heading' => 'Oturum aç',

    'actions' => [

        'register' => [
            'before' => 'veya',
            'label' => 'hesap oluştur',
        ],

        'request_password_reset' => [
            'label' => 'Şifremi unuttum',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'E-posta adresi',
        ],

        'password' => [
            'label' => 'Şifre',
        ],

        'remember' => [
            'label' => 'Beni hatırla',
        ],

        'actions' => [

            'authenticate' => [
                'label' => 'Giriş yap',
            ],

        ],

    ],

    'multi_factor' => [

        'heading' => 'Kimliğinizi doğrulayın',

        'subheading' => 'Devam etmek için kimliğinizi doğrulamanız gerekiyor.',

        'form' => [

            'provider' => [
                'label' => 'Nasıl doğrulamak istersiniz?',
            ],

            'actions' => [

                'authenticate' => [
                    'label' => 'Girişi onayla',
                ],

            ],

        ],

    ],

    'messages' => [

        'failed' => 'Bu bilgiler kayıtlarımızla eşleşmiyor.',

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'Çok fazla giriş denemesi',
            'body' => ':seconds saniye sonra tekrar deneyin.',
        ],

    ],

];
