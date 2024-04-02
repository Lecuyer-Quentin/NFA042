<?php
require_once 'components/form/form.php';
require_once 'api/get_roles.php';



function admin_add_user_form() {
    $roles = get_roles();

    generateForm([
        'class' => 'contact',
        'id' => 'add_user_form',
        'header' => ['Ajouter un utilisateur', 'Veuillez remplir les champs suivants pour ajouter un utilisateur'],
        'submit' => 'Add user',
        'action' => 'actions/register.php',
        'fields' => [
            ['type' => 'input', 'name' => 'nom', 'label' => 'Nom', 'required' => 'required'],
            ['type' => 'input', 'name' => 'prenom', 'label' => 'Prénom', 'required' => 'required'],
            ['type' => 'input', 'name' => 'email', 'label' => 'Email', 'required' => 'required'],
            ['type' => 'password', 'name' => 'password', 'label' => 'Password', 'required' => 'required'],
            ['type'=> 'password', 'name'=> 'password_confirm', 'label'=> 'Confirm Password', 'required'=> 'required'],
            ['type' => 'select', 'name' => 'role', 'label' => 'Role', 'options' => $roles, 'required' => 'required'],
        ]
    ]);
}

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
