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
    {}
    
    const USER=[
        "id"=>"id",
        "name"=>"user_name",
        "sponsor"=>"sponsor",
        "parent"=>"parent",
        "email"=>"email",
        "phone"=>"phone",
        "password"=>"user_password",
        "side"=>"side",
        "status"=>"user_status",
        "validationEmail"=>"validation_Status",
        "dateRecord"=>"record_date",
        "timeRecord"=>"record_time",
        "modifDate"=>"last_modif_date",
        "motifTime"=>"last_modif_time",
        "photo"=>"images_name",
        "token"=>"user_token",

    ];
    
    const PACK=[
        "id"=>"id",
        "name"=>"pack_name",
        "currency"=>"pack_currency",
        "mountMin"=>"mount_min",
        "mountMax"=>"mount_max",
        "image"=>"pack_image",
         "adminId"=>"admin_Id",
        "dateRecord"=>"record_date",
        "timeRecord"=>"record_time",
        "leval"=>"laval",
        "modifDate"=>"last_modif_date",
        "modifTime"=>"last_modif_time",
    ];
    
    const ADMIN=[
        "id"=>"id",
        "name"=>"admin_second_name",
        "email"=>"email",
        "password"=>"admin_password",
        "dateRecord"=>"record_date",
        "timeRecord"=>"record_time",
        "modifDate"=>"last_modif_date",
        "motifTime"=>"last_modif_time",
        "validationEmail"=>"validation_Status",
        "status"=>"admin_status",
        "token"=>"admin_token",
    ];
    const BINARY = [
        "id"=>"id",
        "inscriptionId"=>"id_inscription",
        "sponsoredId"=>"id_sponsored_inscription",
        "amount"=>"amount",
        "dateRecord"=>"record_date",
        "timeRecord"=>"record_time",
        "modifDate"=>"last_modif_date",
        "motifTime"=>"last_modif_time",
        "surplus"=>"surplus",
        
    ];
    const CASHOUT = [
        "id"=>"id",
        "inscriptionId"=>"id_inscription",
        "amount"=>"amount",
        "dateRecord"=>"record_date",
        "timeRecord"=>"record_time",
        "modifDate"=>"last_modif_date",
        "motifTime"=>"last_modif_time",
        
    ];
    const RETURN_INVEST = [
        "id"=>"id",
        "inscriptionId"=>"id_inscription",
        "amount"=>"amount",
        "dateRecord"=>"record_date",
        "timeRecord"=>"record_time",
        "modifDate"=>"last_modif_date",
        "motifTime"=>"last_modif_time",
        "surplus"=>"surplus",
        
    ];
    const PARAINAGE = [
        "id"=>"id",
        "inscriptionId"=>"id_inscription",
        "generator"=>"id_sponsored_inscription",
        "amount"=>"amount",
        "dateRecord"=>"record_date",
        "timeRecord"=>"record_time",
        "modifDate"=>"last_modif_date",
        "motifTime"=>"last_modif_time",
        "surplus"=>"surplus",
        
    ];
    const INSCRIPTION = [
        "id"=>"id",
        "user"=>"user_id",
        "packId"=>"pack_id",
        "amount"=>"amount",
        "state"=>"state",
        "dateRecord"=>"record_date",
        "timeRecord"=>"record_time",
        "transactionOrigin"=>"transaction_origin",
        "transactionCode"=>"transaction_code",
        "validateInscription"=>"validate_inscription",
        "adminId"=>"admin_id",
        "confirmatDate"=>"confirmat_date",
        "confirmateTime"=>"confirmate_time",
        "modifDate"=>"last_modif_date",
        "motifTime"=>"last_modif_time",
        
    ];
    
    const TABLE_SCHEMA=[
        "user"=>"users",
        "pack"=>"packs",
        "admin"=>"admins",
        "binary"=>"binarys",
        "cashout"=>"cashout",
        "inscription"=>"inscriptions",
        "returnInvest"=>"return_invest",
        "parainage"=>"parenages",
    ];
}

