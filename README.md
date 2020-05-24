Symfony eTaksi
==================================

Brach'as Master sukonfiguruota ant XAMMP. <br />
Brach'as Docker sukonfiguruota ant dockerio <br />
Grazios dienos! :)

#### Paleidimas su Docker'iu:

Instrukcija:

* Pasileidžiame docker'į: (Nueiname į projekto folder'į ir paleidžiame komandą)

``` docker-compose up -d ```

* Atsidarome php konteinerį:

``` docker exec -it d-php bash```

* Update'inam projektą: (per php konteinerio bash komandų eilutę)

``` composer update ```

* Projektas paleistas ir jį galima pasiekti adresu:

```http://127.0.0.1:8000/```

### Projekto paleidimas/išjungimas:

* Projektas paleidžiamas su komanda:

``` docker-compose up -d ```

* Projektas išjungiamas su komanda:

``` docker-compose down  ```

#### Paleidimas su XAMPP'iu:

Instrukcija:

* Įsikelti projekto failus į XAMPP folder'į (pvz - C:\xampp\htdocs)

* Pasileidžiame XAMPP'o module'ius, APACHE ir MySql;

* Nueiti į projektą su Windows'ų CMD terminalu.

* Update'inam projektą: (Reikia tureti Composer'į)

``` composer update ```

* Projektas paleistas ir jį galima pasiekti adresu:

```http://127.0.0.1:8000/```
