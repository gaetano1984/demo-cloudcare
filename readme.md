# Laravel Docker

## Intro

Questo è una installazione minimal per poter sviluppare un applicazione basata sul framework Laravel dentro i Container Docker.  
I componenti che verranno installati sono 

- webserver nginx
- dbms mysql 5.7.22
- php 7.3

## Files

I 2 files usati da Docker per la creazione del container sono 

- Dockerfile
- docker-compose.yaml

il file docker-compose.yaml è quello che contiene i componenti dei 3 container che costituiscono l'ambiente di sviluppo che vogliamo costruire;
il Dockerfile invece contiene le istruzioni aggiuntive per la costruzione dei container

Il file Cloudcare.postman_collection.json contiene tutte le chiamate API presenti nel progetto, è da importare in Postman per simulare 
le chiamate alle API 

Il file beer_api.yml contiene la definizione delle API secondo il formato OpenApiScript 3, da consultare per dettagli sulle chiamate implementate

## Build

- da terminale, spostarsi nel path del progetto
- eseguire lo script ./bin/dev.sh
- la precedente istruzione permette di scaricare le immagini, costruire i 3 container dei servizi necessari, avviare i 3 servizi