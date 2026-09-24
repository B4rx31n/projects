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
        // Tambahkan kolom dan foreign key ke tabel orders
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->timestamp('order_date')->useCurrent();
        });

        // Tambahkan kolom dan foreign key ke tabel payments
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['cash', 'credit_card', 'bank_transfer', 'e_wallet'])->default('cash');
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->timestamp('payment_date')->useCurrent();
        });

        // Tambahkan kolom dan foreign key ke tabel order_details
        Schema::table('order_details', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('subtotal', 10, 2);
        });

        // Tambahkan kolom dan foreign key ke tabel warehouses
        Schema::table('warehouses', function (Blueprint $table) {
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('manager_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['active', 'inactive'])->default('active');
        });

        // Tambahkan kolom dan foreign key ke tabel inventories
        Schema::table('inventories', function (Blueprint $table) {
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->integer('min_stock')->default(0);
            $table->integer('max_stock')->nullable();
            $table->timestamp('last_updated')->useCurrent()->useCurrentOnUpdate();
            $table->unique(['produk_id', 'warehouse_id']); // Pastikan kombinasi unik
        });
    }

    public function down(): void
    {
        // Hapus kolom dari tabel inventories
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropUnique(['produk_id', 'warehouse_id']);
            $table->dropForeign(['produk_id']);
            $table->dropForeign(['warehouse_id']);
            $table->dropColumn(['produk_id', 'warehouse_id', 'quantity', 'min_stock', 'max_stock', 'last_updated']);
        });

        // Hapus kolom dari tabel warehouses
        Schema::table('warehouses', function (Blueprint $table) {
            $table->dropForeign(['manager_id']);
            $table->dropColumn(['name', 'address', 'phone', 'manager_id', 'status']);
        });

        // Hapus kolom dari tabel order_details
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['produk_id']);
            $table->dropColumn(['order_id', 'produk_id', 'quantity', 'unit_price', 'subtotal']);
        });

        // Hapus kolom dari tabel payments
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['order_id', 'created_by', 'amount', 'payment_method', 'status', 'payment_date']);
        });

        // Hapus kolom dari tabel orders
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['customer_id', 'created_by', 'total_amount', 'status', 'order_date']);
        });
    }
};
