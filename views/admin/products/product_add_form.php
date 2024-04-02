<?php

require_once 'components/form/form.php';
require_once 'api/get_category.php';


function admin_add_project_form(){
    $categories = get_category();

    generateForm([
        'class' => 'contact',
        'id' => 'add_product_form',
        'header' => ['Ajouter un produit', 'Veuillez remplir les champs suivants pour ajouter un produit'],
        'submit' => 'Add product',
        'action' => 'actions/add_product.php',
        'enctype' => 'multipart/form-data',
        'fields' => [
            ['type' => 'input', 'name' => 'name', 'label' => 'Nom', 'required' => 'required'],
            ['type' => 'textarea', 'name' => 'description', 'label' => 'Description', 'required' => 'required'],
            ['type' => 'number', 'name' => 'price', 'label' => 'Prix', 'required' => 'required'],
            ['type' => 'select', 'name' => 'category', 'label' => 'Catégorie', 'options' => $categories, 'required' => 'required'],
            ['type' => 'file', 'name' => 'image', 'label' => 'Image', 'required' => 'required']
        ]
    ]);
}

?>

<script>
    $(document).ready(function() {
        $('#add_product_form').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data === 'success') {
                        $('#success-message').html('Produit ajouté avec succès.');
                        setTimeout(async function() {
                            $('#add_product_form').trigger('reset');
                            $('#success-message').html('');
                        }, 2000);
                    } else {
                        $('#error-message').html(data);
                        setTimeout(async function() {
                            $('#error-message').html('');
                        }, 2000);
                    }
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    $('#error-message').html('Une erreur est survenue, veuillez réessayer.');
                    setTimeout(async function() {
                        $('#error-message').html('');
                    }, 2000);
                }
            });
        });
    });
</script>