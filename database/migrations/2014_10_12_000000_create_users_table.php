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


         Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('foto',250);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('doc_identidad')->nullable();
            $table->string('num_cel')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('tipo_mascotas', function (Blueprint $table) {
            $table->increments('id_tipo_mascota', true)->unsigned();
            $table->string('tipo_mascota',250);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        DB::connection('mysql')->table('tipo_mascotas')->insert([
            [
                'tipo_mascota' => 'perro',
                'tipo_mascota' => 'gato','
                tipo_mascota' => 'conejo',
                'tipo_mascota' => 'caballo'
                
            ]
        ]);

        Schema::create('mascotas', function (Blueprint $table) {
            $table->increments('id_mascota', true)->unsigned();
            $table->integer('id_tipomascota_fk')->unsigned();
            $table->string('nombre',250);
            $table->foreign('id_tipomascota_fk')->references('id_tipo_mascota')->on('tipo_mascotas');
            $table->foreignId('id_cliente_fk')->constrained('users');
            
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
