<?php

namespace App\Joseph;

use Spatie\Permission\Models\Role;

class Helper
{
    public static function getStatusValue(String $status)
    {
        switch ($status) {
            case 0:
                return "Inactive";
                break;

            default:
                return "Active";
                break;
        }
    }

    public static function getGenderValue(String $status)
    {
        switch ($status) {
            case "F":
                return   "Female";
                break;

            default:
                return   "Male";
                break;
        }
    }

    public static function getStatus()
    {
        return [
            '' => 'Select',
            '1' => 'Active',
            '0' => 'InActive',
        ];
    }

    public static function getRoles()
    {
        return Role::orderBy('id', 'asc')->get(['id', 'name']);
    }

    public static function getPerPageNumber()
    {
        return [
             \constPerPageNumber::All => \constPerPageWord::All,
             \constPerPageNumber::Five => \constPerPageWord::Five,
             \constPerPageNumber::Ten => \constPerPageWord::Ten,
             \constPerPageNumber::Fifteen => \constPerPageWord::Fifteen,
             \constPerPageNumber::TwentyFive => \constPerPageWord::TwentyFive,
             \constPerPageNumber::SeventyFive => \constPerPageWord::SeventyFive,
             \constPerPageNumber::Hundred => \constPerPageWord::Hundred,
        ];
    }
}
