<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_global', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->text('residence_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('cnic', 15)->nullable();
            $table->date('cnic_expiry');
            $table->string('phone_no', 15)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('blood_group', 15);
            $table->date('dob');
            $table->string('email', 50)->nullable();
            $table->string('maritial_status', 10)->nullable();
            $table->tinyInteger('children')->nullable();
            $table->boolean('is_pettycash');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('designation')->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->date('doj')->nullable();
            $table->string('status', 15)->default('Inactive')->nullable();
            $table->unsignedInteger('erp_id')->nullable();
            $table->date('suspenddate')->nullable();
            $table->string('suspend_remarks', 100)->nullable();
            $table->string('place_of_birth', 100)->nullable();
            $table->string('nationality', 50)->default('pakistani')->nullable();
            $table->string('religion', 50)->nullable();
            $table->string('ntn', 50)->nullable();
            $table->date('cnic_issue_date')->nullable();
            $table->string('driving_license', 30)->nullable();
            $table->date('driving_license_issue_date')->nullable();
            $table->date('driving_license_expiry_date')->nullable();
            $table->string('passport_no', 50)->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->string('eobi_no', 25)->nullable();
            $table->date('eobi_issue_date')->nullable();
            $table->string('service_bond_status', 15)->nullable();
            $table->string('is_disability', 15)->nullable();
            $table->string('political_party_affiliation', 10)->nullable();
            $table->string('is_criminal_charge', 10)->nullable();
            $table->string('job_type', 100)->nullable();
            $table->unsignedInteger('position_id')->nullable();
            $table->unsignedInteger('resignation_status')->default(0)->nullable();
            $table->string('gender', 100)->nullable();
            $table->tinyInteger('rejoined')->default(0)->nullable();
            $table->date('confirmation_due_date')->nullable();
            $table->date('confirmation_date')->nullable();
            $table->string('exempt_from_attendance', 10)->default('no')->nullable();
            $table->tinyInteger('is_email_joined')->default(0)->nullable();
            $table->tinyInteger('is_email_resigned')->default(0)->nullable();
            $table->date('internship_end_date')->nullable();
            $table->unsignedInteger('dimension_id')->nullable();
            $table->tinyInteger('education_status')->default(0)->nullable();
            $table->tinyInteger('rejoining_status')->default(0)->nullable();
            $table->tinyInteger('item_issuance')->default(0)->nullable();
            $table->tinyInteger('cancelled_status')->default(0)->nullable();
            $table->tinyInteger('is_suspend')->default(0)->nullable();
            $table->tinyInteger('is_email_health_care_resigned')->default(0)->nullable();
            $table->tinyInteger('is_email_health_care_resigned_not_applicable')->default(0)->nullable();
            $table->tinyInteger('family_details')->default(1)->nullable();
            $table->string('exempt_from_overtime', 10)->default('yes')->nullable();
            $table->tinyInteger('allow_excel_attendance')->default(0)->nullable();
            $table->string('official_email', 100)->nullable();
            $table->string('official_mobile', 50)->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->string('mother_email', 200)->nullable();
            $table->tinyInteger('is_pf')->nullable();
            $table->tinyInteger('is_profit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_global');
    }
};
