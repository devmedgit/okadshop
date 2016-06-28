<?php
/**
 * 2016 OkadShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@okadshop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade OkadShop to newer
 * versions in the future. If you wish to customize OkadShop for your
 * needs please refer to http://www.okadshop.com for more information.
 *
 * @author    OkadShop <contact@okadshop.com>
 * @copyright 2016 OkadShop
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of OkadShop
 */

include '../../../../config/bootstrap.php';

//This is an ajax request
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
{
	die();
}

//get posted data
$args = $_POST['args'];
if( $args  == "") return;

$Mails		= new Mails();
$Sender 	= "no-reply@okadshop.com";
$Receiver = $args['email'];
$Subject 	= " Changements de statuts de devis";
$Content  = 'Bonjour '. $args['customer'] .',<br><br>';
$Content .= 'Le statut de devis avec le référence ['. $args['reference'] .'] a été changé, le nouveau statut est : '. $args['state'] .'.<br><br>';
$Content .= 'Cordialement.';
$sentmail = $Mails->SendFastMail($Sender,$Receiver,$Subject,$Content);
if( $sentmail ){
	echo json_encode( l("Email de changements de statuts a été envoyé au Client.", "quotation") );
}