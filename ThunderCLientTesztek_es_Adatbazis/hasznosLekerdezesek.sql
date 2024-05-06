use kerteszwebaruhaz

--1. Adott felhaszn�l� mely term�keket v�s�rolta meg eddig. (Mikor mit mennyit mennyi�rt)  


--2. Egy adott term�kb�l mely sz�nek voltak a legkelend�ek az elm�lt �vben? 

--3. Egy adott term�kb�l mely kiszerel�sek voltak a legkelend�bbek az elm�lt �vben? 

--4. Adott term�k mely h�napban volt a legkelend�bb az elm�lt �vben 
Select *
from eladas e
	inner join eladas_tetel et on et.eladas_szam=e.eladas_szam
where year(e.vas_datum)=year(getdate()) and et.termek=1000



--***HASZNOS***
--5. A top 3 legkelend�bb term�k az elm�lt h�napban. 
Select TOP 3 with ties et.termek, SUM(et.darabszam)
from eladas_tetel et
	inner join eladas e on e.eladas_szam=et.eladas_szam
where MONTH(e.vas_datum)=MONTH(GETDATE())-1
group by et.termek
order by 2 desc


--6. A legkelend�bb term�k a mai nap folyam�n. 

--7. A h�t legjobban fogy� term�ke. 


--***HASZNOS***
--8. Mely term�kb�l nem fogyott az elm�lt h�napban.
go
create view multhonapi_eladasok
as
select termek, vas_datum
from eladas_tetel et
	inner join eladas e on e.eladas_szam=et.eladas_szam
where MONTH(e.vas_datum)=MONTH(GETDATE())-1
go

Select t.termek_kod
from termek t
	left outer join multhonapi_eladasok m on t.termek_kod=m.termek 
where m.vas_datum is NULL


--***HASZNOS***
--9. Mely term�kekb�l fogyott kevesebb mint az el�z� h�napban a legutols� �rv�ltoz�s �ta? 



--10. Adott regisztr�lt felhaszn�l�nak mely n�v�nykateg�ri�k rekl�mozhat�k az eddigi rendel�sei alapj�n?

--11. Adott regisztr�lt felhaszn�l� mely n�v�nykateg�ri�kb�l nem rendelt m�g soha? 

--12. Aktu�lis �tlag�r kisz�m�t�sa a beszerz�si �r alapj�n, term�kekre lebontva,
	--tartalmazza a beszerz�si �rat, a jelenlegi elad�si �rat 


--***HASZNOS***
--13. A(z) ___ �vi kiad�sok �sszege h�napra lebontva.
--Ide is hasonl�, csak f�ggv�nnyel
go
CREATE function melyik_evi_kiadas
(	
	@ev int
)
returns table
as
return
(
	select MONTH(besz_datum) as h�nap, SUM(besz_ar * darabszam)
	from beszerzes
	where year(besz_datum)=@ev
	group by MONTH(besz_datum)
)
go

--14. Az idei kiad�sok �sszege havi bont�sban 
Select MONTH(besz_datum) as h�nap, SUM(besz_ar * darabszam)
from  beszerzes 
where year(besz_datum)=year(getdate())
group by MONTH(besz_datum)


--15. �tlagosan h�ny sz�zal�kkal v�ltoztak meg a term�k�rak az el�z� �vhez k�pest? 


