<?php

namespace App\Tests\TransferObjects;

use App\TransferObjects\SqlDTO;
use PHPUnit\Framework\TestCase;

class SqlDTOTest extends TestCase
{

    public function testGetSql()
    {
        $fields = [
            'public_id' => '3',
            'accreditation_id' => '3',
            'solicitor_name' => '3',
            'admission_date' => '3',
            'ew_company_id' => '3',
            'company_name' => '3',
            'website' => '3',
            'address' => '3',
            'phone' => '3',
            'email' => '3',
            'roles' => '3',
            'languages_spoken' => '3',
            'area_practice' => '3',
            'google_maps' => '3',
            'is_practicing' => '3',
            'other_roles' => '3',
            'dx_id' => '3',
            'parse_week' => '3',
        ];
        $dto = new SqlDTO(
            SqlDTO::REPLACE_TYPE,
            '`societies_raw`.`tracker_england_wales`',
            $fields, null
        );

        $sql = $dto->getSql();
        $expected = "REPLACE INTO `societies_raw`.`tracker_england_wales`
(`public_id`, `accreditation_id`, `solicitor_name`, `admission_date`, `ew_company_id`, `company_name`, `website`, `address`, `phone`, `email`, `roles`, `languages_spoken`, `area_practice`, `google_maps`, `is_practicing`, `other_roles`, `dx_id`, `parse_week`)
VALUES
(
:public_id, :accreditation_id, :solicitor_name, :admission_date, :ew_company_id, :company_name, :website, :address, :phone, :email, :roles, :languages_spoken, :area_practice, :google_maps, :is_practicing, :other_roles, :dx_id, :parse_week
);";
        self::assertEquals($expected, $sql);
    }
}
