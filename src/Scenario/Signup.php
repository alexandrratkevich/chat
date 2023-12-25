<?php

namespace Chat\Scenario;

use \Chat\Http\Request;
use \Chat\Inject;
use \Chat\Scenario;


/**
 * Implements scenarios of registration page for authorized visitors.
 */
class Signup implements Scenario
{
    use Inject\HtmlRenderer;
    use Inject\DatabaseConnection;


    /**
     * Runs scenario of registration page.
     *
     * @param Request $req HTTP request to index page.
     *
     * @return array    Result of index page scenario.
     */
    public function run(Request $req): array
    {
        $params = $req->POST->getAll();

        if (isset($params['login']) && isset($params['password'])) {
            $this->initDatabaseConnection();
            $stmt = $this->DatabaseConnection->prepare("SELECT * FROM `users` where `login` = :login");
            $stmt->execute(['login' => $params['login']]);

            if ($stmt->rowCount() > 0) {
                return [
                    'toRender' => [
                        'data' => 'Invalid data'
                    ]
                ];
            }

            $stmt = $this->DatabaseConnection->prepare("INSERT INTO `users` (`login`, `password`) VALUES (:login, :password)");
            $stmt->execute([
               'login' => $params['login'],
               'password' => password_hash($params['password'], PASSWORD_DEFAULT),
            ]);

            header("Location: /login");
        }

        return [];
    }
}
