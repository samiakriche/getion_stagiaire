<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeStage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'creator_id','name_file','path_file','status','encadrant_id'];

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'name' => $this->name, 'type' => __('demande_stage.demande_stage'),
        ]);
        $link = '<a href="'.route('demande_stages.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->name;
        $link .= '</a>';

        return $link;
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
    public function encadrant()
    {
        return $this->belongsTo(Encadrant::class);
    }
}
