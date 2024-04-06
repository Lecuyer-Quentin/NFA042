<?php
require_once 'class/Form.php';
require_once 'utils/get_JSON.php';
require_once 'api/get_category.php';

function add_product_form(){
    $categories = get_category();
    $data = get_JSON('data.json','forms', 'add_product');
    $data['fields'][4]['options'] = $categories;
    $form = new Form();
    $form->setData($data);
    echo $form->generateForm();
}

function add_product_view(){
    echo '<section>';
        echo '<article>';
            add_product_form();
        echo '</article>';
    echo '</section>';
}

add_product_view();

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