<?php

namespace App\Services;
class DatatableServices implements DatatableInterfaceServices
{

    public function header(array $data = []): array
    {
        return $data;

    }//end of header

    public function runClass(): array
    {
        return ['header' => $this->header()];

    }//end of header

}//end of class
