<?php
namespace MascotCoreVentiq\Lib;

/**
 * interface Mascot_Core_Ventiq_Interface_PostType
 * @package MascotCoreVentiq\Lib;
 */
interface Mascot_Core_Ventiq_Interface_PostType {
	/**
	 * Returns PT Key
	 * @return string
	 */
	public function getPTKey();

	/**
	 * It registers custom post type
	 */
	public function register();
}