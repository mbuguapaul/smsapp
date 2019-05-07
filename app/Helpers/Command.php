<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17/10/16
 * Time: 15:08
 */

namespace App\Helpers;


class Command
{
    const SETNAME = "SETNAME";
    const SETCOMMUNITY = "community";
    const SETSTATUS = "STATUS";
    const SETSHARE = "SHARE";
    const SETHELP = "HELP";
    public static $ALL = [
        Command::SETNAME,
        Command::SETCOMMUNITY,
        Command::SETSTATUS,
        Command::SETSHARE
    ];
}