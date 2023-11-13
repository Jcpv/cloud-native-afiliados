<?php
namespace Model\Conexion;

use \PDO;
use Exception;

class BD
{
   static private $status_num = '';
   static private $status_des = '';
   static private $status_num_sql = '';
   static private $DatosX = '';
   static public $rowCount = 0;
   static public $ultId = 0;

   static public function conectar($nameBD = '')
   {
      $Enlace = NULL;

      $USER = getenv('MYSQL_USER');
      $PWD = getenv('MYSQL_PWD');
      $PORT = getenv('MYSQL_PORT');
      $HOST = getenv('MYSQL_HOST');
      $DB = getenv('MYSQL_DB');

      try {
         $Enlace = new PDO(
            "mysql: host=" . $HOST  . " port=" . $PORT . ";  dbname=" . $DB,
            $USER,
            $PWD
         );

         $Enlace->query("SET NAMES 'utf8'");
      } catch (Exception $e) {
         echo 'Error: ',  $e->getMessage(), " (al conectar a la base de datos)\n";
         exit();
      }
      return $Enlace;
   }

   static public function ejecutaSql($CadenaSql = '', $TipoSql = '', $TipoRes = '', $nameBD = '')
   {
      $ConsultaX = self::conectar($nameBD);
      $auxDescripcion = "$TipoSql ";

      if ($TipoSql == '9991') {
         $auxDescripcion = 'GET de datos';
      } else  if ($TipoSql == '9999') {
         $auxDescripcion = 'Registro creado';
      }

      $AuxConec = $ConsultaX->query($CadenaSql, PDO::FETCH_ASSOC);

      $TipoSql = (empty($TipoSql)) ? '0000' : $TipoSql;
      self::$status_num_sql = $ConsultaX->errorInfo()[0];

      if ($ConsultaX->errorInfo()[0] == '00000') {
         self::$status_num = $TipoSql;
         self::$status_des = $auxDescripcion;
         self::$DatosX = $AuxConec->fetchAll();
         self::$rowCount = $AuxConec->rowCount();
         self::$ultId = $ConsultaX->lastInsertId();
      } else {
         self::$status_num = '101';
         self::$status_des = "[(" . $ConsultaX->errorInfo()[2] . ")] [" . $CadenaSql . "]";
         self::$DatosX = '';
         self::$rowCount = -1;
         self::$ultId = 0;
      }

      self::$status_num = ($ConsultaX->errorInfo()[0] == '00000') ? $TipoSql : '101';
      self::$status_des = ($ConsultaX->errorInfo()[0] == '00000') ? "$auxDescripcion" : $ConsultaX->errorInfo()[2];

      return $ConsultaX;
   }

   static public function getStatus()
   {
      return [
         "infoNum" => self::$status_num,
         "descripcion" => self::$status_des,
         "numReg" => self::$rowCount,
      ];
   }

   static public function getStatusNum()
   {
      return self::$status_num;
   }

   static public function getData()
   {
      return self::$DatosX;
   }

   static public function rowCount()
   {
      return self::$rowCount;
   }

   static public function ultId()
   {
      return self::$ultId;
   }
}
