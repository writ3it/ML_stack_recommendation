<?php

namespace ITR\Base;


interface IResource{
    public function Serve(array $data):array;
}