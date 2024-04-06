<?php
require_once 'class/Form.php';
require_once 'utils/get_JSON.php';

function contact_details(){
    $data_contact = get_JSON('data.json', 'forms', 'contact');
    $form = new Form();
    $form->setData($data_contact);
    $contact = '<section>';
    $contact .= '<h2>Contacter nous</h2>';
        $contact .= '<article>';
            $contact .= '<p>Pour toute question ou renseignement, veuillez nous contacter à l\'aide du formulaire ci-dessous.</p>';
            $contact .= '<p>Nous vous recontacterons dans les plus brefs délais.</p>';
        $contact .= '</article>';
        $contact .= '<article>';
            $contact .= $form->generateForm();
        $contact .= '</article>';
    $contact .= '</section>';

    return $contact;
}
echo contact_details();