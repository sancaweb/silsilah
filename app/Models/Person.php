<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Self_;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'persons';

    protected $fillable = [
        'parent_id',
        'photo',
        'name',
        'gender',
        'birthday',
        'phone',
        'address',
        'village',
        'subdistrict',
        'district',
        'province',
        'country'
    ];

    // public function parent() //orang tua
    // {
    //     return $this->belongsTo(self::class, 'parent_id', 'id');
    // }
    public function parent() //orang tua
    {
        return $this->belongsTo(Couple::class, 'parent_id', 'id');
    }

    public function cekGender()
    {
        return $this->gender;
    }


    public function marriages()
    {
        // return $this->hasMany(Couple::class, 'husband_id', 'id');

        //cek status apakah sudah menikah atau belum
        if ($this->gender == "1") {
            return $this->hasMany(Couple::class, 'husband_id', 'id')->where('divorce_date', null)->orderBy('marriage_date');
        }

        return $this->hasMany(Couple::class, 'wife_id', 'id')->where('divorce_date', null)->orderBy('marriage_date');
    }



    // public function descendants() //keturunan
    // {
    //     return $this->hasMany(self::class, 'parent_id', 'id');
    // }

    // public function childrens() //anak
    // {
    //     return $this->hasMany(self::class, 'parent_id', 'id');
    // }

    public function photo()
    {

        return $this->belongsTo(Photo::class, 'photo_id', 'id');
    }

    public function takeImage()
    {

        if ($this->photo === null) {
            return asset("images/no-image.png");
        } else {
            $exist = Storage::exists($this->photo);

            if ($exist) {
                return asset("storage/" . $this->photo);
            } else {
                return asset("images/no-image.png");
            }
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
