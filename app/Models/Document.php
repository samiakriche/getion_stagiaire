<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['description','creator_id','nom'];

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'nom' => $this->nom, 'type' => __('document.document'),
        ]);
        $link = '<a href="'.route('documents.show', $this).'"';
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
