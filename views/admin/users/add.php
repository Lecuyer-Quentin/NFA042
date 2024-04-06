<?php
require_once 'class/Form.php';
require_once 'utils/get_JSON.php';
require_once 'api/get_roles.php';

function add_user_form() {
    $roles = get_roles();
    $data = get_JSON('data.json','forms', 'add_user');
    $data['fields'][5]['options'] = $roles;
    $form = new Form();
    $form->setData($data);
    echo $form->generateForm();
}

function add_user_view(){
    echo '<section>';
        echo '<article>';
            add_user_form();
        echo '</article>';
    echo '</section>';
}

add_user_view();

?>

<script>
    $(document).ready(function() {
        $('#add_user_form').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(data) {
                    if (data === 'success') {
                        $('#success-message').html('Utilisateur ajouté avec succès.');
                        setTimeout(function() {
                            $('#add_user_form').trigger('reset');
                            $('#success-message').html('');
                        }, 2000);
                    } else {
                        $('#error-message').html(data);
                        setTimeout(function() {
                            $('#error-message').html('');
                        }, 2000);
                    }
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    $('#error-message').html('Une erreur est survenue, veuillez réessayer.');
                    setTimeout(function() {
                        $('#error-message').html('');
                    }, 2000);
                }
            });
        });
    });
</script>
