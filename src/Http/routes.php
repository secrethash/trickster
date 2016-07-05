<?php


/**
* 
* Binding App
*
*/

// Binding Facade Trickster
App::bind('trickster', function()
{
	return new Secrethash\Trickster\TricksController;
});


/**
*
* Beta Testing
* Testing functions directly or indirectly
*
*/

// Testing New Package Trickster
/*Route::get('beta/trickster', function()
	{
		return Trickster::slug('A Beta Test for Trickster\'s Tricks');
	});*/