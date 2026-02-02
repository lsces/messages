<?php
namespace Bitweaver\Messages;
global $gBitSystem, $gBitUser, $gBitSmarty;

$pRegisterHash = [
	'package_name' => 'messages',
	'package_path' => dirname( dirname( __FILE__ ) ) . '/',
];

// fix to quieten down VS Code which can't see the dynamic creation of these ...
define( 'MESSAGES_PKG_NAME', $pRegisterHash['package_name'] );
define( 'MESSAGES_PKG_URL', BIT_ROOT_URL . basename( $pRegisterHash['package_path'] ) . '/' );
define( 'MESSAGES_PKG_CLASS_PATH', BIT_ROOT_PATH . basename( $pRegisterHash['package_path'] ) . '/includes/classes/');

$gBitSystem->registerPackage( $pRegisterHash );

if( $gBitSystem->isPackageActive( 'messages' ) && $gBitUser->hasPermission( 'p_messages_send' ) ) {
	$messages = new Messages();
	$unreadMsgs = $messages->unreadMessages( $gBitUser->mUserId );
	$gBitSmarty->assign( 'unreadMsgs', $unreadMsgs );
}
