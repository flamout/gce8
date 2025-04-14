<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once __DIR__  . '/../../../../core/php/core.inc.php';

class gce8 extends eqLogic {
    /*     * *************************Attributs****************************** */
    
  /*
   * Permet de définir les possibilités de personnalisation du widget (en cas d'utilisation de la fonction 'toHtml' par exemple)
   * Tableau multidimensionnel - exemple: array('custom' => true, 'custom::layout' => false)
	public static $_widgetPossibility = array();
   */
    
    /*     * ***********************Methode static*************************** */

    /*
     * Fonction exécutée automatiquement toutes les minutes par Jeedom
      public static function cron() {
      }
     */

    /*
     * Fonction exécutée automatiquement toutes les 5 minutes par Jeedom
      public static function cron5() {
      }
     */

    /*
     * Fonction exécutée automatiquement toutes les 10 minutes par Jeedom
      public static function cron10() {
      }
     */
    
    /*
     * Fonction exécutée automatiquement toutes les 15 minutes par Jeedom
      public static function cron15() {
      }
     */
    
    /*
     * Fonction exécutée automatiquement toutes les 30 minutes par Jeedom
      public static function cron30() {
      }
     */
    
    /*
     * Fonction exécutée automatiquement toutes les heures par Jeedom
      public static function cronHourly() {
      }
     */

    /*
     * Fonction exécutée automatiquement tous les jours par Jeedom
      public static function cronDaily() {
      }
     */



    /*     * *********************Méthodes d'instance************************* */
    
 // Fonction exécutée automatiquement avant la création de l'équipement 
    public function preInsert() {
        
    }

 // Fonction exécutée automatiquement après la création de l'équipement 
    public function postInsert() {
        
    }

 // Fonction exécutée automatiquement avant la mise à jour de l'équipement 
    public function preUpdate() {
        
    }

 // Fonction exécutée automatiquement après la mise à jour de l'équipement 
    public function postUpdate() {
        
    }

 // Fonction exécutée automatiquement avant la sauvegarde (création ou mise à jour) de l'équipement 
    public function preSave() {


    }

 // Fonction exécutée automatiquement après la sauvegarde (création ou mise à jour) de l'équipement 
    public function postSave() {

		$nmrel1 = $this->getconfiguration('nmrelais1');
        if ($nmrel1 == "") {
          	$nmrel1 = "Relais 1";
        }
        $nmrel2 = $this->getconfiguration('nmrelais2');
        if ($nmrel2 == "") {
          	$nmrel2 = "Relais 2";
        }
        $nmrel3 = $this->getconfiguration('nmrelais3');
        if ($nmrel3 == "") {
          	$nmrel3 = "Relais 3";
        }
        $nmrel4 = $this->getconfiguration('nmrelais4');
        if ($nmrel4 == "") {
          	$nmrel4 = "Relais 4";
        }
        $nmrel5 = $this->getconfiguration('nmrelais5');
        if ($nmrel5 == "") {
          	$nmrel5 = "Relais 5";
        }
        $nmrel6 = $this->getconfiguration('nmrelais6');
        if ($nmrel6 == "") {
          	$nmrel6 = "Relais 6";
        }
        $nmrel7 = $this->getconfiguration('nmrelais7');
        if ($nmrel7 == "") {
          	$nmrel7 = "Relais 7";
        }
        $nmrel8 = $this->getconfiguration('nmrelais8');
        if ($nmrel8 == "") {
          	$nmrel8 = "Relais 8";
        }
      
		$nm1 = 'Etat '.$nmrel1;
		$nm2 = 'Etat '.$nmrel2;
       	$nm3 = 'Etat '.$nmrel3;
        $nm4 = 'Etat '.$nmrel4;
        $nm5 = 'Etat '.$nmrel5;
        $nm6 = 'Etat '.$nmrel6;
        $nm7 = 'Etat '.$nmrel7;
        $nm8 = 'Etat '.$nmrel8;
      
              $cmd_list = array(
				'etr1' => array(
                  	'name' => __($nm1, __FILE__),
					'subtype' => 'binary',
					'type' => 'info',
                    'order' => 1,
				),
				'etr2' => array(
                    'name' => __($nm2, __FILE__),
					'subtype' => 'binary',
					'type' => 'info',
					'order' => 2,
				),
				'etr3' => array(
					'name' => __($nm3, __FILE__),
					'subtype' => 'binary',
					'type' => 'info',
					'order' => 3,
				),
				'etr4' => array(
					'name' => __($nm4, __FILE__),
					'subtype' => 'binary',
					'type' => 'info',
					'order' => 4,
				),
				'etr5' => array(
					'name' => __($nm5, __FILE__),
					'subtype' => 'binary',
					'type' => 'info',
					'order' => 5,
				),
				'etr6' => array(
					'name' => __($nm6, __FILE__),
					'subtype' => 'binary',
					'type' => 'info',
					'order' => 6,
				),
				'etr7' => array(
					'name' => __($nm7, __FILE__),
					'subtype' => 'binary',
					'type' => 'info',
					'order' => 7,
				),
				'etr8' => array(
					'name' => __($nm8, __FILE__),
					'subtype' => 'binary',
					'type' => 'info',
					'order' => 8,
				),
			);
      
		foreach ($this->getCmd() as $cmd) {
				$cmd->remove();
		}
      
		foreach ($cmd_list as $key => $cmd_info) {
			$cmd = $this->getCmd(null, $key);
			if (!is_object($cmd)) {
				$cmd = new gce8Cmd();
				$cmd->setLogicalId($key);
				$cmd->setIsVisible(1);
				$cmd->setOrder($cmd_info['order']);
			}
			$cmd->setName($cmd_info['name']);
			$cmd->setType($cmd_info['type']);
			$cmd->setSubType($cmd_info['subtype']);
			$cmd->setEqLogic_id($this->getId());
		#	$cmd->setEventOnly(1);
			$cmd->save();
		}
      
        $gce8cmd = $this->getCmd(null, 'r1on');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
        }
      	$gce8cmd->setName(__($nmrel1.' ON' ,__FILE__));
		$gce8cmd->setLogicalId('r1on');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r2on');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
        }
        $gce8cmd->setName(__($nmrel2.' ON',__FILE__));
		$gce8cmd->setLogicalId('r2on');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r3on');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel3.' ON',__FILE__));
		$gce8cmd->setLogicalId('r3on');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r4on');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel4.' ON',__FILE__));
		$gce8cmd->setLogicalId('r4on');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r5on');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel5.' ON',__FILE__));
		$gce8cmd->setLogicalId('r5on');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r6on');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel6.' ON',__FILE__));
		$gce8cmd->setLogicalId('r6on');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r7on');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel7.' ON',__FILE__));
		$gce8cmd->setLogicalId('r7on');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r8on');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel8.' ON',__FILE__));
		$gce8cmd->setLogicalId('r8on');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();



    	$gce8cmd = $this->getCmd(null, 'r1off');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel1.' OFF',__FILE__));
		$gce8cmd->setLogicalId('r1off');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_OFF');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r2off');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel2.' OFF',__FILE__));
		$gce8cmd->setLogicalId('r2off');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_OFF');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r3off');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel3.' OFF',__FILE__));
		$gce8cmd->setLogicalId('r3off');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_OFF');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r4off');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel4.' OFF',__FILE__));
		$gce8cmd->setLogicalId('r4off');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_OFF');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r5off');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel5.' OFF',__FILE__));
		$gce8cmd->setLogicalId('r5off');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_OFF');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r6off');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel6.' OFF',__FILE__));
		$gce8cmd->setLogicalId('r6off');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_OFF');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r7off');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel7.' OFF',__FILE__));
		$gce8cmd->setLogicalId('r7off');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_OFF');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r8off');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel8.' OFF',__FILE__));
		$gce8cmd->setLogicalId('r8off');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_OFF');
		$gce8cmd->save();



    	$gce8cmd = $this->getCmd(null, 'r1imp');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel1.' IMPULSION',__FILE__));
		$gce8cmd->setLogicalId('r1imp');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r2imp');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel2.' IMPULSION',__FILE__));
		$gce8cmd->setLogicalId('r2imp');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r3imp');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel3.' IMPULSION',__FILE__));
		$gce8cmd->setLogicalId('r3imp');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r4imp');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel4.' IMPULSION',__FILE__));
		$gce8cmd->setLogicalId('r4imp');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r5imp');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel5.' IMPULSION',__FILE__));
		$gce8cmd->setLogicalId('r5imp');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r6imp');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel6.' IMPULSION',__FILE__));
		$gce8cmd->setLogicalId('r6imp');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r7imp');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel7.' IMPULSION',__FILE__));
		$gce8cmd->setLogicalId('r7imp');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    	$gce8cmd = $this->getCmd(null, 'r8imp');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
		}
        $gce8cmd->setName(__($nmrel8.' IMPULSION',__FILE__));
		$gce8cmd->setLogicalId('r8imp');
	    $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();


      	$refresh = $this->getCmd(null, 'refresh');
		if (!is_object($refresh)) {
			$refresh = new gce8Cmd();
			$refresh->setName(__('Rafraichir', __FILE__));
		}
		$refresh->setEqLogic_id($this->getId());
		$refresh->setLogicalId('refresh');
		$refresh->setType('action');
		$refresh->setSubType('other');
		$refresh->setOrder(99);
		$refresh->save();

		$this->majInfo();

    
    }
		
		public function majinfo() {
			include "php_serial.class.php";      
			// Let's start the class
			$serial = new phpSerial;
			// First we must specify the device. This works on both linux and windows (if
			// your linux serial device is /dev/ttyS0 for COM1, etc)
			$serial->deviceSet($this->getconfiguration('port_carte'));
			$nom_carte=$this->getconfiguration('name');
			$nbrelais=$this->getconfiguration('nb_relais');
			// We can change the baud rate, parity, length, stop bits, flow control
/*      	$serial->confBaudRate(9600);
			$serial->confParity("none");
			$serial->confCharacterLength(8);
			$serial->confStopBits(1);
			$serial->confFlowControl("none");
			// Then we need to open it
*/        	$serial->deviceOpen();

// To write into
            if ($nbrelais=="8") {
				do {
					$serial->sendMessage("?RLY"); 
					sleep (0.200); 
            		$read = $serial->readPort(10);
            // If you want to change the configuration, the device must be closed
					} while (substr($read,0,1)=="0" || substr($read,0,1)=="1");
				$serial->deviceClose();

				// traitement du retour
				
				$listecomm=eqlogic::byid($this->getid());
				$nomcomm="";
				foreach($listecomm->getcmd() as $comm) {
					$nomcomm = $comm->getlogicalid();    
					if ( $nomcomm =='etr1') {
						$valrel=substr($read,1,1);
						$comm->setvalue ($valrel);
						$comm->save();
						$comm->event($valrel);
					}
					if ( $nomcomm =='etr2') {
						$valrel=substr($read,2,1);
						$comm->setvalue ($valrel);
						$comm->save();
						$comm->event($valrel);
					}
					if ( $nomcomm =='etr3') {
						$valrel=substr($read,3,1);
						$comm->setvalue ($valrel);
						$comm->save();
						$comm->event($valrel);
					}
					if ( $nomcomm =='etr4') {
						$valrel=substr($read,4,1);
						$comm->setvalue ($valrel);
						$comm->save();
						$comm->event($valrel);
					}
					if ( $nomcomm =='etr5') {
						$valrel=substr($read,5,1);
						$comm->setvalue ($valrel);
						$comm->save();
						$comm->event($valrel);
					}
					if ( $nomcomm =='etr6') {
						$valrel=substr($read,6,1);
						$comm->setvalue ($valrel);
						$comm->save();
						$comm->event($valrel);
					}
					if ( $nomcomm =='etr7') {
						$valrel=substr($read,7,1);
						$comm->setvalue ($valrel);
						$comm->save();
						$comm->event($valrel);
					}
					if ( $nomcomm =='etr8') {
						$valrel=substr($read,8,1);
						$comm->setvalue ($valrel);
						$comm->save();
						$comm->event($valrel);
					}
				}     
	
			}
			else {
				do {
					$serial->sendMessage("?"); 
					sleep (0.200); 
            		$read = $serial->readPort(10);
            // If you want to change the configuration, the device must be closed
					} while (substr($read,0,1)=="0" || substr($read,0,1)=="1" || substr($read,0,1)=="S");
				$serial->deviceClose();
			// traitement du retour
				
				$listecomm=eqlogic::byid($this->getid());
				$nomcomm="";
				foreach($listecomm->getcmd() as $comm) {
					$nomcomm = $comm->getlogicalid();    
					if ( $nomcomm =='etr1') {
						$valrel=substr($read,1,1);
						$comm->setvalue ($valrel);
						$comm->save();
						$comm->event($valrel)
					}
					if ( $nomcomm =='etr2') {
						$valrel=substr($read,2,1);
						$comm->setvalue ($valrel);
						$comm->save();
						$comm->event($valrel);
					}
					if ($nbrelais=="4") {
						if ( $nomcomm =='etr3') {
							$valrel=substr($read,3,1);
							$comm->setvalue ($valrel);
							$comm->save();
							$comm->event($valrel);
						}
						if ( $nomcomm =='etr4') {
							$valrel=substr($read,4,1);
							$comm->setvalue ($valrel);
							$comm->save();
							$comm->event($valrel);
						}
					}
				}
            // Or to read from
            }
		
		
		public function actionrelais ($action,$num_relais) {
        

			$port_carte=$this->getconfiguration('port_carte');
			$nom_carte=$this->getconfiguration('name');
			$duree_imp=$this->getconfiguration('duree_impulsion');
			$nbrelais=$this->getconfiguration('nb_relais');

			if ($action=="on") {
				if ($nbrelais=="8") {
					$mess='echo RLY'.$num_relais.'1 >'.$port_carte; 
				}
				else {
					$mess='echo S'.$num_relais.'1 >'.$port_carte;
				}
				exec ($mess);
			//print $mess.$port_carte;
			}

			if ($action=="off") {
				if ($nbrelais=="8") {
					$mess='echo RLY'.$num_relais.'0 >'.$port_carte; 
				}
				else {
					$mess='echo S'.$num_relais.'0 >'.$port_carte;
				}
				exec ($mess);
			}

			if ($action=="imp") {
				if ($nbrelais=="8") {
					$mess='echo RLY'.$num_relais.'1 >'.$port_carte; 
				}
				else {
					$mess='echo S'.$num_relais.'1 >'.$port_carte;
				}
				exec ($mess);
				usleep($duree_imp*1000000);
				if ($nbrelais=="8") {
					$mess='echo RLY'.$num_relais.'0 >'.$port_carte; 
				}
				else {
					$mess='echo S'.$num_relais.'0 >'.$port_carte;
				}
				exec ($mess);
			}
        
   
		}

    
 // Fonction exécutée automatiquement avant la suppression de l'équipement 
    public function preRemove() {
        
    }

 // Fonction exécutée automatiquement après la suppression de l'équipement 
    public function postRemove() {
        

		
    }

    /*
     * Non obligatoire : permet de modifier l'affichage du widget (également utilisable par les commandes)
      public function toHtml($_version = 'dashboard') {

      }
     */

    /*
     * Non obligatoire : permet de déclencher une action après modification de variable de configuration
    public static function postConfig_<Variable>() {
    }
     */

    /*
     * Non obligatoire : permet de déclencher une action avant modification de variable de configuration
    public static function preConfig_<Variable>() {
    }
     */

    /*     * **********************Getteur Setteur*************************** */
}

class gce8Cmd extends cmd {
    /*     * *************************Attributs****************************** */
    
    /*
      public static $_widgetPossibility = array();
    */
    
    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    /*
     * Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
      public function dontRemoveCmd() {
      return true;
      }
     */

  // Exécution d'une commande  
     public function execute($_options = array()) {
		$eqLogic = $this->getEqLogic();
        switch ($this->getlogicalid()) {
            case 'refresh' :
    	    $eqLogic->majinfo();
            break; 
            
            case 'r1on' : 
            $eqLogic->actionrelais("on","1");    
            $eqLogic->majinfo();
            
            break;

            case 'r1off' : 
            $eqLogic->actionrelais ("off","1");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r1imp' : 
            $eqLogic->actionrelais ("imp","1");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r2on' : 
            $eqLogic->actionrelais("on","2");    
            $eqLogic->majinfo();
            
            break;

            case 'r2off' : 
            $eqLogic->actionrelais ("off","2");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r2imp' : 
            $eqLogic->actionrelais ("imp","2");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r3on' : 
            $eqLogic->actionrelais("on","3");    
            $eqLogic->majinfo();
            
            break;

            case 'r3off' : 
            $eqLogic->actionrelais ("off","3");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r3imp' : 
            $eqLogic->actionrelais ("imp","3");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r4on' : 
            $eqLogic->actionrelais("on","4");    
            $eqLogic->majinfo();
            
            break;

            case 'r4off' : 
            $eqLogic->actionrelais ("off","4");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r4imp' : 
            $eqLogic->actionrelais ("imp","4");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r5on' : 
            $eqLogic->actionrelais("on","5");    
            $eqLogic->majinfo();
            
            break;

            case 'r5off' : 
            $eqLogic->actionrelais ("off","5");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r5imp' : 
            $eqLogic->actionrelais ("imp","5");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r6on' : 
            $eqLogic->actionrelais("on","6");    
            $eqLogic->majinfo();
            
            break;

            case 'r6off' : 
            $eqLogic->actionrelais ("off","6");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r6imp' : 
            $eqLogic->actionrelais ("imp","6");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r7on' : 
            $eqLogic->actionrelais("on","7");    
            $eqLogic->majinfo();
            
            break;

            case 'r7off' : 
            $eqLogic->actionrelais ("off","7");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r7imp' : 
            $eqLogic->actionrelais ("imp","7");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r8on' : 
            $eqLogic->actionrelais("on","8");    
            $eqLogic->majinfo();
            
            break;

            case 'r8off' : 
            $eqLogic->actionrelais ("off","8");    
    	    $eqLogic->majinfo();
            
            break;

            case 'r8imp' : 
            $eqLogic->actionrelais ("imp","8");    
    	    $eqLogic->majinfo();
            
            break;

        }    
        
     }

    /*     * **********************Getteur Setteur*************************** */
}