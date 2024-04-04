<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('scientific_name', 40)->unique();
            $table->foreign('scientific_name')->references('scientific_name')->on('plants');
            $table->text("description");            
            $table->timestamps();
        });

        DB::table('descriptions')->insert([
            ['scientific_name' => 'Pelargonium peltatum', 'description' => "A Pelargonium peltatum, vagy más néven lógó muskátli, lenyűgöző szépségű lombos növény. Különleges, lógó habitusa vonzza a tekinteteket, és virágai hosszan nyílnak. Ideális választás erkélyek, teraszok vagy akár kertek díszítésére. Könnyen gondozható, és hosszú ideig virágzik, így garantáltan örömöt fog szerezni kertjében."],
            ['scientific_name' => 'Viola x wittrockiana', 'description' => "A Viola x wittrockiana, vagy közismert nevén árvácska, az egyik legkedveltebb tavaszi virág. Színpompás virágai frissességet és vidámságot hoznak bármely kertbe vagy erkélyre. Jól tűri az enyhe hideget, és hosszú virágzási időszakban részesíti gazdáját. Egyszerűen gondozható és sokszínű, így tökéletes választás a kert szerelmeseinek."],
            ['scientific_name' => 'Paeonia officinalis', 'description' => "A Paeonia officinalis, vagy közismert nevén pünkösdi rózsa, elegancia és romantika szimbóluma. Csodálatos virágai, melyeket már évszázadok óta termesztenek, bármely kertet feldobják. Virágzása rövid, de az évek során egyre több hajtást hoz, így egyre impozánsabbá válik. Bámulatos illatával és lenyűgöző megjelenésével garantáltan lenyűgözi a látogatókat."],
            ['scientific_name' => 'Rosa hybrid', 'description' => "A Rosa Hybrid egy kivételes rózsafajta, amely széles körben elérhető különböző színű és formájú virágokkal. Ezek a hibrid rózsák rendkívül vonzóak a kertekben és kerti tervezésekben. Kínálják a klasszikus rózsák szépségét és illatát, miközben gyakran ellenállóbbak és kevésbé igényesek, mint a hagyományos fajták. A Rosa Hybridek gyakran virágzanak és könnyen gondozhatók, így ideális választás minden rózsa szerelmese számára, aki egy különleges, mégis könnyen kezelhető növényt keres."],
            ['scientific_name' => 'Rosa Austiger', 'description' => "Az Austiger Rosa hybrid egy igazi kertészeti remekmű. Ez a hibrid rózsa kivételesen szép virágokkal rendelkezik, melyek rendkívül bájosak és illatosak. Különleges vonalvezetése és gazdag színvilága lenyűgözi a rózsa szerelmeseit. Ideális választás kerti ágyások, kerítések vagy akár konténeres ültetések díszítésére. Gazdag virágzási időszakkal és könnyű gondozással büszkélkedhet, így minden kertész álma."],
            ['scientific_name' => 'Rosa Lady of Shalott', 'description' => "A Lady of Shalott Rosa egy különleges és bájos rózsa, melynek virágai egyszerre romantikusak és elegánsak. A virágok sárga és barack árnyalatai romantikus hangulatot teremtenek a kertben. Ez a fajta könnyen gondozható és ellenálló, így ideális választás lehet minden kertész számára, aki egy gyönyörű, ám kevésbé igényes rózsát keres."],
            ['scientific_name' => 'Salvia officinalis', 'description' => "Az officinalis salvia, vagy közismert nevén kerti zsálya, egy kiválóan használható fűszernövény és dísznövény egyaránt. A jellegzetes, ezüstös-zöld levelek és az általa termelt kék-lila virágok egyaránt vonzóvá teszik a kertet. Kiválóan alkalmas szárításra, fűszerként való használatra és kerti illatok előhívására egyaránt."],
            ['scientific_name' => 'Salvia rosmarinus', 'description' => "A rosmarinus salvia, vagy rozmaring, egy sokoldalú növény, melyet gyakran használnak fűszerezésre és gyógyászati célokra egyaránt. A növény jellegzetes tűszerű levelei és kék-lila virágai minden konyhát és kertet feldobnak. Könnyen nevelhető és télálló, így ideális választás lehet minden olyan kertész számára, aki szeretné kihasználni a rozmaring sokoldalúságát."],
            ['scientific_name' => 'Cucumis sativus', 'description' => "A Cucumis sativus, vagy közismert nevén uborka, egy friss és ropogós zöldség, melyet számos ételben és salátában használnak. Az uborka hűsítő és hidratáló, így ideális választás lehet a nyári hónapokban. Egyszerűen termeszthető és bő termést hoz, így minden kertész számára ajánlott."],
            ['scientific_name' => 'Cucurbita pepo Goldena', 'description' => "A Goldena Cucurbita pepo egy különleges és díszes tökfajta, melynek aranyszínű és apró tököcskéi varázslatos megjelenést kölcsönöznek a kertnek. Ezek a dekoratív tököcskék ideálisak őszi dekorációkhoz és rendezvények díszítéséhez egyaránt. Egyszerűen termeszthető és hosszú ideig eltartható."],
            ['scientific_name' => 'Cucurbita pepo', 'description' => "A Cucurbita pepo, vagy közismert nevén a pepók tökfajtákat többféle formában és méretben tartalmazza, beleértve a sárga és zöld tököket is. Ezek a tökfélék ideálisak az őszi szezonban, és számos ételkészítési célra használhatók. Gazdag ízükkel és textúrájukkal kiemelkedőek a levesekben, pitékben és más sütési receptekben. Egyszerűen termeszthetők és nagy termést hoznak, így kedvelt választás minden kertész számára, aki szereti az őszi zöldségeket és dekorációkat."],
            ['scientific_name' => 'Cucurbita pepo Lajkonik', 'description' => "A Lajkonik Cucurbita pepo egy hagyományos tökfajta, melynek gyümölcsei hosszúkásak és sötétzöldek. A tökök ideálisak levesekhez, pitékhez és más őszi ételkészítményekhez. Könnyen termeszthető és nagy mennyiségű termést hoz, így ideális választás minden konyhakertben."],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descriptions');
    }
};
