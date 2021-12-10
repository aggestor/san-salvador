<?php

namespace Root\Core;

abstract class Validator
{
    protected $errors=[];
    protected $caption=[];
    protected $message=[];

    public function createAfterValidation()
    {

      
    }
    public function deleteAfterValidation()
    {

    }
    public function updateAfterValidation()
    {

    }
}
