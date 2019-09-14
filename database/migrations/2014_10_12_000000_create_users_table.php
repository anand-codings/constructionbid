  <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email', 191)->unique();
            $table->string('password');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('phone', 191)->nullable();
            $table->enum('type', ['homeowner','company']);
            $table->string('home_address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('username')->nullable();
            $table->date('dob')->nullable();
            $table->string('language')->nullable();
            $table->string('currency')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->boolean('is_verified')->default(0)->comment('1 verified, 0 not verified');
            $table->boolean('is_blocked')->default(0)->comment('1 blocked, 0 not blocked');
            $table->boolean('update_web_notification')->default(0)->nullable();
            $table->string('forget_password_token')->nullable();
            $table->string('email_confirmaiton_token')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('stripe_id')->nullable()->collation('utf8mb4_bin');
            $table->string('card_brand')->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->boolean('is_email_verified')->default(0)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}
