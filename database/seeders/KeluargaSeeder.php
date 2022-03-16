<?php

namespace Database\Seeders;

use App\Models\Couple;
use App\Models\Person;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = faker::create('id_ID');

        /** BAPAK MAMAH */
        $muchidin = Person::create([
            'name' => "Muchidin",
            'gender' => "1",
            'birthday' => "1950-04-01",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);

        $heriah = Person::create([
            'name' => "Heriah",
            'gender' => "0",
            'birthday' => "1950-05-01",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);

        $pernikahanBapak = Couple::create([
            'husband_id' => $muchidin->id,
            'wife_id' => $heriah->id
        ]);

        /** BAPAK MAMAH */




        /**keteurunan 1 */
        $hery = Person::create([
            'parent_id' => $pernikahanBapak->id,
            'father_id' => $muchidin->id,
            'mother_id' => $heriah->id,
            'name' => "Hery",
            'gender' => "1",
            'birthday' => "1970-04-01",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);

        $istriHery = Person::create([
            'name' => "Elis",
            'gender' => "0",
            'birthday' => "1970-11-19",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);

        $pernikahanHery = Couple::create([
            'husband_id' => $hery->id,
            'wife_id' => $istriHery->id
        ]);

        $anakHery1 = Person::create([
            'parent_id' => $pernikahanHery->id,
            'father_id' => $hery->id,
            'mother_id' => $istriHery->id,
            'name' => "Anak pertama hery",
            'gender' => "0",
            'birthday' => "1990-11-20",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);



        $anakHery2 = Person::create([
            'parent_id' => $pernikahanHery->id,
            'father_id' => $hery->id,
            'mother_id' => $istriHery->id,
            'name' => "Anak kedua hery",
            'gender' => "1",
            'birthday' => "1991-12-20",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);

        $menantuHery2 = Person::create([
            'name' => "istri anak kedua hery",
            'gender' => "0",
            'birthday' => "1991-4-20",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);
        $pernikahan_anakHery2 = Couple::create([
            'husband_id' => $anakHery2->id,
            'wife_id' => $menantuHery2->id
        ]);

        $anakCouple2_1 = Person::create([
            'parent_id' => $pernikahan_anakHery2->id,
            'father_id' => $anakHery2->id,
            'mother_id' => $menantuHery2->id,
            'name' => "Anak pertama dari anak kedua hery",
            'gender' => "0",
            'birthday' => "2001-4-20",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);

        $anakCouple2_2 = Person::create([
            'parent_id' => $pernikahan_anakHery2->id,
            'father_id' => $anakHery2->id,
            'mother_id' => $menantuHery2->id,
            'name' => "Anak kedua dari anak kedua hery",
            'gender' => "1",
            'birthday' => "2002-6-22",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);

        $anak_3 = Person::create([
            'parent_id' => $pernikahanHery->id,
            'father_id' => $hery->id,
            'mother_id' => $istriHery->id,
            'name' => "Anak ketiga hery",
            'gender' => "0",
            'birthday' => "1992-6-20",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);

        //pernikahan dua hery
        $istri2_Hery = Person::create([
            'name' => "Elis",
            'gender' => "0",
            'birthday' => "1970-11-19",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);

        $pernikahanHery_2 = Couple::create([
            'husband_id' => $hery->id,
            'wife_id' => $istri2_Hery->id
        ]);

        $anak1_pernikahanHery_2 = Person::create([
            'parent_id' => $pernikahanHery_2->id,
            'father_id' => $hery->id,
            'mother_id' => $istri2_Hery->id,
            'name' => "Anak 1 Pernikahan Hery_2",
            'gender' => "0",
            'birthday' => "1990-11-19",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);
        $anak2_pernikahanHery_2 = Person::create([
            'parent_id' => $pernikahanHery_2->id,
            'father_id' => $hery->id,
            'mother_id' => $istri2_Hery->id,
            'name' => "Anak 2 Pernikahan Hery_2",
            'gender' => "1",
            'birthday' => "1991-11-19",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);

        $menantuHery_anak2_pernikahanHery_2 = Person::create([
            'name' => "Istri dari Anak 2 Pernikahan Hery_2",
            'gender' => "0",
            'birthday' => "1991-11-19",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);

        $pernikahan_anak2_pernikahanHery_2 = Couple::create([
            'husband_id' => $anak2_pernikahanHery_2->id,
            'wife_id' => $menantuHery_anak2_pernikahanHery_2->id
        ]);

        $anak1_pernikahan_anak2_pernikahanHery_2 = Person::create([
            'parent_id' => $pernikahan_anak2_pernikahanHery_2->id,
            'father_id' => $anak2_pernikahanHery_2->id,
            'mother_id' => $menantuHery_anak2_pernikahanHery_2->id,
            'name' => "Anak 1 pernikahan_anak2_pernikahanHery_2",
            'gender' => "1",
            'birthday' => "2021-11-19",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);






        $anak3_pernikahanHery_2 = Person::create([
            'parent_id' => $pernikahanHery_2->id,
            'father_id' => $hery->id,
            'mother_id' => $istri2_Hery->id,
            'name' => "Anak 3 Pernikahan Hery_2",
            'gender' => "0",
            'birthday' => "1992-11-19",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);


        /**./end Keturunan satu */


        /** keturunan dua */
        $suamiDina1 = Person::create([
            'name' => "Suami Pertama Dina",
            'gender' => "1",
            'birthday' => "1971-04-01",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);

        $dina = Person::create([
            'parent_id' => $pernikahanBapak->id,
            'father_id' => $muchidin->id,
            'mother_id' => $heriah->id,
            'name' => "Dina Herdiani",
            'gender' => "0",
            'birthday' => "1971-01-01",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);

        $pernikahanDina_1 = Couple::create([
            'husband_id' => $suamiDina1->id,
            'wife_id' => $dina->id,
            'divorce_date' => '2012-05-03'
        ]);

        $suamiDina2 = Person::create([
            'name' => "Suami Kedua Dina",
            'gender' => "1",
            'birthday' => "1971-04-01",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);

        $pernikahanDina_2 = Couple::create([
            'husband_id' => $suamiDina2->id,
            'wife_id' => $dina->id
        ]);

        $anakPertamaDina_pernikahan_2 = Person::create([
            'parent_id' => $pernikahanDina_2->id,
            'father_id' => $suamiDina2->id,
            'mother_id' => $dina->id,
            'name' => "Anak pertama dina Pernikahan kedua",
            'gender' => "0",
            'birthday' => "1992-01-20",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);



        $ketur2_anak_1 = Person::create([
            'parent_id' => $pernikahanDina_1->id,
            'father_id' => $suamiDina1->id,
            'mother_id' => $dina->id,
            'name' => "Anak pertama dina",
            'gender' => "0",
            'birthday' => "1992-01-20",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);



        $ketur2_anak_2 = Person::create([
            'parent_id' => $pernikahanDina_1->id,
            'father_id' => $suamiDina1->id,
            'mother_id' => $dina->id,
            'name' => "Anak kedua dina",
            'gender' => "1",
            'birthday' => "1993-06-10",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);

        $ketur2_menantu_1 = Person::create([
            'name' => "Istri Anak kedua dina",
            'gender' => "0",
            'birthday' => "1993-02-10",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);
        $ketur2_couple_2 = Couple::create([
            'husband_id' => $ketur2_anak_2->id,
            'wife_id' => $ketur2_menantu_1->id
        ]);

        $anak_ketur2_couple2 = Person::create([
            'parent_id' => $ketur2_couple_2->id,
            'name' => "Anak pertama dari Anak kedua dina",
            'gender' => "0",
            'birthday' => "2005-07-10",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);

        $anak2_ketur2_couple2 = Person::create([
            'parent_id' => $ketur2_couple_2->id,
            'name' => "Anak kedua dari Anak kedua dina",
            'gender' => "0",
            'birthday' => "2006-09-10",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);

        $anak3_ketur2_couple2 = Person::create([
            'parent_id' => $ketur2_couple_2->id,
            'name' => "Anak ketiga dari Anak kedua dina",
            'gender' => "0",
            'birthday' => "2007-11-10",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);





        $ketur2_menantu_2 = Person::create([
            'name' => "Suami Anak ketiga dina",
            'gender' => "1",
            'birthday' => "1995-09-10",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address

        ]);
        $ketur2_anak_3 = Person::create([
            'parent_id' => $pernikahanDina_1->id,
            'father_id' => $suamiDina1->id,
            'mother_id' => $dina->id,
            'name' => "Anak ketiga dina",
            'gender' => "0",
            'birthday' => "1994-06-10",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);

        $ketur2_couple_3 = Couple::create([
            'husband_id' => $ketur2_menantu_2->id,
            'wife_id' => $ketur2_anak_3->id
        ]);



        $ketur2_anakCouple3_1 = Person::create([
            'parent_id' => $ketur2_couple_3->id,
            'name' => "Anak pertama dari Anak ketiga dina",
            'gender' => "0",
            'birthday' => "2007-06-10",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);

        $ketur2_anakCouple3_2 = Person::create([
            'parent_id' => $ketur2_couple_3->id,
            'name' => "Anak kedua dari Anak ketiga dina",
            'gender' => "1",
            'birthday' => "2008-05-08",
            'phone' => $faker->phoneNumber,
            'address' => $faker->address
        ]);
        /**./end Keturunan dua */
    }
}
