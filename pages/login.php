<main>
    <section>
        <article>
            <?php
            require_once 'components/form/form.php';
            generateForm([
                'class' => 'login_form',
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