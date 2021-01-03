<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class SetupSql extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isSchedulerOn = DB::select("show global variables where VARIABLE_NAME = 'event_scheduler'");
        $isSchedulerOn = collect($isSchedulerOn);
        $isSchedulerOn = $isSchedulerOn->first()->Value;


        /**
         * event scheduler
         * 
         * Cek apakah event scheduler mysql
         * sudah menyala atau belum. kalau belum
         * nyalakan dengan query sql dibawah
         */

        if ( $isSchedulerOn != "ON" )
            DB::statement("set global event_scheduler = 'ON'");


        /**
         * Hapus semua event
         * 
         * Ganti nama databasenya kalo beda
         * sama database kalian
         */
        DB::statement("DELETE FROM mysql.event WHERE db = 'bpjs'");
        
        /**
         * Set event cart pinjam
         * 
         * Cart pinjam event akan jalan di waktu
         * tertentu untuk menghapus data cart
         * dan mengupdate status ketersediaan
         * barang aset.
         * 
         */

        DB::unprepared("CREATE EVENT `event_cart_pinjam` ON SCHEDULE EVERY 15 MINUTE STARTS CURRENT_DATE DO BEGIN UPDATE item_pinjam_detail as item, cart_pinjam as cart SET item.status = '1' where item.id = cart.item_id AND cart.created_at <= CURRENT_TIMESTAMP - INTERVAL 1 HOUR; DELETE FROM cart_pinjam WHERE created_at <= CURRENT_TIMESTAMP - INTERVAL 1 HOUR; END");
        
        /**
         * Set event cart ambil
         * 
         * Cart ambil event akan jalan di waktu
         * tertentu untuk menghapus data cart
         * dan mengupdate stock dari barang 
         * consumable.
         * 
         */

        DB::unprepared("CREATE EVENT `event_cart_ambil` ON SCHEDULE EVERY 15 MINUTE STARTS CURRENT_DATE DO BEGIN UPDATE item_ambil as item, cart_ambil as cart SET item.stock = item.stock + cart.quantity WHERE item.id = cart.item_id AND cart.created_at <= CURRENT_TIMESTAMP - INTERVAL 1 HOUR; DELETE FROM cart_ambil WHERE created_at <= CURRENT_TIMESTAMP - INTERVAL 1 HOUR; END ");
    }
}
