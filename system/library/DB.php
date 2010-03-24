<?php

class DB extends PDO
{
    private $dbh;

    public function __construct()
    {
        // load the config object
        $config = Load::library('Config');

        // get the connection name based off the enviroment
        $connection = $config->getEnvironment();

        // load the connection details
        $details = $config->get('connections.' . $connection);

        try
        {
            // instantiate the PDO object
            $this->dbh = parent::__construct($details[0], $details[1], $details[2]);
        }
        catch (PDOException $e)
        {
            if ($config->isDev())
            {
                // throw the original exception
                throw new Exception('PDO exception caught: ' . $e->getMessage());
            }
            else
            {              
                // throw the generic DB exception
                throw new Exception('Database connection error');
            }
        }

        // set the PDO error mode to exception
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // return the DB handle
        return $this->dbh;
    }

	public function hash($str)
	{
		$str  = trim($str);
		$salt = '15b29ffdce66e10527a65bc6d71ad94d';

		return sha1($salt.md5($str));
	}
}

// EOF
