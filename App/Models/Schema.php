<?php

namespace Root\App\Models;

/**
 *
 * @author Esaie MUHASA
 *        
 */
class Schema
{

    /**
     */
    private function __construct()
    {
    }

    const USER = [
        "id" => "id",
        "name" => "user_name",
        "sponsor" => "sponsor",
        "parent" => "parent",
        "email" => "email",
        "phone" => "phone",
        "password" => "user_password",
        "side" => "side",
        "status" => "user_status",
        "locked" => "locked",
        "validationEmail" => "validation_Status",
        "recordDate" => "record_date",
        "timeRecord" => "record_time",
        "modifDate" => "last_modif_date",
        "motifTime" => "last_modif_time",
        "photo" => "images_name",
        "token" => "user_token",

    ];

    const PACK = [
        "id" => "id",
        "name" => "pack_name",
        "acurracy" => "pack_currency",
        "amountMin" => "mount_min",
        "amountMax" => "mount_max",
        "image" => "pack_image",
        "admin" => "admin_Id",
        "recordDate" => "record_date",
        "timeRecord" => "record_time",
        "leval" => "laval",
        "modifDate" => "last_modif_date",
        "modifTime" => "last_modif_time",
    ];

    const ADMIN = [
        "id" => "id",
        "name" => "admin_second_name",
        "email" => "email",
        "password" => "admin_password",
        "recordDate" => "record_date",
        "timeRecord" => "record_time",
        "modifDate" => "last_modif_date",
        "motifTime" => "last_modif_time",
        "validationEmail" => "validation_Status",
        "status" => "admin_status",
        "token" => "admin_token",
    ];

    const BINARY = [
        "id" => "id",
        "user" => "user_id",
        "generator" => "id_sponsored_inscription",
        "amount" => "amount",
        "recordDate" => "record_date",
        "timeRecord" => "record_time",
        "modifDate" => "last_modif_date",
        "motifTime" => "last_modif_time",
        "surplus" => "surplus",

    ];
    const CASHOUT = [
        "id" => "id",
        "user" => "user_id",
        "amount" => "amount",
        "recordDate" => "record_date",
        "timeRecord" => "record_time",
        "modifDate" => "last_modif_date",
        "motifTime" => "last_modif_time",
        "validated" => "validated",
        "admin" => "admin"
    ];
    const RETURN_INVEST = [
        "id" => "id",
        "user" => "user_id",
        "amount" => "amount",
        "recordDate" => "record_date",
        "timeRecord" => "record_time",
        "modifDate" => "last_modif_date",
        "motifTime" => "last_modif_time",
        "surplus" => "surplus",

    ];

    const PARAINAGE = [
        "id" => "id",
        "user" => "user_id",
        "generator" => "id_sponsored_inscription",
        "amount" => "amount",
        "recordDate" => "record_date",
        "timeRecord" => "record_time",
        "modifDate" => "last_modif_date",
        "motifTime" => "last_modif_time",
        "surplus" => "surplus",
    ];

    const INSCRIPTION = [
        "id" => "id",
        "user" => "user_id",
        "amount" => "amount",
        "recordDate" => "record_date",
        "timeRecord" => "record_time",
        "transactionOrigi" => "transaction_origin",
        "transactionCode" => "transaction_code",
        "validate" => "validate_inscription",
        "admin" => "admin_id",
        "confirmatDate" => "confirmat_date",
        "confirmateTime" => "confirmate_time",
        "modifDate" => "last_modif_date",
        "motifTime" => "last_modif_time",

    ];

    const TABLE_SCHEMA = [
        "user" => "users",
        "pack" => "packs",
        "admin" => "admins",
        "binary" => "binarys",
        "cashOut" => "cashout",
        "inscription" => "inscriptions",
        "returnInvest" => "return_invest",
        "parainage" => "parenages",
    ];
}
