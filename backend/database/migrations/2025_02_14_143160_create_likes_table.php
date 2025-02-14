use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('likeable');  // 可以點讚文章或評論
            $table->timestamps();
            $table->unique(['user_id', 'likeable_type', 'likeable_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
} 