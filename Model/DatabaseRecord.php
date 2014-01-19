<?php

class DatabaseRecord {
    const TABLE_NAME = 'abstract';

    const CREATION_DATE_KEY = 'creation_date';
    const ID_KEY = 'id';

    /* @var $db PDO */
    protected $db;

    function __construct($db) {
        $this->db = $db;
    }

    public function getCreationDate() {
        return static::CREATION_DATE_KEY;
    }

    public static function objectForId($db, $id) {
        return self::objectForSqlStatement($db, 'SELECT * FROM '.static::TABLE_NAME.' WHERE id='.$id);
    }

    protected static function objectForSqlStatement($db, $sql_statement_string) {
        $objects = self::objectsForSqlStatement($db, $sql_statement_string);

        if (is_array($objects) && count($objects)) {
            return $objects[0];
        }

        return null;
    }

    protected static function objectsForSqlStatement($db, $sql_statement_string) {
        /* @var $db PDO */
        $query_result = $db->query($sql_statement_string);
        return static::objectsArrayUsingPdoStatement($db, $query_result);
    }

    protected static function objectsArrayUsingPdoStatement($db, $pdo_statement) {
        $array = array();
        foreach ($pdo_statement as $row) {
            $object = static::objectUsingPdoStatementRow($db, $row);
            array_push($array, $object);
        }
        return $array;
    }

    protected static function objectUsingPdoStatementRow($db, $row)
    {
        trigger_error('calling abstract method');
        //abstract
        return null;
    }

    protected static function resultsForSqlStatement($db, $sql_statement) {
        /* @var $db PDO */
        $query_result = $db->query($sql_statement);

        $array = array();
        foreach ($query_result as $row) {
            array_push($array, $row);
        }

        return $array;
    }

    protected static function resultForSqlStatement($db, $sql_statement) {
        $results = self::resultsForSqlStatement($db, $sql_statement);

        if (is_array($results) && count($results)) {
            if (!is_array($results[0])) {
                return $results[0];
            } else {
                return $results[0][0];
            }
        }

        return null;
    }
}