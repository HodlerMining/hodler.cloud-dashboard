<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $active = "home";
    
    private function setActive($id){
        $this->active = $id;
    }
    
    private function TopNav(){
        $array = [];
        $array[] = ["id" => "home", "name" => "Homepage", "url" => "index"];
        $array[] = ["id" => "latestnews", "name" => "Latest News", "url" => "latestnews"];
        $array[] = ["id" => "about", "name" => "About", "url" => "about"];
        $array[] = ["id" => "bugreport", "name" => "Bug Report", "url" => "bugreport"];
        $array[] = ["id" => "networkstatus", "name" => "Network Status", "url" => "networkstatus"];

        
        for($i = 0; $i < count($array); $i++){
            if($array[$i]["id"] == $this->active){
                $array[$i]["active"] = true;
            }
        }
       
        return $array;
    }
    
    
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Hodler Cloud',
            'topnav' => $this->TopNav(),
        ]);
    }

    /**
     * @Route("/latestnews", name="latestnews")
     */
    public function latestnews()
    {
        $this->setActive("latestnews" ); 
        return $this->render('home/latestnews.html.twig', [
            'controller_name' => 'Hodler Cloud',
            'topnav' => $this->TopNav(),
        ]);
    }
    /**
     * @Route("/about", name="about")
     */
    public function aboutus()
    {
        $this->setActive("about" ); 
        return $this->render('home/about.html.twig', [
            'controller_name' => 'Hodler Cloud',
            'topnav' => $this->TopNav(),
        ]);
    }
    /**
     * @Route("/bugreport", name="bugreport")
     */
    public function bugreport()
    {
        $this->setActive("bugreport" ); 
        return $this->render('home/bugreport.html.twig', [
            'controller_name' => 'Hodler Cloud',
            'topnav' => $this->TopNav(),
        ]);
    }
    /**
     * @Route("/networkstatus", name="networkstatus")
     */
    public function networkstatus()
    {
        $this->setActive("networkstatus" ); 
        return $this->render('home/networkstatus.html.twig', [
            'controller_name' => 'Hodler Cloud',
            'topnav' => $this->TopNav(),
        ]);
    }
}
