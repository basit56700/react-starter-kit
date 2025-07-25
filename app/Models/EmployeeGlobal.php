<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeGlobal extends Model
{
    protected $table = 'employee_global';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'first_name',
        'last_name',
        'residence_address',
        'permanent_address',
        'cnic',
        'cnic_expiry',
        'phone_no',
        'mobile',
        'blood_group',
        'dob',
        'email',
        'maritial_status',
        'children',
        'is_pettycash',
        'company_id',
        'designation',
        'branch_id',
        'department_id',
        'doj',
        'status',
        'erp_id',
        'suspenddate',
        'suspend_remarks',
        'place_of_birth',
        'nationality',
        'religion',
        'ntn',
        'cnic_issue_date',
        'driving_license',
        'driving_license_issue_date',
        'driving_license_expiry_date',
        'passport_no',
        'passport_issue_date',
        'passport_expiry_date',
        'eobi_no',
        'eobi_issue_date',
        'service_bond_status',
        'is_disability',
        'political_party_affiliation',
        'is_criminal_charge',
        'job_type',
        'position_id',
        'resignation_status',
        'gender',
        'rejoined',
        'confirmation_due_date',
        'confirmation_date',
        'exempt_from_attendance',
        'is_email_joined',
        'is_email_resigned',
        'internship_end_date',
        'dimension_id',
        'education_status',
        'rejoining_status',
        'item_issuance',
        'cancelled_status',
        'is_suspend',
        'is_email_health_care_resigned',
        'is_email_health_care_resigned_not_applicable',
        'family_details',
        'exempt_from_overtime',
        'allow_excel_attendance',
        'official_email',
        'official_mobile',
        'mother_name',
        'mother_email',
        'is_pf',
        'is_profit',
    ];
}
