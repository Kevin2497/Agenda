<?php 
include_once("AccesoDatos.php");

class Usuario {
	private $id = 0;
	private $clave = "";
	private $contra = "";
	private $nombre = "";
	private $tipo = ""; // 'admin' o 'usuario'
	private $oAD = null;

	public function setClave($valor) { $this->clave = $valor; }
	public function setContra($valor) { $this->contra = $valor; }

	public function getNombre() { return $this->nombre; }
	public function getTipo() { return $this->tipo; }
	public function getId() { return $this->id; }

	public function buscarClaveYContra() {
		if (empty($this->clave) || empty($this->contra)) {
			throw new Exception("Faltan datos.");
		}
		
		$oAD = new AccesoDatos();
		if ($oAD->conectar()) {
			$sQuery = "SELECT id, nombre, tipo FROM usuarios 
			           WHERE clave = '$this->clave' AND contra = '$this->contra'";
			$arrRS = $oAD->ejecutarConsulta($sQuery);
			$oAD->desconectar();

			if ($arrRS != null) {
				$this->id = $arrRS[0][0];
				$this->nombre = $arrRS[0][1];
				$this->tipo = $arrRS[0][2];
				return true;
			}
		}
		return false;
	}
}
?>
