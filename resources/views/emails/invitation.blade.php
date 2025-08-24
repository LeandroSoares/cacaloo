<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Convite para o Sistema Cacaloo</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #3949AB;
        }
        .button {
            display: inline-block;
            background-color: #3949AB;
            color: white !important;
            text-decoration: none;
            padding: 10px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">Convite para o Sistema Cacaloo</div>

    <p>Olá,</p>

    <p>Você foi convidado(a) por {{ $invitation->inviter->name ?? 'um administrador' }} para se juntar ao sistema Cacaloo.</p>

    <p>Para aceitar este convite, clique no botão abaixo:</p>

    <p><a class="button" href="{{ url('/register?token=' . $invitation->token) }}">Aceitar Convite</a></p>

    <p>Ou copie e cole o seguinte link no seu navegador:</p>

    <p>{{ url('/register?token=' . $invitation->token) }}</p>

    <p>Este convite expira em {{ $invitation->expires_at->format('d/m/Y') }}.</p>

    <div class="footer">
        <p>Atenciosamente,<br>
        {{ config('app.name') }}</p>
    </div>
</body>
</html>
