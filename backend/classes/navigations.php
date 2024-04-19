<?php

    class Navigations {
        //Super = 0
        //Admin = 1
        //Supplier = 2
        //Employee = 3
        
        private $navs = array(
            'home'          => array('icon'=> 'fa-home',            'link' => '/portal/dashboard',              'role' => -1),
            'accounts'      => array('icon'=> 'fa-users-cog',       'link' => '/portal/dashboard',              'role' =>  0),
            'budget'        => array('icon'=> 'fa-wallet',          'link' => '/portal/dashboard/budget',       'role' =>  1),
            'suppliers'     => array('icon'=> 'fa-house-user',      'link' => '/portal/dashboard/suppliers',    'role' =>  1),
            'activities'    => array('icon'=> 'fa-history',         'link' => '/portal/dashboard/activities',   'role' => -1),
            'transactions'  => array('icon'=> 'fa-comments-dollar', 'link' => '/portal/dashboard/',             'role' =>  2),
            'inventory'     => array('icon'=> 'fa-boxes',           'link' => '/portal/dashboard/inventory',    'role' =>  3 || 1),
            //'orders' => array('icon'=> 'fa-shopping-cart', 'link' => '/store/my/orders', 'role' => 3),
            'store'         => array('icon'=> 'fa-store',           'link' => '/store',                         'role' => -1),
            'reports'       => array('icon'=> 'fa-archive',         'link' => '/portal/dashboard/reports',      'role' => -1),
            'profile'       => array('icon'=> 'fa-user-circle',     'link' => '/portal/dashboard/account',      'role' => -1),
        );

        public function init() {
            $found = "";
            foreach(array_reverse($this->navs) as $key => $value){
                $l = explode('/', $_SERVER['REQUEST_URI']);
                $temp_link = rtrim( $_SERVER['REQUEST_URI'], '/');
                foreach(array_reverse($l) as $final){
                    
                    if ($temp_link == $value['link']){
                        
                        $found = $value['link'];
                        break;
                    }
                    $temp_link = rtrim(rtrim($temp_link, $final), '/');
                    
                }
                if($found) break;
            }

            foreach($this->navs as $key => $value){
        

                if($value['role'] == $_SESSION['role']) {
                    echo '<a href="'.$value['link'].'" class="flex items-center h-10 px-3 '.($found == $value['link'] ? 'bg-blue-600 text-white' : '').' hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                        <i class="text-xl h-6 w-6 me-3 text-center flex-shrink-0 fas '.$value['icon'].'"></i>
                        <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? \'opacity-100\' : \'opacity-0\'">'.ucfirst($key).'</span>
                    </a>';
                }elseif($value['role'] == -1){
                    echo '<a href="'.$value['link'].'" class="flex items-center h-10 px-3 '.($found == $value['link'] ? 'bg-blue-600 text-white' : '').' hover:bg-blue-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">
                        <i class="text-xl h-6 w-6 me-3 text-center  flex-shrink-0 fas '.$value['icon'].'"></i>
                        <span class="ml-2 duration-300 ease-in-out" :class="isSidebarExpanded ? \'opacity-100\' : \'opacity-0\'">'.ucfirst($key).'</span>
                    </a>';
                }
            }
        }
    }
?>

