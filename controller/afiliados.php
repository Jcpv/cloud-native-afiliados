<?php
namespace Controller\Estadistica\Gestor;

use Controller\ctrlUIFS;

class ctrlAfiliados extends ctrlUIFS
{
    protected $container;
    public function __invoke($req, $resp, $args)
    {
        self::Datos($args);
    }

    private static function setConfigController($args)
    {
        self::$Table = 'mx_afiliados_2020v';
        self::setId($args, 'id');
    }

    public static function Datos($args)
    {   //Igual a INVOKE 
        self::setConfigController($args);
        self::setId($args, 'id');

        $id = self::$id;
        self::$Where = ($id > 0) ? "(idarea = $id)" : '';

        self::verDato($args);
        self::getResultado();
    }

    public static function GuardarANtes($req, $resp, $args)
    {
        self::setConfigController($args);
        self::setDatosPost($req->getParsedBody());

        if (self::$id > 0)
            self::regActualiza($req);
        else
            self::regNuevo($req);

        self::guardarDato();
        self::getResultado();
    }

    private static function regActualiza($req)
    {
        self::setDatosPost($req->getParsedBody());

        $auxId = self::$id;

        Archivo::moveFile(self::$varPOST['txtTmp'], "academico/$auxId", true);
        $auxArchivo = (Archivo::estatus()) ? Archivo::urlFile() : '';

        self::setCamposBD(' fecha, area, usuario, descripcion, 
        estatus, observacion, tipapoyo');

        self::$camposCli = [
            "txt_fecha" => "date:10|",
            "sel_area" => "int:4|",
            "txt_usuario" => "string:100|",
            "txt_descripcion" => "string:500|",
            
            "sel_estatus" => "int:2|",
            "txt_observacion" => "string:500|",
            "sel_tipapoyo" => "int:4|",
        ];

        if (!empty($auxArchivo)) { // Si se carga
            self::$Fields .= ', doctos';
            self::$camposCli['doctos'] = "=$auxArchivo";
        }

        self::$Where = "id = " . self::$id . "";
    }

    public static function regNuevo($req, $resp, $args)
    {
        self::setConfigController($args);
        self::setDatosPost($req->getParsedBody());

        $datoBody = $req->getParsedBody();

        self::setCamposBD('id, id_ent, id_mun , sex, gpo_edad,
         mun_frontera, afiliados, personas');

        self::$camposCli = [
            "id" => "=0",
            "id_ent" => "=" . $datoBody['id_ent'],
            "id_mun" => "=" . $datoBody['id_mun'],
            "sex" => "=" . $datoBody['sex'],
            "gpo_edad" => "=" . $datoBody['gpo_edad'],
            "mun_frontera" => "=" . $datoBody['mun_frontera'],
            "afiliados" => "=" . $datoBody['afiliados'],
            "personas" => "=" . $datoBody['personas'],
        ];

        self::guardarDato();
        self::getResultado();
    }


    public static function datosAfiliados($req, $resp, $args)
    {
        self::$Table = 'mx_afiliados_2020v';
        self::setId($args, 'id');

        $id = self::$id;
        self::$Where = ($id > 0) ? "(id = $id)" : '';
        self::verDato($args);
        self::getResultado();
    }


    public static function borrarAfiliados($req, $resp, $args)
    {
        self::setConfigController($args);
        self::setId($args, 'id');

        $id = self::$id;
        self::$Where = "(id = $id)";

        self::borrarDato($args);
        self::getResultado();
    }
}
