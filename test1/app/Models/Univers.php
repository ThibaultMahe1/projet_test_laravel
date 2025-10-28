<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $nom
 * @property string $description
 * @property string $img_fond
 * @property string $logo
 * @property string $couleur_principal
 * @property string $couleur_secondaire
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $favoritedBy
 * @property-read int|null $favorited_by_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 *
 * @method static \Database\Factories\UniversFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereCouleurPrincipal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereCouleurSecondaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereImgFond($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Univers whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Univers extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
