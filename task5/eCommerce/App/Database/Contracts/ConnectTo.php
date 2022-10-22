<?php
// to prevent one inhrate in models
namespace App\Database\Contracts;
interface ConnectTo  {
    function __construct();
    function __destruct();
}
