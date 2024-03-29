<?php
require 'components/form/form.php';

function contact_details(){
    echo '<section>';
    echo '<h2>Contacter nous</h2>';
        echo '<article>';
            echo '<p>Pour toute question ou renseignement, veuillez nous contacter à l\'aide du formulaire ci-dessous.</p>';
            echo '<p>Nous vous recontacterons dans les plus brefs délais.</p>';
        echo '</article>';
        echo '<article>';
            generateForm([
                'class' => 'contact',
                'submit' => 'Envoyer',
                'action' => 'actions/contact.php',
                'fields' => [
                    [
                        'type' => 'input',
                        'name' => 'name',
                        'label' => 'Prénom',
                        'required' => true
                    ],
                    [
                        'type' => 'input',
                        'name' => 'last_name',
                        'label' => 'Nom',
                        'required' => true
                    ],
                    [
                        'type' => 'input',
                        'name' => 'email',
                        'label' => 'Email',
                        'required' => true
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'message',
                        'label' => 'Message',
                        'required' => true
                    ]
                ]
            ]);
        echo '</article>';
    echo '</section>';
}
contact_details();