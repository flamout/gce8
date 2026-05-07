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

  /*
  * Permet de crypter/décrypter automatiquement des champs de configuration du plugin
  * Exemple : "param1" & "param2" seront cryptés mais pas "param3"
  public static $_encryptConfigKey = array('param1', 'param2');
  */

  /*     * ***********************Methode static*************************** */

  /*
  * Fonction exécutée automatiquement toutes les minutes par Jeedom
  public static function cron() {}
  */

  /*
  * Fonction exécutée automatiquement toutes les 5 minutes par Jeedom
  public static function cron5() {}
  */

  /*
  * Fonction exécutée automatiquement toutes les 10 minutes par Jeedom
  public static function cron10() {}
  */

  /*
  * Fonction exécutée automatiquement toutes les 15 minutes par Jeedom
  public static function cron15() {}
  */

  /*
  * Fonction exécutée automatiquement toutes les 30 minutes par Jeedom
  public static function cron30() {}
  */

  /*
  * Fonction exécutée automatiquement toutes les heures par Jeedom
  public static function cronHourly() {}
  */

  /*
  * Fonction exécutée automatiquement tous les jours par Jeedom
  public static function cronDaily() {}
  */
  
  /*
  * Permet de déclencher une action avant modification d'une variable de configuration du plugin
  * Exemple avec la variable "param3"
  public static function preConfig_param3( $value ) {
    // do some checks or modify on $value
    return $value;
  }
  */

  /*
  * Permet de déclencher une action après modification d'une variable de configuration du plugin
  * Exemple avec la variable "param3"
  public static function postConfig_param3($value) {
    // no return value
  }
  */

  /*
   * Permet d'indiquer des éléments supplémentaires à remonter dans les informations de configuration
   * lors de la création semi-automatique d'un post sur le forum community
   public static function getConfigForCommunity() {
      // Cette function doit retourner des infos complémentataires sous la forme d'un
      // string contenant les infos formatées en HTML.
      return "les infos essentiel de mon plugin";
   }
   */

  /*     * *********************Méthodes d'instance************************* */

  // Fonction de mise a jour 

 	public function majinfo() {
		include "php_serial.class.php";      
		// Let's start the class
		$serial = new phpSerial;
		// First we must specify the device. This works on both linux and windows (if
		// your linux serial device is /dev/ttyS0 for COM1, etc)
		$serial->deviceSet($this->getconfiguration('port_carte'));
		$nom_carte=$this->getconfiguration('name');
		$nbrelais=$this->getconfiguration('nb_relais');
		  /* We can change the baud rate, parity, length, stop bits, flow control
      $serial->confBaudRate(9600);
			$serial->confParity("none");
			$serial->confCharacterLength(8);
			$serial->confStopBits(1);
			$serial->confFlowControl("none");
			Then we need to open it
      */ 
		$serial->deviceOpen();

		 // To write into
    if ($nbrelais=="8") { // traitement pour carte 8 relais 
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
		
		/* else {  // traitement pour la carte 4 relais 
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
		}*/
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
    
    $refresh = $this->getCmd(null, 'refresh');
    if (!is_object($refresh)) {
      $refresh = new gce8Cmd();
      $refresh->setName(__('Rafraichir', __FILE__));
    }
    $refresh->setEqLogic_id($this->getId());
    $refresh->setLogicalId('refresh');
    $refresh->setType('action');
    $refresh->setSubType('other');
    $refresh->save();

   
      
    // Affectation des noms des relais 
    $nmrel1 = $this->getconfiguration('nmrelais1');
    
    //if ($nmrel1 == "") {
    //  $nmrel1 = "Relais 1";
   // }

   // test des variables 
       $duree=$this->getConfiguration('duree_impulsion');
    $por = $this->getConfiguration('port_carte');
    $brel = $this->getConfiguration('nb_relais');
   log::add ('gce8','info',$por);
    log::add('gce8','info',$duree);  
      log::add('gce8','info',$brel);

       log::add ('gce8','info',$nmrel1);

     // commandes ON

    $gce8cmd = $this->getCmd(null, 'r1on');
		if (!is_object($gce8cmd)) {
			$gce8cmd = new gce8cmd();
        }
    $nmrel1 = $nmrel1.' ON';
       log::add ('gce8','info',$nmrel1);
    $gce8cmd->setName(__($nmrel1, __FILE__));
		$gce8cmd->setLogicalId('r1on');
	  $gce8cmd->setEqLogic_id($this->getId());
		$gce8cmd->setType('action');
		$gce8cmd->setSubType('other');	
		$gce8cmd->setDisplay('generic_type','LIGHT_ON');
		$gce8cmd->save();

    // Commandes OFF

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

    // Commandes Impulsion

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

    // Affectation des noms de retour d'état 

    $nm1 = 'Etat '.$nmrel1;
		$nm2 = 'Etat '.$nmrel2;
    $nm3 = 'Etat '.$nmrel3;
    $nm4 = 'Etat '.$nmrel4;
    $nm5 = 'Etat '.$nmrel5;
    $nm6 = 'Etat '.$nmrel6;
    $nm7 = 'Etat '.$nmrel7;
    $nm8 = 'Etat '.$nmrel8;

    // Liste des commandes d'info

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





  }

  // Fonction exécutée automatiquement avant la suppression de l'équipement
  public function preRemove() {
  }

  // Fonction exécutée automatiquement après la suppression de l'équipement
  public function postRemove() {
  }

  /*
  * Permet de crypter/décrypter automatiquement des champs de configuration des équipements
  * Exemple avec le champ "Mot de passe" (password)
  public function decrypt() {
    $this->setConfiguration('password', utils::decrypt($this->getConfiguration('password')));
  }
  public function encrypt() {
    $this->setConfiguration('password', utils::encrypt($this->getConfiguration('password')));
  }
  */

  /*
  * Permet de modifier l'affichage du widget (également utilisable par les commandes)
  public function toHtml($_version = 'dashboard') {}
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
  * Permet d'empêcher la suppression des commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
  public function dontRemoveCmd() {
    return true;
  }
  */

  // Exécution d'une commande
  public function execute($_options = array()) {
    $eqlogic = $this->getEqLogic(); //récupère l'éqlogic de la commande $this
    switch ($this->getLogicalId()) { //vérifie le logicalid de la commande
      case 'refresh': // LogicalId de la commande rafraîchir que l’on a créé dans la méthode Postsave de la classe vdm .
        $info = $eqlogic->majinfo(); //On lance la fonction randomVdm() pour récupérer une vdm et on la stocke dans la variable $info
        // (issu de template) $eqlogic->checkAndUpdateCmd('story', $info); //on met à jour la commande avec le LogicalId "story"  de l'eqlogic
      break;
    }

  }

  /*     * **********************Getteur Setteur*************************** */
}
