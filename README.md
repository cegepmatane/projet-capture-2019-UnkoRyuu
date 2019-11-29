# projet-capture-2019-UnkoRyuu
projet-capture-2019-UnkoRyuu created by GitHub Classroom

Membres du projet :

  Quentin BERNARD
  Clément DEVOUCOUX
  Robin ORY
  Lucas PORTAL
  Guillaume MOTAIS DE NARBONNE
  
  


#exemple xml pour le jour: 
#http://51.91.96.142/AnalyseEnvironnement/listerTemperature/(annee)/(mois)/(jour)

```xml
<ListeTemperature date= '29/11/2019'>
  <Temperature heure='8'>
    <Min>23.97</Min>
    <Max>25.1</Max>
    <Moyenne>24.6106031746031</Moyenne>
  </Temperature>
  <Temperature heure='9'>
    <Min>25.07</Min>
    <Max>25.98</Max>
    <Moyenne>25.5659888579386</Moyenne>
  </Temperature>
  <Temperature heure='10'>
    <Min>25.07</Min>
    <Max>31.35</Max>
    <Moyenne>26.1877202072539</Moyenne>
  </Temperature>
  <MinTotal>23.97</MinTotal>
  <MaxTotal>31.35</MaxTotal>
  <MoyenneTotal>25.3572779700111</MoyenneTotal>
</ListeTemperature>
```

#exemple xml pour le mois: 

#http://51.91.96.142/AnalyseEnvironnement/listerTemperature/(annee)/(mois)
```xml
<ListeTemperature date= '11/2019'>
  <Temperature jour='21'>
    <Min>25.75</Min>
    <Max>33.33</Max>
    <Moyenne>25.9910913140312</Moyenne>
  </Temperature>
  <Temperature jour='22'>
    <Min>23.6</Min>
    <Max>27.67</Max>
    <Moyenne>24.7030685555271</Moyenne>
  </Temperature>
  <Temperature jour='23'>
    <Min>17.43</Min>
    <Max>24.07</Max>
    <Moyenne>19.7732432432434</Moyenne>
  </Temperature>
  <Temperature jour='24'>
    <Min>23.73</Min>
    <Max>29.68</Max>
    <Moyenne>24.4788845208851</Moyenne>
  </Temperature>
  <Temperature jour='25'>
    <Min>23.6</Min>
    <Max>24.2</Max>
    <Moyenne>23.6868461822206</Moyenne>
  </Temperature>
  <Temperature jour='29'>
    <Min>23.97</Min>
    <Max>31.35</Max>
    <Moyenne>25.3572779700111</Moyenne>
  </Temperature>
  <MinTotal>17.43</MinTotal>
  <MaxTotal>33.33</MaxTotal>
  <MoyenneTotal>24.0974232175505</MoyenneTotal>
</ListeTemperature>
```


#exemple xml pour l'année: 
#http://51.91.96.142/AnalyseEnvironnement/listerTemperature/(annee)

```xml
<ListeTemperature date= '2019'>
  <Temperature mois='10'>
    <Min>28</Min>
    <Max>28</Max>
    <Moyenne>28</Moyenne>
  </Temperature>
  <Temperature mois='11'>
    <Min>17.43</Min>
    <Max>33.33</Max>
    <Moyenne>24.0974232175505</Moyenne>
  </Temperature>
  <MinTotal>17.43</MinTotal>
  <MaxTotal>33.33</MaxTotal>
  <MoyenneTotal>24.0977799104289</MoyenneTotal>
</ListeTemperature>
```


#exemple xml pour le global: 

#http://51.91.96.142/AnalyseEnvironnement/listerTemperature/global
```xml
<Temperature>
  <Moyenne>
    <Annee>24.0977799104289</Annee>
    <Mois>24.0974232175505</Mois>
    <Jour>25.3572779700111</Jour>
  </Moyenne>
  <MinAnnee>17.43</MinAnnee>
  <MaxAnnee>33.33</MaxAnnee>
  <TemperatureActuel>26.65</TemperatureActuel>
</Temperature>
```
