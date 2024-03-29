<main>
    <section>
        <article>
            <?php
            require_once 'components/form/form.php';
            generateForm([
                'class' => 'login_form',
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