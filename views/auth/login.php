<main>
    <section>
        <article>
            <?php
            require_once 'class/Form.php';
            require_once 'utils/get_JSON.php';
            $data = get_JSON('data.json','forms', 'login');
            $form = new Form();
            $form->setData($data);
            echo $form->generateForm();
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