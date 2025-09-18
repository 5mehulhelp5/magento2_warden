<?php

namespace ControllerBlockLayoutTemplate\Example\Block;

use Magento\Framework\View\Element\Template;

class ExampleBlock extends Template
{
    /**
     * Example data provider for table
     */
    public function getEmployees()
    {
        return [
            ['id' => 1, 'name' => 'John Doe', 'role' => 'Developer'],
            ['id' => 2, 'name' => 'Jane Smith', 'role' => 'Designer'],
            ['id' => 3, 'name' => 'Alice Brown', 'role' => 'Manager'],
            ['id' => 4, 'name' => 'Bob Green', 'role' => 'Tester'],
        ];
    }

    public function getNavbarLinks()
    {
        return [
            ['label' => 'Home', 'url' => $this->getUrl('example')],
            ['label' => 'About', 'url' => '#about'],
            ['label' => 'Contact', 'url' => '#contact'],
        ];
    }

    public function getSidebarLinks()
    {
        return [
            'Dashboard',
            'Reports',
            'Settings',
            'Help'
        ];
    }

    public function getFooterText()
    {
        return "© " . date('Y') . " ControllerBlockLayoutTemplate Example Module";
    }
}
