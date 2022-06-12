<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encadrant extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'tel','email','status','creator_id'];

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'name' => $this->nom, 'type' => __('encadrant.encadrant'),
        ]);
        $link = '<a href="'.route('encadrants.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->nom;
        $link .= '</a>';

        return $link;
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
