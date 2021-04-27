<?php
namespace BsPayCore;

if (!defined("CORE_BASE")) {
    define("CORE_BASE", dirname(__FILE__));
}

require_once CORE_BASE."/config/MerConfig.php";
require_once CORE_BASE."/utils/BsPayRequests.php";
require_once CORE_BASE."/utils/BsPayTools.php";
