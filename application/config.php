<?php
// Include our Marvel API Interface class
include '../lib/MarvelAPIInterface.php';

// Construct a new instance of the Marvel API Interface, params: public key, private key
$API = new MarvelAPIInterface('51053776bff9f684b08a41a47734167b', '830fb729ea7061d094a89c5e6b28eeaccf5fc9f9');

// Configure caching, params: cache folder, expiration time
$API->configureCache('cache/', 60 * 60 * 24);
