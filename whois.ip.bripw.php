<?php
/*
Whois2.php	PHP classes to conduct whois queries

Copyright (C)1999,2000 easyDNS Technologies Inc. & Mark Jeftovic

Maintained by Mark Jeftovic <markjr@easydns.com>          

For the most recent version of this package: 

http://www.easydns.com/~markjr/whois2/

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

/* bripw.whois	1.0 	David Saez 04/04/2003 */

require_once("generic.whois");

if(!defined("__BRIPW_HANDLER__")) define("__BRIPW_HANDLER__",1);

class bripw_handler {

function parse ($data_str) 
{
$translate = array (
                        "fax-no" => "fax",
                        "e-mail" => "email",
                        "nic-hdl-br" => "handle",
                        "person" => "name",
			"netname" => "name"
                   );

$contacts = array (
                        "owner-c" => "owner",
                        "tech-c" => "tech",
			"abuse-c" => "abuse"
                  );

$r = generic_whois($data_str,$translate,$contacts,"network");

unset($r["network"]["owner"]);
unset($r["network"]["ownerid"]);
unset($r["network"]["responsible"]);
unset($r["network"]["address"]);
unset($r["network"]["phone"]);
$r["network"]["handle"]=$r["network"]["aut-num"];
unset($r["network"]["aut-num"]);
unset($r["network"]["nsstat"]);
unset($r["network"]["nslastaa"]);
unset($r["network"]["inetrev"]);

if (isset($r["network"]["nserver"])) 
    $r["network"]["nserver"]=array_unique($r["network"]["nserver"]);

return $r;
}

}
?>
