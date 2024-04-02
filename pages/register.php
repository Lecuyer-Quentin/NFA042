<main>
    <section>
        <article>
            <?php
            require_once 'components/form/form.php';
            generateForm([
                'class' => 'login_form',
                'id' => 'register_form',
                'header' => ['S\'inscrire', 'Bienvenue sur notre site'],
                'submit' => 'S\'inscrire',
                'action' => 'actions/register.php',
                'fields' => [
                    ['type' => 'input', 'name' => 'nom', 'label' => 'Nom', 'required' => true],
                    ['type' => 'input', 'name' => 'prenom', 'label' => 'Prénom', 'required' => true],
                    ['type' => 'input', 'name' => 'email', 'label' => 'Email', 'required' => true],
                    ['type' => 'password', 'name' => 'password', 'label' => 'Mot de Passe', 'required' => true],
                    ['type' => 'password', 'name' => 'password_confirm', 'label' => 'Confirmer le Mot de Passe', 'required' => true],
                    ['type' => 'hidden', 'name' => 'role', 'value' => 2]
                ],
                'footer' => [
                    'Déjà un compte ? <a href="index.php?page=login">Connectez-vous</a>'
                ]   
            ]);
            ?>
        </article>
    </section>
</main>

<script>


$(document).ready(function() {
    $('#register_form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                if (data === 'success') {
                    $('#success-message').html('Inscription réussie.');
                    setTimeout(function() {
                        $('#success-message').html('');
                        window.location.href = 'index.php';
                    }, 2000);
                } else {
                    $('#error-message').html(data);
                    setTimeout(function() {
                        $('#error-message').html('');
                    }, 2000);
                }
            },
            error: function( jqXhr, textStatus, errorThrown ){
                $('#error-message').html('Une erreur est survenue, veuillez réessayer.');
                setTimeout(function() {
                    $('#error-message').html('');
                }, 2000);
            }
        });
    });
});
</script>