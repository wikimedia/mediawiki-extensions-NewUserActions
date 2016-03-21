<?php

use MediaWiki\Extensions\NewUserActions\Config;

class ConfigTest extends MediaWikiTestCase {
	public function testGetLocalisedMessage() {
		$this->assertEquals( "⧼⧽", Config::getLocalisedMessage( "" ) );
		$this->assertEquals(
			"⧼notexistingmessage⧽",
			Config::getLocalisedMessage( "notexistingmessage" )
		);
		$this->assertEquals(
			"Template:New user page",
			Config::getLocalisedMessage( "newuseractions-userpage-template" )
		);
	}

	public function testGetEditFlags() {
		global $wgNewUserActionsMinorEdit, $wgNewUserActionsSuppressRC;

		// Default configuration
		$this->assertEquals( 4, Config::getEditFlags() );

		// Custom configurations
		$wgNewUserActionsMinorEdit = $wgNewUserActionsSuppressRC = true;
		$this->assertEquals( 12, Config::getEditFlags() );

		$wgNewUserActionsMinorEdit = false;
		$wgNewUserActionsSuppressRC = true;
		$this->assertEquals( 8, Config::getEditFlags() );

		$wgNewUserActionsMinorEdit = $wgNewUserActionsSuppressRC = false;
		$this->assertEquals( 0, Config::getEditFlags() );

		// Restore default configuration
		$wgNewUserActionsMinorEdit = true;
		$wgNewUserActionsSuppressRC = false;
	}
}
