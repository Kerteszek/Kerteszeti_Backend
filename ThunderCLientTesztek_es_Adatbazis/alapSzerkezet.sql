--create database kerteszwebaruhaz

go
use kerteszwebaruhaz

create table noveny_kategoria(
	id int identity(10,1), --100-ig megy
	elnevezes nvarchar(30) not null,

	primary key (id),
	unique (elnevezes)
)
 
create table noveny
(
	tudomanyos_nev nvarchar(30),
	nev nvarchar(30) not null,
	noveny_kategoria int not null,

	primary key (tudomanyos_nev),
	foreign key (noveny_kategoria) references noveny_kategoria(id),
)

create table kiszereles(
	id int identity(200,1), --200-400
	nev nvarchar(30) not null,

	primary key (id),
	unique (nev)
)

create table termek(
	termek_kod int identity(1000,1), --1000 +
	noveny nvarchar(30),
	allapot bit not null, --Mag 0 vagy Élő növény 1
	tipus bit not null, --Haszonnövény 0 vagy Dísznövény 1
	szin nvarchar(30),
	kiszereles int not null,
	ar int not null,
	keszlet int not null default(0),
	lefoglalt_mennyiseg int not null default(0),
	szezonlis bit not null default(0),

	primary key (termek_kod),
	foreign key (noveny) references noveny(tudomanyos_nev),
	foreign key (kiszereles) references kiszereles(id),	
)

create table termek_ar(	
	termek int not null,
	mikortol date not null,
	uj_ar int not null,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            

	primary key (termek, mikortol),	
	foreign key (termek) references termek(termek_kod),	
)

create table beszerzes(	
	termek int not null,
	besz_datum date not null default(getDate()),
	darabszam int not null default(1),  
	besz_ar int not null,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            

	primary key (term	ek, besz_datum),	
	foreign key (termek) references termek(termek_kod),	
)

create table felhasznalo(	
	felhasznalo_azon int identity(10000,1),
	nev varchar(30) not null,
	email nvarchar(50) not null,
	jelszo varchar(30) not null,
	felhasz_szint int not null default(2),  --ez a felhasználói szint	

	primary key (felhasznalo_azon),
)

create table eladas(	
	eladas_szam int identity(100000,1),
	vasarlo int not null,
	vas_datum date not null default(getDate()),
	vegosszeg int,  	                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         

	primary key (eladas_szam),	
	foreign key (vasarlo) references felhasznalo(felhasznalo_azon),	
)

create table eladas_tetel(	
	eladas_szam int not null,
	termek int not null,
	darabszam int not null,  	                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         

	primary key (eladas_szam, termek),	
	foreign key (termek) references termek(termek_kod),	
	foreign key (eladas_szam) references eladas(eladas_szam),	
)




--technikai táblák

create table kepek(	
	termek int not null,
	eleresi_utvonal varchar(60),	
	cel nvarchar(2),

	primary key (termek, eleresi_utvonal),	
	foreign key (termek) references termek(termek_kod),	
)

create table noveny_leiras(	
	leiras_id int identity(1,1),
	noveny nvarchar(30) not null,
	leiras varchar(MAX),		

	primary key (leiras_id),	
	foreign key (noveny) references noveny(tudomanyos_nev),	
)