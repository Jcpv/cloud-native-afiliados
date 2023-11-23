<?php
namespace Controller;

use Exception;
use Lib\Auxiliar;
use Model\Conexion\BD;

class ctrlUIFS
{
    public static $id = '';
    public static $Query = '';
    public static $Fields = '*';
    public static $Table = 'NombredeTabla';
    public static $Where = '';
    public static $InnerJ = '';
    public static $Sufijo = '';
    public static $Estado = '';
    public static $camposCli = '';
    public static $ordenar = '';
    public static $agrupar = '';
    public static $nameBD = '';

    public static $values = '';
    public static $varPOST = '';
    public static $Resultado = [
        "descripcion" => '',
        "numReg" => '',
        "datos" => [],
        "campos" => [],
        "otrainf" => []
    ];
    private static $edoRevision = true;

    public static function iniciarCtrlSql()
    {
        self::$id = '';
        self::$Query = '';
        self::$Fields = '*';
        self::$Table = '';
        self::$Where = '';
        self::$InnerJ = '';
        self::$Sufijo = '';
        self::$Estado = '';
        self::$camposCli = '';
        self::$ordenar = '';
        self::$agrupar = '';
        self::$nameBD = '';

        self::$values = '';
        self::$varPOST = '';
        self::$Resultado = [
            "descripcion" => '',
            "numReg" => '',
            "datos" => [],
            "campos" => [],
            "otrainf" => []
        ];
    }

    public static function setDatosPost($datosForm)
    {
        self::$varPOST = $datosForm;
    }

    public static function setId($args, $nombreParametroId = '')
    {
        try {
            $id = isset($args[$nombreParametroId]) ? (($args[$nombreParametroId]) * 1) : '0';
            if ($id < 0)
                $id = 0;
        } catch (Exception $e) {
            $id = 0;
        }

        self::$id = $id;
    }

    public static function setTabla($NameTable = '')
    {
        self::$Table = $NameTable;
    }

    public static function setCamposBD($Campos = '')
    {
        self::$Fields = $Campos;
    }

    public static function setResultado($errorClave, $errorDescrip)
    {

        if ($errorClave == 'descripcion') {
            self::$Resultado["descripcion"] = $errorDescrip;
        }
        if ($errorClave == 'numReg') {
            self::$Resultado["numReg"] = $errorDescrip;
        }
        if ($errorClave == 'datos') {
            self::$Resultado["datos"] = $errorDescrip;
        }
    }

    public static function getResultado()
    {
        return self::$Resultado;
    }

    public static function verDato($TipoRes = '')
    {
        self::creaQueryRead();
        self::ejecutaSql('9991', $TipoRes);
    }

    public static function guardarDato()
    {
        if (self::$id > 0) {
            self::creaQueryUpdate();
            self::ejecutaSql('9998');
        } else {
            self::creaQueryInsert();
            self::ejecutaSql('9999');
        }
    }

    public static function borrarDato()
    {
        self::creaQueryDelete();
        self::ejecutaSql('9996');
    }

    static function ejecutaSql($tipoSql = '',  $TipoRes = '')
    {
        BD::ejecutaSql(self::$Query, $tipoSql, $TipoRes, self::$nameBD);

        self::$Resultado = [
            "descripcion" => BD::getStatus()['descripcion'],
            "numReg" => BD::getStatus()['numReg'],
            "datos" => BD::getData(),
        ];

        if ($tipoSql == '9999') {
            self::$Resultado["id_registro"] = BD::ultId();
        }
    }

    static private function creaQueryRead()
    {
        self::$Query = 'SELECT ' . (self::$Fields) . ' FROM ' . (self::$Table);
        self::$Query .= (empty(self::$Where)) ? '' : ' WHERE (' . (self::$Where) . ')';
        self::$Query .= (empty(self::$ordenar)) ? '' : ' ORDER BY ' . (self::$ordenar) . '';
    }

    static public function creaQueryUpdate()
    {
        if (self::$edoRevision) {
            self::$Query = 'UPDATE ' . (self::$Table) . ' SET ' . (self::$Fields);
            self::$Query .= (empty(self::$Where)) ? '' : ' WHERE (' . (self::$Where) . ')';
        }
    }

    static public function creaQueryInsert()
    {
        self::extraeDatoCliente();
        if (self::$edoRevision) {
            self::$Query = 'INSERT INTO ';
            self::$Query .= self::$Table;
            self::$Query .= '(' . self::$Fields . ')';
            self::$Query .= ' VALUES ';
            self::$Query .= "(" . self::$values . ")";
            self::$Query .= '';
        }
    }

    static public function creaQueryDelete()
    {
        self::$Query = 'DELETE FROM ';
        self::$Query .= self::$Table;
        self::$Query .= ' WHERE (' . (self::$Where) . ')';
    }

    static public function extraeDatoCliente()
    {
        self::$edoRevision = true;
        $auxResultado = '';

        $auxCampoBD = explode(",", self::$Fields);
        $contador = 0;

        if (count($auxCampoBD) <> count(self::$camposCli)) {
            self::setResultado(
                "descripcion",
                "Los campos de la base de datos no coinciden con los campos de entrada del cliente"
            );

            return;
        }

        $valorInicial = '';
        foreach (self::$camposCli as $nomCampo => $cadValidador) {
            $valorInicial = substr($cadValidador, 1, strlen($cadValidador));

            if (self::$id > 0) {
                $auxSqlDatos[] = "" . $auxCampoBD[$contador] . " = '" . $valorInicial . "'";
            } else {
                $auxSqlDatos[] = "'" . $valorInicial . "'";
            }

            $contador += 1;
        }

        if (self::$edoRevision) {
            if (self::$id > 0)
                self::$Fields = implode(',', $auxSqlDatos);
            else
                self::$values = implode(',', $auxSqlDatos);
        } else {
            self::$Resultado = [
                "descripcion" => 'Error al crear la consulta [' . $auxResultado . "]",
                "numReg" => '0',
                "datos" => []
            ];
        }
    }
}
