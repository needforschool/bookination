<?php

/**
 * Donne l'heure exacte en format (Y-m-d H:i:s), cela évite d'utiliser la foncion SQL si le serveur n'est pas configuré.
 * 
 * @return string
 */
function now()
{
    return (new \DateTime())->format('Y-m-d H:i:s');
}

/**
 * Donne la date exacte en format (Y-m-d), cela évite d'utiliser la foncion SQL si le serveur n'est pas configuré.
 * 
 * @return string
 */
function nowDate()
{
    return (new \DateTime())->format('Y-m-d');
}

/**
 * Vérifie et fix la faille XSS.
 * 
 * @param string $value
 * @return string
 */
function checkXss($value)
{
    return trim(strip_tags($value));
}

/**
 * Vérifie la longueur d'une chaine de caractères.
 * 
 * @param array<string> $errors
 * @param string $data
 * @param string $key
 * @param int $min
 * @param int $max
 * @return array<string>
 */
function checkField($errors, $data, $key, $min, $max)
{
    if (!empty($data)) {
        if (mb_strlen($data) < $min) {
            $errors[$key] = 'Min ' . $min . ' caractères';
        } elseif (mb_strlen($data) > $max) {
            $errors[$key] = 'Max ' . $max . ' caractères';
        }
    } else {
        $errors[$key] = 'Veuillez renseigner ce champ';
    }
    return $errors;
}

/**
 * Vérifie qu'une chaine de caractères est bien une adresse mail.
 * 
 * @param array<string> $errors
 * @param string $data
 * @param string $key
 * @return array<string>
 */
function checkEmail($errors, $data, $key)
{
    if (!filter_var($data, FILTER_VALIDATE_EMAIL)) $errors[$key] = 'Cette adresse mail est invalide';
    return $errors;
}

/**
 * Génère une chaine de caractères aléatoire.
 * 
 * @param int $length
 * @return array<string>
 */
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Calcule la différence entre la date actuelle et la date renseigné.
 * 
 * @param string $birthDate
 * @return int
 */
function calculateAge($birthDate)
{
    $date = new DateTime($birthDate);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
}

/**
 * Session
 */

/**
 * Vérifie si un utilisateur est connecté.
 * 
 * @return bool
 */
function isLogged()
{
    if (!empty($_SESSION['user'])) return true;
    return false;
}

/**
 * Vérifie si un utilisateur est connecté en tant qu'administrateur.
 * 
 * @return bool
 */
function isAdmin()
{
    if (!empty($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') return true;
    return false;
}

/**
 * Déconnecte l'utilisateur actuel.
 * 
 * @return void
 */
function logout()
{
    session_start();
    $_SESSION['user'] = [];
    header('Location: ./');
}

/**
 * SQL
 */

/**
 * Insert des valeurs dans la table d'une base de donnée.
 * 
 * @param PDO $pdo
 * @param string $table
 * @param array<string> $columns
 * @param array<string> $values
 * @return null
 */
function insert($pdo, $table, $columns, $values)
{
    if (!is_array($columns) || !is_array($values)) return;

    $bindValues = [];
    for ($i = 0; $i < count($values); $i++) {
        $bindValues[] = ':value' . $i;
    }

    $strBindValues = implode(', ', $bindValues);
    $strColumns = implode(', ', $columns);

    $sql = 'INSERT INTO ' . $table . ' (' . $strColumns . ') VALUES (' . $strBindValues . ')';
    $query = $pdo->prepare($sql);
    for ($i = 0; $i < count($values); $i++) {
        $query->bindValue(':value' . $i, $values[$i]);
    }
    $query->execute();
}

/**
 * Séléctionne une valeur dans la table d'une base de donnée.
 * 
 * @param PDO $pdo
 * @param string $table
 * @param string $selectedColumn
 * @param string $whereColumn
 * @param string $whereValue
 * @return mixed
 */
function select($pdo, $table, $selectedColumn = '*', $whereColumn = null, $whereValue = null)
{
    $sql = 'SELECT ' . $selectedColumn . ' FROM ' . $table;
    if ($whereColumn && $whereValue) $sql .= ' WHERE ' . $whereColumn . ' = :whereValue';
    $query = $pdo->prepare($sql);
    if ($whereColumn && $whereValue) $query->bindValue(':whereValue', $whereValue);
    $query->execute();
    $result = $query->fetch();
    return $result;
}

/**
 * Séléctionne des valeurs dans la table d'une base de donnée.
 * 
 * @param PDO $pdo
 * @param string $table
 * @param string $selectedColumn
 * @param string $whereColumn
 * @param string $whereValue
 * @param string $orderColumn
 * @param string $order
 * @return array
 */
function selectAll($pdo, $table, $selectedColumn = '*', $whereColumn = null, $whereValue = null, $orderColumn = null, $order = null)
{
    $sql = 'SELECT ' . $selectedColumn . ' FROM ' . $table;
    if ($whereColumn && $whereValue) $sql .= ' WHERE ' . $whereColumn . ' = :whereValue';
    if ($orderColumn && $order) $sql .= ' ORDER BY ' . $orderColumn . ' ' . $order;
    $query = $pdo->prepare($sql);
    if ($whereColumn && $whereValue) $query->bindValue(':whereValue', $whereValue);
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

/**
 * Met à jour des valeurs dans la table d'une base de donnée.
 * 
 * @param PDO $pdo
 * @param string $table
 * @param array<string> $values
 * @param string $whereColumn
 * @param string $whereValue
 * @return void
 */
function update($pdo, $table, $values, $whereColumn, $whereValue)
{
    if (!is_array($values)) return;

    $strValues = implode(', ', $values);
    $sql = 'UPDATE ' . $table . ' SET ' . $strValues . ' WHERE ' . $whereColumn . ' = :whereValue';
    $query = $pdo->prepare($sql);
    $query->bindValue(':whereValue', $whereValue);
    $query->execute();
}

/**
 * Supprime une valeur dans la table d'une base de donnée.
 * 
 * @param PDO $pdo
 * @param string $table
 * @param string $whereColumn
 * @param string $whereValue
 * @return void
 */
function delete($pdo, $table, $whereColumn, $whereValue)
{
    $sql = 'DELETE FROM ' . $table . ' WHERE ' . $whereColumn . ' = ' . ':whereValue';
    $query = $pdo->prepare($sql);
    $query->bindValue(':whereValue', $whereValue);
    $query->execute();
}
