<?php

namespace AntiSpam;

use pocketmine\event\player\PlayerChatEvent;

use pocketmine\utils\Config;
use pocketmine\Player;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class AntiSpam extends PluginBase implements Listener{
	/*
	*@var protected $time
	*/
	protected $time = [];
	
	public $cfg;
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this); 
        $this->cfg = $this->getConfig();
        $this->saveDefaultConfig();
        $this->getLogger()->info("§bCreated By Skiddy");
    }
    public function onChat(PlayerChatEvent $ev){
    	$p = $ev->getPlayer();
        if (isset($this->time[$p->getName()])){
                    if ($this->time[$p->getName()] <= time()){
                    }else{
                        $time = $this->time[$p->getName()] - time();
                        $time = gmdate("s",$time);
                        $cfg = $this->getConfig();
				        $msg = str_replace("{time}", "$time", $cfg->get("AntiSpam-MSG"));
				        $msg = str_replace("{player}", $p->getName(), $msg);
				        $msg = str_replace("{line}", "\n", $msg);
				        if($p->hasPermission("antispam.except")){
					        return;
					    }
				        $ev->setCancelled(!null);
                        $p->sendMessage("$msg");
                        return;
                    }
                }
                $cooldown = $this->cfg->get("Cooldown");
                $this->time[$p->getName()] = time() + $cooldown;
                }
           }
		
