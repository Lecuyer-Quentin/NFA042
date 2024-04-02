<main>
    <section>
        <article>
            <?php
            require_once 'components/form/form.php';
            generateForm([
                'class' => 'login_form',
                'id' => 'login_form',
                'header' => ['Se Connecter', 'Bienvenue sur notre site'],
                'submit' => 'Se Connecter',
                'action' => 'actions/log_in.php',
                'fields' => [
                    [
                        'type' => 'input',
                        'name' => 'email',
                        'label' => 'Email',
                        'required' => true
                    ],
                    [
                        'type' => 'password',
                        'name' => 'password',
                        'label' => 'Mot de Passe',
                        'required' => true
                    ]
                    ],
                'footer' => [
                    'Pas encore de compte ? <a href="index.php?page=register">Inscrivez-vous</a>',
                    'Mot de passe oublié ? <a href="index.php?page=forgot_password">Réinitialiser</a>'
                    ]
            ]);
            ?>
        </article>
    </section>
</main>

<script>
$(document).ready(function() {
    $('#login_form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                if (data === 'success') {
                    $('#success-message').html('Connexion réussie. Vous allez être redirigé vers la page d\'accueil.');
                    setTimeout(function() {
                        $('#success-message').html('');
                        $('#login_form').trigger('reset');
                        window.location.href = 'index.php';
                    }, 2000);
                } else {
                    $('#error-message').html(data);
                    setTimeout(function() {
                        $('#error-message').html('');
                    }, 2000);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#error-message').html('Une erreur est survenue lors de la connexion. Veuillez réessayer.');
                setTimeout(function() {
                    $('#error-message').html('');
                }, 2000);
            }
        });
    });
});
</script>