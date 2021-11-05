<?php 
    namespace Root\Core;
    class Schema{
        /**
         * userSchema est une variable de type  liste qui retrace le schema de la table user. il pour clé le nom qui sera utiliser et pou valeur la valeur sql
         *
         * @var [type] list des clés et des valeur
         */
        public $userSchema=[
            "id"=>"id",
            "name"=>"user_name",
            "email"=>"email",
            "phone"=>"phone",
            "password"=>"user_password",
            "sponsor"=>"sponsor",
            "side"=>"side",
            "status"=>"status",
            "dateRecord"=>"date_record",
            "timeRecord"=>"time_record",
            "accountStatus"=>"account_status",
        ]
        public $investmentSchema=[
            "id"=>"id",
            "name"=>"investment_name",
            "dateRecord"=>"record_date",
            "timeRecord"=>"record_time",
            "color"=>"color",
            "userId"=>"user_id",
        ]
        public $adminSchema=[
            "id"=>"id",
            "name"=>"admin_name",
            "password"=>"admin_password",
            "dateRecord"=>"record_date",
            "timeRecord"=>"record_time",
        ]
        public $databaseSchema=[
            "user"=>"users",
            "investment"=>"investments",
            "admin"=>"admins",
        ]
    }     
?>