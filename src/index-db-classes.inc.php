<?php
class DatabaseHelper
{
    /* Returns a connection object to a database */
    public static function createConnection($values = array())
    {
        $connString = $values[0];
        $user = $values[1];
        $password = $values[2];
        $pdo = new PDO($connString, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
    /*
Runs the specified SQL query using the passed connection and
the passed array of parameters (null if none)
*/
    public static function runQuery($connection, $sql, $parameters)
    {
        $statement = null;
        // if there are parameters then do a prepared statement
        if (isset($parameters)) {
            // Ensure parameters are in an array
            if (!is_array($parameters)) {
                $parameters = array($parameters);
            }
            // Use a prepared statement if parameters
            $statement = $connection->prepare($sql);
            $executedOk = $statement->execute($parameters);
            if (!$executedOk) throw new PDOException;
        } else {
            // Execute a normal query
            $statement = $connection->query($sql);
            if (!$statement) throw new PDOException;
        }
        return $statement;
    }
    public static function describeTable($connection, $table)
    {
        $statement = null;
        // Execute a normal query
        $statement = $connection->query("DESCRIBE $table");
        $executedOk = $statement->execute();
            if (!$executedOk) throw new PDOException;
        return $statement;
    }
}

class CompanyDB
{

    private static $baseSQL = "SELECT * FROM companies";
    public function __construct($connection)
    {
        $this->pdo = $connection;
    }
    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getAllForCompany($symbol)
    {
        $sql = self::$baseSQL . " WHERE symbol = :symbol";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array("symbol" => $symbol)
        );
        return $statement->fetchAll();
    }
}
class PortfolioDB
{

    private static $baseSQL = "SELECT symbol, sum(amount) as ammount, name, close, sum(amount)*(close) as total_value
    from portfolio p
        join history using (symbol)
        join companies using (symbol)
    where userId = :userID
      and date = (select max(date) from history where symbol = p.symbol)
    group by symbol, name, close";
    public function __construct($connection)
    {
        $this->pdo = $connection;
    }
    public function getPortfolio()
    {
        if(SessionManager::isLoggedIn()){
            $sql = self::$baseSQL;
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, 
                array("userID" => $_SESSION['userID']));
            return $statement->fetchAll();
        }
    }
}

class HistoryDB
{

    private static $baseSQL = "SELECT * FROM history";
    public function __construct($connection)
    {
        $this->pdo = $connection;
    }
    public function getAll()
    {
        $sql = self::$baseSQL;
        $statement =
            DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getAllForHistory($symbol)
    {
        $sql = self::$baseSQL . " WHERE symbol = :symbol ORDER BY date DESC";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array("symbol" => $symbol)
        );
        return $statement->fetchAll();
    }
    public function getSortedAllForHistory($symbol, $sort)
    {
        $columns = DatabaseHelper::describeTable($this->pdo, 'history')->fetchAll();
        //Make sure that the sort param is valid to protect against injection, since MySQL is dumb and won't let me bind the sorts
        if(in_array($sort, array_column($columns, 'Field'))){
            $sql = self::$baseSQL . " WHERE symbol = :symbol ORDER BY $sort DESC"; 
        } else {
            $sql = self::$baseSQL . " WHERE symbol = :symbol ORDER BY 1 DESC"; 
        }
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array("symbol" => $symbol)
        );
        return $statement->fetchAll();
    }
}

class SessionManager
{
    private static $baseSQL = "SELECT id, country, firstname, lastname, email, password  FROM users";
    public function __construct($connection)
    {
        $this->pdo = $connection;
    }
    public function login($user, $pass)
    {
        $sql = self::$baseSQL . " WHERE email = :user";
        $statement = DatabaseHelper::runQuery(
            $this->pdo,
            $sql,
            array("user" => $user)
        );
        $results = $statement->fetchAll();
        if (count($results) > 0) {
            if (password_verify( $pass, $results[0]['password'])) {
                $_SESSION["user"] = $results[0]['firstname'] . ' ' . $results[0]['lastname'];
                $_SESSION["userID"] = $results[0]['id'];
                return true;
            }
        }
        //check user in table, then check hashed pw, if valid set session and return true, if not return false
        return false;
    }

    private static function startSessionIfNotStarted()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public static function logout()
    {
        self::startSessionIfNotStarted();
        unset($_SESSION['userID']);
        unset($_SESSION['user']);

        header("Location:/");
    }
    public static function isLoggedIn()
    {
        self::startSessionIfNotStarted();
        return isset($_SESSION['user']);
    }
    public static function upsertSessionVar($key, $value)
    {
        self::startSessionIfNotStarted();
        $_SESSION[$key] = $value;
    }
    public static function getSessionVar($key)
    {
        self::startSessionIfNotStarted();
        return $_SESSION[$key];
    }
    public static function clearSessionVar($key)
    {
        self::startSessionIfNotStarted();
        unset($_SESSION[$key]);
    }

    public static function addFavorite($favorite)
    {
        self::startSessionIfNotStarted();
        $_SESSION['favorites'][$favorite['symbol']] = $favorite;
    }

    public static function removeFavorite($favoriteID)
    {
        self::startSessionIfNotStarted();
        unset($_SESSION['favorites'][$favoriteID]);
    }
    public static function getFavorites()
    {
        self::startSessionIfNotStarted();
        if(isset($_SESSION['favorites'])){
            return $_SESSION['favorites'];
        }
    }



    public function __destruct()
    {
        $this->pdo = null;
    }
}
