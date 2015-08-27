<?php
namespace Member\Helper;

use Member\Controller\MemberController;
class ImporterHelper
{
    public static function importMembers(){
        $myfile = fopen(__DIR__."/importer/importer.txt", "r") or die("Unable to open file!");
        $text = fread($myfile, filesize(__DIR__."/importer/importer.txt"));
        fclose($myfile);
        $rows = explode("\n", $text);
        for($i=1; $i < count($rows); $i++){
            $col = preg_split('/[\t]/', $rows[$i]);
            $member = array(
                "username"      => $col[13],
                "password"      => self::generatePassword($col[2], $col[3]),
                "email"         => $col[13],
                "first_name"    => $col[2],
                "last_name"     => $col[3],
                "address1"      => $col[6],
                "address2"      => $col[7],
                "address3"      => "",
                "city"          => $col[8],
                "state"         => $col[9],
                "country"       => $col[11],
                "zip"           => $col[10],
                "telephone"     => str_replace(".", "", $col[12]),
                "refered_by"    => $col[14],
                "company_name"  => $col[4],
                "company_website"       => $col[17],
                "company_description"   => $col[5],
                "registration_date"     => $col[0],
                "renewal_status"        => $col[1],
                "committee1"            => $col[15],
                "committee2"            => $col[16],
                "membership_type"       => $col[18],
                "PAC"                   => $col[19],
                "payment_weblink"       => $col[20],
                "affilates_number"      => $col[21],
                "total_amount"          => $col[45],
                "payment_received"      => $col[46],
                "payment_method"        => $col[44],
                "cost_per_affiliate"    => $col[43],
                "membership_base_cost"  => $col[42]
            );
            MemberController::getSingleton()->createMember($member);
            
            for($j=22; $j <= 41; $j=$j+4){
                if(!empty($col[$j+2])){
                    $affiliate = array(
                        "username"      => $col[$j],
                        "password"      => self::generatePassword($col[$j], $col[$j+1]),
                        "email"         => $col[$j+2],
                        "first_name"    => $col[$j],
                        "last_name"     => $col[$j+1]
                    );
                    MemberController::getSingleton()->createAMember($affiliate);
                }
            }
        }
    }
    
    public static function generatePassword($fname, $lname){
        $password = substr($fname, 0, 1);
        $password .= $lname;
        return $password;
    }
}