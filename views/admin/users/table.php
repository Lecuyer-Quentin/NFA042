<?php
require_once 'api/get_roles.php';
require_once 'class/Table.php';
require_once 'utils/nbr_of_days.php';
require_once 'utils/get_JSON.php';
require_once 'models/Users.php';
$users = new Users($pdo);
$users = $users->read();

//! Members depuis ne fonctionne pas
function users_table(){
    global $users;
    $users = display_role($users);
    $nbr = count($users);
    $data = get_JSON('data.json', 'tables', 'users');
    $footer[] = ['type' => 'p', 'content' => 'Nombre d\'utilisateurs: ' . $nbr];
    $data['items'] = $users;
    //$data['columns'][6] = ['label' => 'Membre depuis', 'name' => 'member_since'];
    $data['footer'] = $footer;
    $table = new Table();
    $table->setData($data);

    $user_table = '<article>';
    $user_table .= '<h2>Users</h2>';
    $user_table .= $table->generateTable();
    $user_table .= '</article>';

    return $user_table;
}
function display_role($users) {
  $roles = get_roles();
  foreach ($users as $key => $user) {
      foreach ($roles as $role) {
          if ($user['id_role'] == $role['id_role']) {
              $users[$key]['id_role'] = ucfirst($role['nom']);
          }
      }
  }
  return $users;
}