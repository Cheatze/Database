<?php
namespace Cheatze\Library;

class DatabaseCon
{
    private string $host;//
    private string $database;//
    private $charset = 'utf8mb4';
    private string $user; //
    private string $password; //

    private $db;

    private static $databaseCon;

    /**
     * Constructor
     * Initializes this instance of the DatabaseCon class
     */
    public function __construct()
    {
        $enviroment = parse_ini_file('.env');

        $this->host = $enviroment['host'];
        $this->database = $enviroment['database'];
        $this->user = $enviroment['user'];
        $this->password = $enviroment['password'];

        $dsn = "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->db = new PDO($dsn, $this->user, $this->password, $options);

    }

    /**
     * Sets the instance of the DatabaseCon class
     * The code that makes this a singleton
     * @return DatabaseCon the singleton instance of this class
     */
    public static function getInstance()
    {
        if (!isset(self::$databaseCon)) {
            self::$databaseCon = new DatabaseCon();
        }
        return self::$databaseCon;
    }

    /**
     * Adds a new record to the database
     * @param string $sql The SQL query to run
     * @param array $values The values for the query
     * @return bool|string
     */
    public function insert(string $sql, array $values)
    {
        $statment = $this->db->prepare($sql);
        $statment->execute($values);
        return $this->db->lastInsertId();
    }

    /**
     * Fetches from the database
     * @param string $sql the SQL query to run
     * @param array $where 
     * @param string $className
     * @return array|null returns an array as result or null if there were none found
     */
    public function fetch(string $sql, array $where, string $className)
    {
        $statement = $this->db->prepare($sql);
        $statement->execute($where);
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $className);
        $result = $statement->fetchAll();
        if (empty($result)) {
            return null;
        }
        return $result;
    }

    /**
     * Changes an entry in the database
     * @param string $sql the query to run
     * @param array $values the values for the query
     * @return bool
     */
    public function update(string $sql, array $values)
    {
        $statement = $this->db->prepare($sql);
        return $statement->execute($values);
    }

    //make a delete method
    public function delete($sql, $where)
    {
        //
    }
}