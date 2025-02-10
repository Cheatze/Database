<?php
namespace Cheatze\Library;


//also add a delete method

class QueryBuilder
{
    private string $table;
    private DatabaseCon $databaseCon;
    private array $select;
    private array $where;
    private string $className;

    /**
     * Constructor initialises the DatabaseCon class and sets it to $databaseCon
     * Sets the $table and $className
     * @param string $className
     * @param mixed $table
     */
    public function __construct(string $className, ?string $table = null)
    {
        $this->databaseCon = DatabaseCon::getInstance();
        $this->className = $className;
        $this->table = $table ?? strtolower($className) . 's';
    }

    /**
     * Sets the table name for the query
     * @param string $table
     * @return static
     */
    public function table(string $table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Sets the fields to be used in the query
     * @param mixed $fields
     * @return static
     */
    public function select($fields)
    {
        $this->select = $fields;
        return $this;
    }

    /**
     * Sets the WHERE part of the query 
     * @param mixed $keyValuePairs
     * @return static
     */
    public function where($keyValuePairs)
    {
        $this->where = $keyValuePairs;
        return $this;
    }

    /**
     * Retrieves stuff from the database
     * @return array|null
     */
    public function get()
    {
        $sql = 'SELECT' . implode(', ', $this->select) . ' FROM ' . $this->table;
        if ($this->where) {
            $sql .= ' WHERE ' . implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($this->where)));
            //$sql .= ' WHERE ' . implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($this->where)));
        }
        return $this->databaseCon->fetch($sql, array_values($this->where), $this->className);
    }

    /**
     * Adds a new record to the database
     * @param array $keyValuePairs
     * @return bool|string
     */
    public function insert(array $keyValuePairs)
    {
        $sql = 'INSERT INTO ' . $this->table . ' (' . implode(', ', array_keys($keyValuePairs)) . ') VALUES (' . implode(', ', array_map(fn($key) => ":$key", array_keys($keyValuePairs))) . ')';
        //$sql = 'INSERT INTO ' . $this->table . ' (' . implode(', ', array_keys($keyValuePairs)) . ') VALUES (' . implode(', ', array_map(fn($key) => ":$key", array_keys($keyValuePairs))) . ')';
        return $this->databaseCon->insert($sql, array_values($keyValuePairs));
    }

    /**
     * Changes a record in the database
     * @param mixed $keyValuePairs
     * @return bool
     */
    public function update($keyValuePairs)
    {
        $sql = 'UPDATE ' . $this->table . ' SET ' . implode(', ', array_map(fn($key) => "$key = :$key", array_keys($keyValuePairs))) . ' WHERE ' . implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($this->where)));
        return $this->databaseCon->update($sql, array_merge(array_values($keyValuePairs), array_values($this->where)));
    }

    //And a delete method

}