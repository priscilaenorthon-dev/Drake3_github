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
        // Units table
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Locations table  
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type')->nullable();
            $table->text('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Positions table
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->string('level')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Teams table
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('unit_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('leader_id')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Shifts table
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('code')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration_hours')->nullable();
            $table->string('type')->default('regular');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Collaborators table
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('team_id')->nullable()->constrained()->onDelete('set null');
            $table->string('employee_number')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('hire_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->string('status')->default('active');
            $table->json('custom_fields')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['tenant_id', 'employee_number']);
        });

        // Work Schedules table
        Schema::create('work_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('collaborator_id')->constrained()->onDelete('cascade');
            $table->foreignId('shift_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('set null');
            $table->date('schedule_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('status')->default('planned');
            $table->text('notes')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['tenant_id', 'schedule_date', 'status']);
        });

        // Schedule Swaps table
        Schema::create('schedule_swaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('requester_schedule_id')->constrained('work_schedules')->onDelete('cascade');
            $table->foreignId('target_schedule_id')->constrained('work_schedules')->onDelete('cascade');
            $table->foreignId('requester_id')->constrained('collaborators')->onDelete('cascade');
            $table->foreignId('target_id')->constrained('collaborators')->onDelete('cascade');
            $table->text('reason')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Qualifications table
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->boolean('requires_certification')->default(false);
            $table->integer('validity_days')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Trainings table
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('qualification_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->default('online');
            $table->integer('duration_hours')->nullable();
            $table->decimal('passing_score', 5, 2)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Training Records table
        Schema::create('training_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('collaborator_id')->constrained()->onDelete('cascade');
            $table->foreignId('training_id')->constrained()->onDelete('cascade');
            $table->date('completion_date');
            $table->date('expiration_date')->nullable();
            $table->decimal('score', 5, 2)->nullable();
            $table->string('status')->default('completed');
            $table->string('instructor')->nullable();
            $table->text('notes')->nullable();
            $table->string('certificate_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['tenant_id', 'expiration_date']);
        });

        // Qualification Matrix table
        Schema::create('qualification_matrix', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('team_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('unit_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('qualification_id')->constrained()->onDelete('cascade');
            $table->boolean('required')->default(true);
            $table->integer('priority')->default(0);
            $table->timestamps();
        });

        // Travel Requests table
        Schema::create('travel_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('collaborator_id')->constrained()->onDelete('cascade');
            $table->foreignId('requested_by')->constrained('users')->onDelete('cascade');
            $table->string('type')->default('boarding');
            $table->date('departure_date');
            $table->date('return_date')->nullable();
            $table->string('origin');
            $table->string('destination');
            $table->text('purpose')->nullable();
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Purchase Requests table
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('requested_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('unit_id')->nullable()->constrained()->onDelete('set null');
            $table->string('type')->default('service');
            $table->string('category')->nullable();
            $table->text('description');
            $table->text('justification')->nullable();
            $table->decimal('estimated_cost', 10, 2);
            $table->string('priority')->default('normal');
            $table->string('status')->default('pending');
            $table->date('required_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Vacation Requests table
        Schema::create('vacation_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('collaborator_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total_days');
            $table->string('type')->default('vacation');
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Events table
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('collaborator_id')->constrained()->onDelete('cascade');
            $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');
            $table->string('type');
            $table->string('category')->nullable();
            $table->text('description');
            $table->date('event_date');
            $table->string('severity')->default('info');
            $table->boolean('requires_action')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        // Timesheets table
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('collaborator_id')->constrained()->onDelete('cascade');
            $table->date('work_date');
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->integer('regular_hours')->default(0);
            $table->integer('overtime_hours')->default(0);
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['tenant_id', 'work_date']);
        });

        // Activities table
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('collaborator_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('team_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('set null');
            $table->date('activity_date');
            $table->string('type');
            $table->string('category')->nullable();
            $table->text('description');
            $table->string('status')->default('completed');
            $table->json('metrics')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Absences table
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('collaborator_id')->constrained()->onDelete('cascade');
            $table->date('absence_date');
            $table->string('type');
            $table->text('reason')->nullable();
            $table->boolean('justified')->default(false);
            $table->text('justification')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['tenant_id', 'absence_date']);
        });

        // Operational Costs table
        Schema::create('operational_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('unit_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('set null');
            $table->date('cost_date');
            $table->string('category');
            $table->string('subcategory')->nullable();
            $table->text('description');
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('BRL');
            $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // Approvals table
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->string('approvable_type');
            $table->unsignedBigInteger('approvable_id');
            $table->foreignId('approver_id')->constrained('users')->onDelete('cascade');
            $table->integer('step')->default(1);
            $table->string('status')->default('pending');
            $table->text('comments')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            
            $table->index(['approvable_type', 'approvable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
        Schema::dropIfExists('operational_costs');
        Schema::dropIfExists('absences');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('timesheets');
        Schema::dropIfExists('events');
        Schema::dropIfExists('vacation_requests');
        Schema::dropIfExists('purchase_requests');
        Schema::dropIfExists('travel_requests');
        Schema::dropIfExists('qualification_matrix');
        Schema::dropIfExists('training_records');
        Schema::dropIfExists('trainings');
        Schema::dropIfExists('qualifications');
        Schema::dropIfExists('schedule_swaps');
        Schema::dropIfExists('work_schedules');
        Schema::dropIfExists('collaborators');
        Schema::dropIfExists('shifts');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('units');
    }
};
