<?php
namespace Cheatze\Library;

//Includes the html of the main menu links
class MainController
{
    /**
     * Shows the main menu by including the menu.html
     * @return void
     */
    public function menu()
    {
        include_once 'html/menu.html';
    }


}
