Symfony Marks
==================================

#### Intro:

Projektas sukurtas naudojantis "Ubuntu 19.04", jam paleisti reikalingas sukonfiguruotas docker'is. <br />
Docker'io parsisiuntimo nuoroda [čia](https://docs.docker.com/install/linux/docker-ce/ubuntu/).<br /> Įdiegus reikia pasidaryti, kad docker'į būtų galima naudoti be root teisių, nuoroda [čia](https://docs.docker.com/install/linux/linux-postinstall/#manage-docker-as-a-non-root-user). 
 
#### Paleidimas:

Instrukcija:

* Pasileidžiame docker'į: (Nueiname į projekto folder'į ir paleidžiame komandą)

``` docker-compose up -d ```

* Įsikeliame į 'mysql' conteiner'į duomenų bazę:

``` docker cp ./marks.sql mysql:/var/tmp/marks.sql ```

* Atsidarome mysql conteiner'į:

``` docker exec -it mysql bash ```

* Prisijungiame prie mysql:

``` mysql -u root -proot ```

* Įsirašome duomenų bazę:

``` source /var/tmp/marks.sql; ```

* Atsijungiame nuo mysql ir išeiname iš mysql conteiner'io:

``` exit``` x2 kartus

* Atsidarome php konteinerį:

``` docker exec -it d-php bash```

* Update'inam projektą: (per php konteinerio bash komandų eilutę)

``` composer update ```

* Projektas paleistas ir jį galima pasiekti adresu:

```http://127.0.0.1:8000/```

#### Projekto paleidimas/išjungimas:

* Projektas paleidžiamas su komanda:

``` docker-compose up -d ```

* Projektas išjungiamas su komanda:

``` docker-compose down  ```
"# etaksi" 
