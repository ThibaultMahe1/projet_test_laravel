<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //

        Bouncer::allow('admin')->to('del-Univers');
        Bouncer::allow('admin')->to('modif-Univers');
        Bouncer::allow('admin')->to('info-Univers');
        Bouncer::allow('admin')->to('creat-Univers');

        Bouncer::allow('Creator')->to('modif-Univers');
        Bouncer::allow('Creator')->to('info-Univers');
        Bouncer::allow('Creator')->to('creat-Univers');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
