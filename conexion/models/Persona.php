<?php
require_once("conexion/db/database.php");
require_once("conexion/interfaces/IPersona.php");
 
class Persona implements IPersona
{
	private $con;
    private $id;
    private $nombre;
    private $apellidoPat;
    private $apellidoMat;
    private $cedula;
    private $telefono;
    private $direccion;

	public function __construct(Database $db)
	{
		$this->con = new $db;
	}
 
    public function setId($id)                   {$this->id = $id;                     }
    public function setNombre($nombre)           { $this->nombre = $nombre;            }
    public function setApellidoPat($apellidopat) { $this->apellidoPat = $apellidopat;  }
    public function setApellidoMat($apellidoMat) { $this->apellidoMat = $apellidoMat;  }
    public function setCedula     ($cedula)      { $this->cedula = $cedula;            }
    public function setTelefono   ($telefono)    { $this->telfono = $telefono;         }
    public function setDireccion  ($direccion)   { $this->direccion = $direccion;      }     


	//insertamos usuarios en una tabla con postgreSql
	public function save()
	{
		try{
			$query = $this->con->prepare('INSERT INTO personas (nombre,apellidoPat,apellidoMat,cedula,telefono,direccion) values (?,?,?,?,?,?)');
            $query->bindParam(1, $this->nombre, PDO::PARAM_STR);
            $query->bindParam(2, $this->apellidoPat, PDO::PARAM_STR);
            $query->bindParam(3, $this->apellidoMat, PDO::PARAM_STR);
            $query->bindParam(4, $this->cedula, PDO::PARAM_STR);
            $query->bindParam(5, $this->telefono, PDO::PARAM_STR);
            $query->bindParam(6, $this->direccion, PDO::PARAM_STR);
            
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
			$query = $this->con->prepare('UPDATE cliente SET nombre = ?, apellidoPat = ? , apellidoMat = ? , cedula = ? , telefono = ?, direccion = ? WHERE id = ?');
			$query->bindParam(1, $this->nombre, PDO::PARAM_STR);
            $query->bindParam(2, $this->apellidoPat, PDO::PARAM_STR);
            $query->bindParam(3, $this->apellidoMat, PDO::PARAM_STR);
            $query->bindParam(4, $this->cedula, PDO::PARAM_STR);
            $query->bindParam(5, $this->telefono, PDO::PARAM_STR);
            $query->bindParam(6, $this->direccion, PDO::PARAM_STR);
			$query->bindParam(7, $this->id, PDO::PARAM_INT);
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
                $query = $this->con->prepare('SELECT * FROM personas WHERE id = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_INT);
                $query->execute();
    			$this->con->close();
    			return $query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                $query = $this->con->prepare('SELECT * FROM personas');
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
            $query = $this->con->prepare('DELETE FROM personas WHERE id = ?');
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
         return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "htdocs/Efood-v1.0/";
    }
 
    public function checkUser($client)
    {
        if( ! $client )
        {
            header("Location:" . User::baseurl() . "Efood-v1/index.php");
        }
    }
}