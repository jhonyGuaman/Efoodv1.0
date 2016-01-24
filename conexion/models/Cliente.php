<?php
require_once("conexion/db/database.php");
require_once("conexion/interfaces/ICliente.php");
 
class Cliente implements ICliente
{
	private $con;
    private $id;
    private $idpersona;
    
	public function __construct(Database $db)
	{
		$this->con = new $db;
	}
 
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setIdpersona($idpersona)
    {
        $this->idpersona = $idpersona;
    }
 
    
	//insertamos usuarios en una tabla con postgreSql
	public function save()
	{
		try{
			$query = $this->con->prepare('INSERT INTO cliente (idPersona) values (?)');
            $query->bindParam(1, $this->idpersona, PDO::PARAM_STR);
			$query->execute();
			$this->con->close();
		}
        catch(PDOException $e)
        {
	        echo  $e->getMessage();
	    }
	}
 
    public function update()
	{
		try{
			$query = $this->con->prepare('UPDATE cliente SET idPersona = ? WHERE id = ?');
			$query->bindParam(1, $this->idpersona, PDO::PARAM_STR);
			$query->bindParam(3, $this->id, PDO::PARAM_INT);
			$query->execute();
			$this->con->close();
		}
        catch(PDOException $e)
        {
	        echo  $e->getMessage();
	    }
	}
 
	//obtenemos usuarios de una tabla con postgreSql
	public function get()
	{
		try{
            if(is_int($this->id))
            {
                $query = $this->con->prepare('SELECT * FROM cliente WHERE id = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_INT);
                $query->execute();
    			$this->con->close();
    			return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM cliente');
    			$query->execute();
    			$this->con->close();
    			return $query->fetchAll(PDO::FETCH_OBJ);
            }
		}
        catch(PDOException $e)
        {
	        echo  $e->getMessage();
	    }
	}
 
    public function delete()
    {
        try{
            $query = $this->con->prepare('DELETE FROM cliente WHERE id = ?');
            $query->bindParam(1, $this->id, PDO::PARAM_INT);
            $query->execute();
            $this->con->close();
            return true;
        }
        catch(PDOException $e)
        {
            echo  $e->getMessage();
        }
    }
 
    public static function baseurl()
    {
         return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "/Efood-v1.0/";
    }
 
    public function checkUser($client)
    {
        if( ! $client )
        {
            header("Location:" . User::baseurl() . "Efood-v1/index.php");
        }
    }
}
?>